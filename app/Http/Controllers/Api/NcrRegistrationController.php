<?php

namespace App\Http\Controllers\Api;

use App\AuditorVerification;
use App\DispositionInspector;
use App\Division;
use App\DocReferenceDivision;
use App\Helper\NcrHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\NcrRegRequest;
use App\IncompatibilityCategory;
use App\InspectorVerification;
use App\Jobs\MailNcrEdit;
use App\Jobs\MailNcrNew;
use App\NcrRegistration;
use App\NcrRegistrationFile;
use App\NcrResponse;
use App\NcrUnit;
use App\ResponseProblem;
use App\Services\EmailGenerator;
use App\Services\PrintNcr;
use App\UnitInspectorCode;
use App\User;
use App\UserInspektor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class NcrRegistrationController extends Controller
{

	public function index()
	{
		$user = Auth::user();                   

		if($user->hasRole('administrator')){
			$ncr = NcrRegistration::with('division','user','product_identity','project','product')
			->whereNull('is_cancel')
			->get();
		}
		else{
			$ncr = NcrRegistration::with('division','user','product_identity','project','product')
			->where('user_id',$user->id)
			->whereNull('is_cancel')
			->get();
		}

		$user_inspektor_id = UserInspektor::select('inspector_group_id')->where('user_id', $user->id)->first();

		$inspector_access = false;
		if(!is_null($user_inspektor_id)){
			if(!is_null($user_inspektor_id->inspector_group_id))
			{
				$user_inspector_group = UnitInspectorCode::select('is_inspector')
				->where('id',$user_inspektor_id->inspector_group_id)->first();
				if($user_inspector_group->is_inspector)
					$inspector_access = true;   
			}
		}
		return response()->json([
			'ncr' => $ncr,
			'inspector_access' => $inspector_access
		], 200);
	}

    public function create()
    {
    	$ncr_helper = new NcrHelper();
        // siapkan dropdown untuk project , this is can be enhance 
    	$list_project = $ncr_helper->getListProject();

    	$user_id = Auth::id();
    	$user_inspektor = UserInspektor::where('user_id',$user_id)->first();

    	if(!$user_inspektor)
    		abort(403);

    	$ui_code = UnitInspectorCode::select('ui_code')
    	->where('id',$user_inspektor->inspector_group_id)->first();

    	$ncr_reg = new \stdClass();
    	$ncr_reg->completion_target= '';
    	$ncr_reg->doc_reference_id = null;
    	$ncr_reg->doc_reference = null;
        $categories = IncompatibilityCategory::all();
        $inspectors = DispositionInspector::all();
        $docreferences = DocReferenceDivision::all();
        // if ui code = INC || SUB --> arahkan ke blade yang berbeda
    	if($ui_code->ui_code == 'SUB' || $ui_code->ui_code == 'INC'){
    		return response()->json([
    			'list_project' => $list_project,
    			'incompatibility_categories' => $categories,
    			'disposisi_inspector' => $inspectors,
    			'doc_reference_division' => $docreferences
    		], 200);
    	}

    	$list_unit = $ncr_helper->getUnitTujuan($ui_code);
    	return response()->json([
    		'list_project' => $list_project,
    		'ui_code' => $ui_code->ui_code,
    		'list_unit' => $list_unit,
    		'incompatibility_categories' => $categories,
    		'disposisi_inspector' => $inspectors,
    		'doc_reference_division' => $docreferences
    	], 200);
    }

    public function store(NcrRegRequest $request)
    {
    	$user = Auth::user();

    	$group_id = UserInspektor::select('inspector_group_id')
    	->where('user_id', $user->id)->first();

    	$group_name = UnitInspectorCode::select('ui_code')
    	->where('id',$group_id->inspector_group_id)->first();

    	$today= Carbon::now(8);
    	$tujuan = NcrUnit::select('unit_code')->where('id',$request->id_division)->first();
    	$count_ncr = NcrRegistration::where('ui_code_id', $group_id->inspector_group_id)
    	->whereRaw('year('.'created_at'.')= ' . $today->year )->count();

    	$count_month_ncr = NcrRegistration::where('ui_code_id', $group_id->inspector_group_id)
    	->whereRaw('month('.'created_at'.')= ' . $today->month )
    	->whereRaw('year('.'created_at'.')= ' . $today->year )->count();

    	$ncr_helper = new NcrHelper();
        $reference_unit = DocReferenceDivision::select('id','unit_id','doc_number_head')
        ->where('id', $request->acuan_id)->first();
        $new_division_id = $reference_unit->unit_id;
        
        $doc_number_head = explode('-',$reference_unit->doc_number_head);

        if(count($doc_number_head)>1){
            $doc_number_head = $doc_number_head[1];
        }else{
            $doc_number_head = $doc_number_head[0];
        }

        $nomor_po = $doc_number_head .'-'. $request->acuan_po;

        if(!is_null($group_name)){
          $no_ncr = $count_ncr+1;
          $no_month_ncr = $count_month_ncr+1;
          $pic_id = $ncr_helper->getAdminPic($new_division_id);
          $product_id = $ncr_helper->getLokasiProduk($group_name);

          $ncr = NcrRegistration::create([
           'no_reg_ncr' => $no_ncr. '/M' .$today->month.'-'. $no_month_ncr . '/'. $group_name->ui_code . '/' . $today->year,
           'user_id' => $user->id,
           'process_name' => $request->process_name,
           'reference_inspection' => 'PO : ' . $nomor_po,
           'description_incompatibility' => $request->description_incompatibility,
           'master_project_id' => $request->master_project_id,
           'division_id' => $reference_unit->unit_id,
           'disposition_inspector_id' => $request->disposition_inspector_id,
           'publish_date' => $today->toDateString(),
           'ui_code_id' => $group_id->inspector_group_id,
           'vendor_name' => $request->vendor_name,
           'incompatibility_category_id' => $request->incompatibility_category_id,
           'completion_target' => $request->completion_target,
           'id_pic_respon' => $pic_id,
           'master_product_id' => $product_id,
           'person_in_charge' => $request->person_in_charge,
           'long' => $request->long,
           'lat' => $request->lat
       ]);

          $pic = User::select('email')->where('id',$pic_id)->first();

          $created_date = $ncr->created_at;
          $created_date = Carbon::parse($created_date)->toDateString();
          $link = route('ncr_resp.show',[$ncr->id]);
          if ($request->hasFile('file_bukti')) {
           $files = $request->file('file_bukti');
          // if ($request->file_bukti) {
            // $files = $request->file_bukti;
           $uploaded =0;

           if(count($files)>0){
            foreach($files as $file){
             try{                     
                $fileName = $file->store('ncr_reg');
                // $file = str_replace('data:image/png;base64,', '', $file);
                // $file = str_replace(' ', '+', $file);
                // $fileName = str_random(10).'.png';
                // \File::put(storage_path(). '/ncr_reg' . $fileName, base64_decode($file));
                // $fileName = 'ncr_reg/' . $fileName;
                NcrRegistrationFile::create([
                    'ncr_registration_id' => $ncr->id,
                    'ncr_registration_upload' => $fileName
                ]);
                $uploaded++;
          }catch(Exception $e){
              continue;
          }
      }
  }
}
return response()->json([
    'message' => 'Ncr Registration has been created.',
    'ncr' => $ncr
], 201);

            /*
            // send Email 
    		$email_generator = new EmailGenerator();
    		$user_cc = array();
            // kirim email ke admin divisi
    		try{

    			$unit_manager = User::select('email')->where('jabatan_id',3)
    			->where('divisi_id',$request->division_id)->first();  

    			if(!is_null($unit_manager))
    			{
    				if(!is_null($unit_manager->email))
    					array_push($user_cc,$unit_manager->email);
    			}
                // send mail to admin divisi, cc to another user, ex:manager


                // $email_generator->ncrNew($pic->email,$ncr->no_reg_ncr,$ncr->reference_inspection,
                // $created_date,$link,$user_cc);

    			dispatch(new MailNcrNew($ncr->no_reg_ncr, $ncr->reference_inspection, $created_date, $link, $user_cc, $pic->email));
    		}catch(Exception $e){
                // catet log                 
    		}
    	}
    	return response()->json([
    		'message' => 'Ncr Registration has been created.',
    		'ncr' => $ncr
    	], 201); */
    }
}


public function show($id)
{
 $user = Auth::user();

 $ncr_data = NcrRegistration::with('user','product_identity','project','division','product','disposition_inspector')->where('id', $id)->first();
 if ($ncr_data == null) {
    return response()->json(['error' => 'resource not found'], 404);
}
$userinspector = UserInspektor::where('user_id', $ncr_data->user_id)->first();

$manager_unit = User::select('id')->where('divisi_id', $ncr_data->division_id)->first();

if($user->id != $userinspector->user_id && $user->id != $ncr_data->id_pic_respon && $user-id != $manager_unit->id  ){
    abort(403);
}

$ncr_file = NcrRegistrationFile::select('id')->where('ncr_registration_id',$id)->get();
$ncr_file = $ncr_file->pluck('id');
return response()->json([
    'ncr_data' => $ncr_data,
    'ncr_files_id' => $ncr_file,
    'userinspector' => $userinspector
], 200);
}

public function uploadImg($id)
{
    $ncr_data = NcrRegistration::where('id',$id)->first();
    if ($ncr_data == null) {
        return response()->json(['error' => 'resource not found'], 404);
    }
    return response()-json([
        'ncr_data' => $ncr_data
    ], 200);
}

public function storeImg(Request $request, $ncr_id)
{
    // $this->validate($request,['file_bukti.*' => 'image|mimes:jpeg,bmp,png']);
    $ncr = NcrRegistration::find($ncr_id);
    if ($ncr == null) {
        return response()->json(['error' => 'resource not found'], 404);
    }
    $files = $request->file('file_bukti');
    $uploaded = 0;
    $today= Carbon::now(8);
    if($request->hasFile('file_bukti')){
        if(count($files)>0){
            foreach($files as $file){
                try{                
                    NcrRegistrationFile::create([
                        'ncr_registration_id' => $ncr->id,
                        'ncr_registration_upload' => $file->store('ncr_reg')
                    ]);
                    $uploaded++;
                }catch(Exception $e){
                    continue;
                }
            }
        }
    }
    return response()->json([
      'message' => 'Upload image succeed.'
  ], 201);
}


public function printPdf($ncr_id)
{
    $printer_ncr = new PrintNcr();
    $ncr = NcrRegistration::find($ncr_id);
    if ($ncr == null) {
        return response()->json(['error' => 'resource not found'], 404);    
    }
    $pdf = $printer_ncr->ncr_pdf($ncr_id);
        // return response()->file($pdf);
        // return $pdf->stream('index.pdf');
    return $pdf->download($ncr->no_reg_ncr . '.pdf');
}

public function edit($id)
{
 $user_login = Auth::user();

 $ncr_reg = NCRRegistration::find($id);

 if ($ncr_reg == null) {
    return response()->json(['error' => 'resource not found'], 404);
}
        // jika ncr sudah di cancel, tidak bisa dirubah
if($ncr_reg->is_cancel == 1){
    abort(404);
}

if($user_login->id != $ncr_reg->user_id){
    abort(403);
}

$ncr_helper= new NcrHelper();

        // flag ncr berdasarkan dokumen yang telah ditentukan , ex : PO
$is_doc_reference = false;

if(!is_null($ncr_reg->doc_reference_id)){
    $is_doc_reference = true;
}

$list_project = $ncr_helper->getListProject();

$user_id = Auth::id();
$user_inspektor = UserInspektor::where('user_id',$user_id)->first();

$ui_code = UnitInspectorCode::select('ui_code')->
where('id',$user_inspektor->inspector_group_id)->first();

if($is_doc_reference && ($ui_code->ui_code == 'SUB' || $ui_code->ui_code == 'INC')){
    return response()->json([
        'list_project' => $list_project,
        'ui_code' => $ui_code->ui_code,
        'ncr_reg' => $ncr_reg
    ], 200);
}

$list_unit = $ncr_helper->getUnitTujuan($ui_code);
return response()->json([
    'list_project' => $list_project,
    'ui_code' => $ui_code->ui_code,
    'ncr_reg' => $ncr_reg,
    'list_unit' => $list_unit
], 200);
}

public function update(NcrRegRequest $request, $id)
{
 $new_division_id = $request->division_id;

 $ncr = NcrRegistration::find($id);
 if ($ncr == null) {
    return response()->json(['error' => 'resource not found'], 404);
}
$old_division_id = $ncr->unit_id;

$ncr_helper = new NcrHelper();
    	// $id_user= Auth::id();
$user = Auth::user();
$group_id = UserInspektor::select('inspector_group_id')
->where('user_id',$user->id)
->first();

$group_name = UnitInspectorCode::select('ui_code')
->where('id',$group_id->inspector_group_id)
->first();

$product_id = $ncr_helper->getLokasiProduk($group_name);
$link = route('ncr_resp.show',[$ncr->id]);

$pic_id = $ncr_helper->getAdminPic($request->division_id);           
$pic = User::find($pic_id);
if ($request->acuan_id && $request->acuan_po) {
    $reference_unit = DocReferenceDivision::select('id','unit_id','doc_number_head')
    ->where('id', $request->acuan_id)->first();
    $new_division_id = $reference_unit->unit_id;

    $doc_number_head = explode('-',$reference_unit->doc_number_head);

    if(count($doc_number_head)>1){
        $doc_number_head = $doc_number_head[1];
    }else{
        $doc_number_head = $doc_number_head[0];
    }

    $nomor_po = $doc_number_head .'-'. $request->acuan_po;
}
$ncr->update([
    'user_id' => $user->id,
    'process_name' => $request->process_name ?: $ncr->process_name,
    'reference_inspection' => $nomor_po ? 'PO : '. $nomor_po : $ncr->reference_inspection,
    'description_incompatibility' => $request->description_incompatibility?: $ncr->description_incompatibility,
    'product_identity_id' => $request->product_identity_id ?: $ncr->product_identity_id,
    'master_project_id' => $request->master_project_id ?: $ncr->master_project_id,
    'division_id' => $new_division_id ?: $ncr->division_id,
    'disposition_inspector_id' => $request->disposition_inspector_id ?: $ncr->disposition_inspector_id,
    'completion_target' => $request->completion_target ?: $ncr->completion_target,
    'incompatibility_category_id' => $request->incompatibility_category_id ?: $ncr->incompatibility_category_id,
    'master_product_id' => $product_id ?: $ncr->master_product_id,
    'id_pic_respon' => $pic_id ?: $ncr->id_pic_respon,
    'person_in_charge' => $request->person_in_charge ?: $ncr->person_in_charge
]);

$ncr = $ncr->fresh();
if ($request->hasFile('file_bukti')) {
    $files = $request->file('file_bukti');
    $uploaded =0;
    if(count($files)>0){
        foreach($files as $file){
            try{                

                $filename = $file->store('ncr_reg');
                NcrRegistrationFile::create([
                    'ncr_registration_id' => $ncr->id,
                    'ncr_registration_upload' => $filename
                ]);
                $uploaded++;
            }catch(Exception $e){
                continue;
            }
        }
    }            
}

$user_cc = array();
        //sending jika ada perubahan divisi
if($new_division_id != $old_division_id){
            // dd('Tujuan Berubah');
            // trigger mailncr edit

    $unit_manager = User::select('email')
    ->where('jabatan_id',3)
    ->where('divisi_id',$request->division_id)
    ->first();  

    if(!is_null($unit_manager))
    {
        if(!is_null($unit_manager->email))
            array_push($user_cc,$unit_manager->email);
    }
            // send mail to admin divisi, cc to another user, ex:manager
    $created_date = Carbon::now(8)->toDateString();
            // send to job
    // dispatch(new MailNcrEdit($ncr->no_reg_ncr, $ncr->reference_inspection, 
    //  $created_date, $link, $user_cc, $pic->email));
}
return response()->json([
    'message' => 'Ncr Registration has been updated',
    'ncr' => $ncr
], 201);
}

public function destroy($id)
{
 $ncr = NcrRegistration::find($id);
 if ($ncr == null) {
    return response()->json(['error' => 'resource not found'], 404);
}
$ncr->delete();
return response()->json(['message' => 'Ncr Registration has been deleted.'], 201);
}

public function generateSpreadSheet(Request $request)
{
    $user = Auth::user();
    $unit_id = $user->divisi_id;

    $unit = Division::find($unit_id);

    $this->validate($request , [
        'start_date' => 'required',
        'end_date' => 'required|after_or_equal:start_date',
    ]);

    $is_manager_inspector = false;

    if($user->hasRole('struktural'))
        $is_manager_inspector = true;

    if(!$is_manager_inspector){
        $list_ncr = NcrRegistration::with('user','division','project','inc_category','disposition_inspector')
        ->where('user_id', $user->id)
        ->orWhere('division_id',$unit_id)->orWhere('id_pic_respon',$user->id)
        ->whereBetween('publish_date',array($request->start_date,$request->end_date))
        ->whereNull('is_cancel')->get();
    }elseif($is_manager_inspector){
        $list_ncr = NcrRegistration::with('user','division','project','inc_category','disposition_inspector')
        ->whereHas('user', function($q) use ($unit_id){
            $q->where('divisi_id', $unit_id);
        })
        ->whereBetween('publish_date',array($request->start_date,$request->end_date))
        ->whereNull('is_cancel')->get();
    }

    $file_absen_no_status = Excel::create('Data Laporan NCR '.$request->start_date . '-' . $request->end_date, 
        function($excel) use ($list_ncr){
            $excel->setTitle('Data Laporan NCR');
            $excel->setCreator('Online NCR');
            $excel->sheet('Data NCR' ,function($sheet) use ($list_ncr)
            {
                $row = 1;
                $sheet->row($row,['No NCR','Tgl Terbit','Inspektor QC','Unit Tujuan','Acuan','Projek','Kategori Ketidaksesuain (oleh Inspektor)',
                    'Disposisi (Inspektor)','Akar Masalah','Uraian Akar Masalah','Tindakan Perbaikan','Tindakan Pencegahan','Disposisi Unit','Verifikasi Inspektor','Verifikasi MMLH']);

                foreach ($list_ncr as $ncr){
                    $resp = NcrResponse::with('unit_disposition')->where('ncr_id', $ncr->id)->first();

                    if($resp){
                        $akar_masalah = '-';
                        $problems = ResponseProblem::with('problem_source')->where('resp_id',$resp->id)->get();
                        if(!is_null($problems))
                        {
                            foreach($problems as $problem){
                                $source = $problem->problem_source->description;
                                if($akar_masalah != '-')
                                    $akar_masalah = $akar_masalah . ';'. $source;
                                else
                                    $akar_masalah = $source; 
                            }
                        }
                        $inspector_verification = null;

                        $ver_inspector = InspectorVerification::where('resp_id',$resp->id)->first();
                        if(!is_null($ver_inspector)){
                            $inspector_verification = strip_tags($ver_inspector->verification_description);
                        }

                        $auditor_verification = null;


                        $ver_mmlh = AuditorVerification::where('resp_ncr_id',$resp->id)->first();
                        if(!is_null($ver_mmlh)){
                            $auditor_verification = strip_tags($ver_mmlh->verification_description);
                        }

                        $sheet->row(++$row,[
                            $ncr->no_reg_ncr,
                            $ncr->publish_date,
                            $ncr->user->name . '/' . $ncr->user->nip,
                            $ncr->division->division_name,
                            $ncr->reference_inspection,
                            $ncr->project->project_code . '/' . $ncr->project->project_description,
                            $ncr->inc_category->description,
                            $ncr->disposition_inspector->disposisi_description,
                            $akar_masalah,
                            strip_tags($resp->problem_description),
                            strip_tags($resp->corrective_act),
                            strip_tags($resp->preventive_act),
                            $resp->unit_disposition->description,
                            $inspector_verification,
                            $auditor_verification
                        ]);
                    }else{
                        $sheet->row(++$row,[
                            $ncr->no_reg_ncr,
                            $ncr->publish_date,
                            $ncr->user->name . '/' . $ncr->user->nip,
                            $ncr->division->division_name,
                            $ncr->reference_inspection,
                            $ncr->project->project_code . '/' . $ncr->project->project_description,
                            $ncr->inc_category->description,
                            $ncr->disposition_inspector->disposisi_description,
                            '',
                            '',
                            '',
                            '',
                            '',
                            ''
                        ]);
                    }
                }
            });
        })->download();
}
}
