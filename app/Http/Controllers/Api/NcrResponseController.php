<?php

namespace App\Http\Controllers\Api;

use App\Division;
use App\Http\Controllers\Controller;
use App\NcrRegistration;
use App\NcrRegistrationFile;
use App\NcrResponse;
use App\NcrResponseFile;
use App\ProblemSource;
use App\ResponseMrbUnit;
use App\ResponseProblem;
use App\Services\EmailGenerator;
use App\Services\PrintNcr;
use App\UnitDisposition;
use App\UnitInspectorCode;
use App\User;
use App\UserInspektor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NcrResponseController extends Controller
{
	public function index()
	{
		$user = Auth::user();
		$list_ncr = NcrRegistration::with('division','user','product_identity','project','product')
		->where('division_id', $user->divisi_id)    
		->orWhere(function($choose_pic){
            // ini oleh inspektor pembuat
			$choose_pic->where('user_id', Auth::id());
            // oleh sekdiv unit yang dituju
			$choose_pic->orWhere('id_pic_respon',Auth::id());  
		})
        // ini oleh manager unit terkait, pembatasan manager ada di middleware , lihat route
		->whereNull('is_cancel')
		->select('ncr_registrations.*'); 
		return response()->json([
			'list_ncr' => $list_ncr->get()
		], 200);
	}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
    	$ncr = NCRRegistration::find($id);
    	if ($ncr == null) {
    		return response()->json(['error' => 'resource not found'], 404);
    	}
    	$user_creator_id = $ncr->user_id;

    	$user_inspektor = UserInspektor::where('user_id',$user_creator_id)->first();
    	$ui_code = UnitInspectorCode::select('ui_code')->
    	where('id',$user_inspektor->inspector_group_id)->first();

    	if($ui_code->ui_code == 'INC'){
    		$this->validate($request,[
    			'problem_description' => 'required',
    			'disp_unit_id' => 'required|exists:unit_dispositions,id',
    			// 'file_bukti.*' => 'image|mimes:jpeg,bmp,png',
    			'problem_id.*' => 'required|exists:problem_sources,id'
    		]);

    	} else{
    		$this->validate($request,[
    			'problem_description' => 'required',
    			'corrective_act' => 'required',   
    			'preventive_act' => 'required', 
    			'corrective_est_date' => 'required',
    			'preventive_est_date' => 'required', 
    			'disp_unit_id' => 'required|exists:unit_dispositions,id',
    			// 'file_bukti.*' => 'image|mimes:jpeg,bmp,png',
    			'problem_id.*' => 'required|exists:problem_sources,id'
    		]);
    	}
    	$ncr_response = NcrResponse::create([
    		'problem_description' => $request->problem_description,
    		'corrective_act' => $request->corrective_act,
    		'preventive_act' => $request->preventive_act,
    		'corrective_est_date' => $request->corrective_est_date,
    		'preventive_est_date' => $request->preventive_est_date,
    		'disp_unit_id' => $request->disp_unit_id,
    		'user_id' => Auth::id(),
    		'ncr_id' => $id
    	]);

    	$ncr_resp_id = $ncr_response->id;
        // $ncr_id = $id;
        // $ncr = NcrRegistration::where('id',$id)->first();
    	$ncr->is_response = 1;
    	$ncr->save();

    	$created_date = Carbon::parse($ncr_response->created_at)->toDateString();
    	$est_date = $ncr_response->corrective_est_date;

    	$ncr_creator = User::select('email')->where('id',$user_creator_id)->first();
    	$link = route('inspector_verification.show',[$ncr->id]);

    	$email_generator = new EmailGenerator();

    	try{
    		if(is_null($ncr_creator->email) || is_null($ncr_creator))
    		{
    			dispatch(new MailNcrResponse('admin.qc@inka.co.id',$ncr->no_reg_ncr , $created_date, $link, $est_date));
    		}
    		elseif(!is_null($ncr_creator->email))
    		{
    			dispatch(new MailNcrResponse($ncr_creator->email,$ncr->no_reg_ncr , $created_date, $link, $est_date));
    		}
    	}
    	catch(Exception $e){

    	}

    	if ($request->hasFile('file_bukti')) {
    		$files = $request->file('file_bukti');
    		$uploaded =0;
    		$today= Carbon::now(8);

    		if(count($files)>0){
    			foreach($files as $file){
    				try{                
    					NcrResponseFile::create([
    						'response_id' => $ncr_response->id,
    						'ncr_response_upload' => $file->store('ncr_resp')
    					]);
    					$uploaded++;
    				}catch(Exception $e){
    					continue;
    				}
    			}
    		}
    	}

    	$problem_id = $request->problem_id;

    	if(count($problem_id)>0){
    		foreach($problem_id as $pid){
    			ResponseProblem::create([
    				'resp_id' => $ncr_response->id,
    				'problem_id' => $pid
    			]);
    		}
    	}

        //find apakah disposisi nya MRB 
    	$mrb = UnitDisposition::select('id')->where('description','MRB')->first();

    	if($request->disp_unit_id == $mrb->id){
    		return response()->json([
    			'message' => 'Ncr Response has been created.',
    			'ncr_resp_id' => $ncr_resp_id,
    			'id' => $id
    		], 201);
    	}
    	return response()->json([
    		'message' => 'Ncr Response has been created.'
    	], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$user = Auth::user();
    	$ncr = NCRRegistration::find($id);
    	if ($ncr == null) {
    		return response()->json(['error' => 'resource not found'], 404);
    	}
    	$manager_unit = User::select('id')->where('divisi_id', $ncr->division_id)->first();
    	$userinspector = UserInspektor::where('user_id',$ncr->user_id)->first();

    	if($user->id != $userinspector->user_id && $user->id != $ncr->id_pic_respon && $user->id != $manager_unit->id  )
    		abort(403);

    	$ncr_id = $ncr->id;
    	$ncr_no = $ncr->no_reg_ncr;
    	$ncr_incompatibility_id = $ncr->incompatibility_category_id;

    	$ncr_data = NcrRegistration::with('user','product_identity','project','division','product',
    		'disposition_inspector')->where('id',$id)->first();

    	$userinspector = UserInspektor::where('user_id',$ncr_data->user_id)->first();

        // ATTACHMENTS NCR 
    	$ncr_file = NcrRegistrationFile::select('id')->where('ncr_registration_id',$id)->get();
    	$ncr_file = $ncr_file->pluck('id');

    	$problem = ProblemSource::get();

    	$ncr_response = new \stdClass();
    	$ncr_response->corrective_est_date= '';
    	$ncr_response->preventive_est_date= '';

    	for($i=0 ; $i<count($problem) ; $i++)
    	{
    		$list_problems[$problem->pluck('id')->get($i)] = $problem->pluck('description')->get($i);  
    	}  
    	return response()->json([
    		'ncr_data' => $ncr_data,
    		'ncr_id' => $ncr_id,
    		'ncr_no' => $ncr_no,
    		'ncr_incompatibility_id' => $ncr_incompatibility_id,
    		'list_problems' => $list_problems,
    		'ncr_response' => $ncr_response,
    		'userinspector' => $userinspector,
    		'ncr_file' => $ncr_file
    	], 200);
    }

    public function printPdf($resp_id)
    {
    	$ncr_resp = NcrResponse::find($resp_id);
    	$ncr_id = $ncr_resp->ncr_id;

        if ($ncr_resp == null) {
            return response()->json(['error' => 'resource not found'], 404);
        }
    	$printer_ncr = new PrintNcr();
    	$pdf = $printer_ncr->ncr_pdf($ncr_id);

    	// return $pdf->stream('index.pdf');
    	return $pdf->download($ncr_resp->ncr_registration->no_reg_ncr . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$user_login = Auth::user();

    	$ncr = NCRRegistration::find($id);

    	$manager_unit = User::select('id')->where('divisi_id', $ncr->division_id)->first();

    	if($user_login->id != $ncr->user_id && $user_login->id != $ncr->id_pic_respon && $user_login->id != $manager_unit->id  )
    		abort(403);

        // jika sudah cancel
    	if($ncr->is_cancel == 1)
    		abort(404);

    	$ncr_id = $ncr->id;
    	$ncr_no = $ncr->no_reg_ncr;
    	$ncr_incompatibility_id = $ncr->incompatibility_category_id;

    	$ncr_response = NCRResponse::where('ncr_id',$id)->first();

    	$problem = ProblemSource::get();

    	$ncr_data = NcrRegistration::with('user','product_identity','project','division','product',
    		'disposition_inspector')->where('id',$id)->first();

    	$userinspector = UserInspektor::where('user_id',$ncr_data->user_id)->first();

    	for($i=0 ; $i<count($problem) ; $i++)
    	{
    		$list_problems[$problem->pluck('id')->get($i)] = $problem->pluck('description')->get($i);
    		$problem_id = $i + 1;
    		$resp_problem = ResponseProblem::where('resp_id',$ncr_response->id)
    		->where('problem_id',$problem_id)->first();

    		if($resp_problem)
    			$problem_status[$problem_id] = 1;
    		elseif(!$resp_problem)
    			$problem_status[$problem_id] = 0;
    	}
    	return response()->json([
    		'ncr_id' => $ncr_id,
    		'ncr_response' => $ncr_response,
    		'ncr_incompatibility_id' => $ncr_incompatibility_id,
    		'list_problems' => $list_problems,
    		'ncr_response' => $ncr_response,
    		'ncr_data' => $ncr_data,
    		'userinspector' => $userinspector,
    		'problem_status' => $problem_status
    	], 200);
    }

    public function update(Request $request, $ncr_resp_id){

    	$ncr_response = NcrResponse::find($ncr_resp_id);
    	if ($ncr_response == null) {
    		return response()->json(['error' => 'resource not found'], 404);
    	}
    	$ncr = NcrRegistration::find($ncr_response->ncr_id);

    	$user_creator_id = $ncr->user_id;
    	$user_inspektor = UserInspektor::where('user_id',$user_creator_id)->first();
    	$ui_code = UnitInspectorCode::select('ui_code')->
    	where('id',$user_inspektor->inspector_group_id)->first();                     
    	if($ui_code->ui_code == 'INC'){
    		$this->validate($request,[
    			'problem_description' => 'required', 
    			'disp_unit_id' => 'exists:unit_dispositions,id',
    			// 'file_bukti.*' => 'image|mimes:jpeg,bmp,png',
    			'problem_id.*' => 'exists:problem_sources,id'
    		]);
    	}
    	else{
    		$this->validate($request,[
    			'problem_description' => 'required',
    			'corrective_act' => 'required',   
    			'preventive_act' => 'required', 
    			'corrective_est_date' => 'required',
    			'preventive_est_date' => 'required', 
    			'disp_unit_id' => 'exists:unit_dispositions,id',
    			// 'file_bukti.*' => 'image|mimes:jpeg,bmp,png',
    			'problem_id.*' => 'exists:problem_sources,id'
    		]);
    	}
    	$ncr_response->update([
    		'problem_description' => $request->problem_description ?: $ncr_response->problem_description,
    		'corrective_act' => $request->corrective_act ?: $ncr_response->corrective_act,
    		'preventive_act' => $request->preventive_act ?: $ncr_response->preventive_act,
    		'corrective_est_date' => $request->corrective_est_date ?: $ncr_response->corrective_est_date,
    		'preventive_est_date' => $request->preventive_est_date ?: $ncr_response->preventive_est_date,
    		'disp_unit_id' => $request->disp_unit_id ?: $disp_unit_id,
    		'user_id' => Auth::id()
    	]);

    	$ncr_resp_id = $ncr_response->id;
    	$ncr_id = $ncr_response->ncr_id;

    	$ncr = NcrRegistration::where('id',$ncr_id)->first();
    	$ncr->is_response = 1;
    	$ncr->save();

    	if ($request->hasFile('file_bukti')) {
    		$files = $request->file('file_bukti');
    		$uploaded =0;
    		if(count($files)>0){
    			foreach($files as $file){
    				try{                
    					NcrResponseFile::create([
    						'response_id' => $ncr_response->id,
    						'ncr_response_upload' => $file->store('ncr_resp')
    					]);
    					$uploaded++;
    				}catch(Exception $e){
    					continue;
    				}
    			}
    		}
    	}
    	

    	$problem_id = $request->problem_id;
    	if ($problem_id != null) {
    		if(count($problem_id)>0){
    			$old_problems = ResponseProblem::where('resp_id',$ncr_resp_id)->get();
    			foreach($old_problems as $problem){ 
    			// delete data yang lama
    				$problem->forceDelete();  
    			}

    			foreach($problem_id as $pid){
    				ResponseProblem::create([
    					'resp_id' => $ncr_response->id,
    					'problem_id' => $pid
    				]);
    			}
    		}
    	}

        //find apakah disposisi nya MRB 
    	$mrb = UnitDisposition::select('id')->where('description','MRB')->first();

    	if($request->disp_unit_id == $mrb->id){

    		$resp_mrb = ResponseMrbUnit::select('division_id','mrb_disp_id')->
    		where('response_id',$ncr_response->id)->get();
    		$disp_mrb = $resp_mrb->pluck('mrb_disp_id')->get('0');

    		$unit_name = Division::select('division_name')
    		->whereIn('id',$resp_mrb->pluck('division_id'))->get();
    		return response()->json([
    			'message' => 'update ncr response succeed',
    			'ncr_resp_id' => $ncr_resp_id,
    			'resp_mrb' => $resp_mrb,
    			'unit_name' => $unit_name,
    			'disp_mrb' => $disp_mrb
    		], 201);
    	}
    	return response()->json([
    		'message' => 'update ncr response succeed'
    	], 201);
    }

    public function mrbStore(Request $request, $id)
    {
    	$ncr_response = NcrResponse::find($id);
    	if ($ncr_response == null) {
    		return response()->json(['error' => 'resource not found'], 404);
    	}
    	$this->validate($request,[
    		'lists.*' => 'required|exists:divisions,division_name',
    		'mrb_id' => 'required|exists:mrb_dispositions,id'
    	]);

    	$ncr_response->update(['mrb_id' => $request->mrb_id]);
    	for($i = 0; $i < count($request->lists); $i++)
    	{
    		ResponseMrbUnit::create([
    			'response_id' => $id,
    			'division_id' => Division::where('division_name', $request->lists[$i])->first()->id,
    			'mrb_disp_id' => $request->mrb_id
    		]);
    	}
    	return response()->json([
    		'message' => 'Mrb has been created.'
    	], 201);
    }

    public function mrbUpdate(Request $request, $id){
        // id means ncr reponse id 

    	$this->validate($request,[
    		'lists.*' => 'required|exists:divisions,division_name',
    		'mrb_id' => 'required|exists:mrb_dispositions,id'
    	]);
    	$ncr_response = NcrResponse::find($id);
    	if ($ncr_response == null) {
    		return response()->json(['error' => 'resource not found'], 404);
    	}
    	$ncr_response->update(['mrb_id' => $request->mrb_id]);
    	$response_old = ResponseMrbUnit::where('response_id', $id)->delete();

        // foreach($response_old as $resp_old){
        //     $resp_old->delete();
        //     // soft delete untuk data lama
        //     // this is not good approach buddy 
        // }

    	for($i = 0; $i < count($request->lists); $i++)
    	{
    		$division_id = Division::select('id')->where('division_name', $request->lists[$i])->first();

    		ResponseMrbUnit::create([
    			'response_id' => $id,
    			'division_id' => Division::where('division_name', $request->lists[$i])->first()->id,
    			'mrb_disp_id' => $request->mrb_id
    		]);
    	}

        return response()->json([
            'message' => 'MRB upload succeed.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	$ncr_resp = NcrResponse::find($id);
    	if ($ncr_resp == null) {
    		return response()->json(['error' => 'resource not found'], 404);
    	}
    	$ncr_resp->delete();
    	return response()->json([
    		'message' => 'Ncr Response has been deleted.'
    	], 201);
    }
}
