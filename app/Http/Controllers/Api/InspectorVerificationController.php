<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\InspectorVerification;
use App\NcrRegistration;
use App\NcrResponse;
use App\ResponseProblem;
use App\Services\EmailGenerator;
use App\Services\PrintNcr;
use App\User;
use App\UserInspektor;
use App\VerificationResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspectorVerificationController extends Controller
{
	public function index()
	{
		$ncr = NcrRegistration::with('division','user','product_identity',
			'project','product')
		->where('is_response',1)
		->where('user_id', Auth::id())
		->get();
		return response()->json([
			'ncr' => $ncr
		], 200);
	}

	public function create()
	{
        return response()->json([
        	'verificationresult' => VerificationResult::all()
        ], 200);
	}

	public function store(Request $request)
	{
		$today = Carbon::today()->toDateString();

		$this->validate($request , [
			'ncr_id' => 'required|exists:ncr_registrations,id',
			'verification_result_id' => 'exists:verification_results,id',
			'verification_description' => 'required',    
		]);

		$ncr_response = NcrResponse::select('id','user_id','ncr_id')
		->where('ncr_id', $request->ncr_id)
		->first();
		if ($ncr_response == null) {
			return response()->json(['error' => 'resource not found'], 404);
		}
		$ncr = NcrRegistration::select('id','no_reg_ncr')
		->where('id', $ncr_response->ncr_id)
		->first();

		$verification = InspectorVerification::create([
			'reg_id' => $ncr->id,
			'resp_id' => $ncr_response->id,
			'verification_description' => $request->verification_description,
			'verification_result_id' => $request->verification_result_id,
			'publish_date' => $today
		]);
		$ncr->update(['is_ver_inspector' => 1]);
		$link = route('ncr_resp.print',[$ncr->id]);

		$responder = User::select('email')->where('id',$ncr_response->user_id)->first();

		// $email_generator = new EmailGenerator();

  //   	try{
  //   		if(is_null($responder->email))        
  //   		{
  //   			dispatch(new MailNcrInspectorVerification('admin.qc@inka.co.id',$ncr->no_reg_ncr,$today,$link));
  //   		}
  //   		elseif(!is_null($responder->email))
  //   		{
  //                   // $email_generator->ncrInsVerification($responder->email,$ncr->no_reg_ncr,$today,$link);
  //   			dispatch(new MailNcrInspectorVerification($responder->email,$ncr->no_reg_ncr,$today,$link));

  //   		}
  //   	}catch(Exception $e){
  //   	}

		return response()->json([
			'message' => 'create inspector verif succeed.'
		], 200);
	}

	public function show(Request $request, $id)
	{
		$user = Auth::user();

		$ncr = NCRRegistration::find($id);

		if ($ncr == null) {
			return response()->json(['resource not found'], 404);
		}
		if($user->id != $ncr->user_id ){
			abort(403);
		}

		if($ncr->is_cancel == 1){
			abort(404);
		}

		$ncr_id = $ncr->id;
		$ncr_no = $ncr->no_reg_ncr;
		$ncr_incompatibility_id = $ncr->incompatibility_category_id;

		$ver_result = VerificationResult::get();

		$list_results = array();

		for($i=0 ; $i<count($ver_result) ; $i++)
		{
			$list_results[$ver_result->pluck('id')->get($i)] = 
			$ver_result->pluck('description')->get($i);
		}  
        // get data ncr
		$ncr_data = NcrRegistration::with('user','product_identity','project','division','product','disposition_inspector')->where('id',$id)->first();
		$userinspector = UserInspektor::where('user_id',$ncr_data->user_id)->first();

        //get data response
		$resp_data = NcrResponse::with('unit_disposition','mrb_disposition','ncr_registration','ncr_registration.project','ncr_registration.product_identity','ncr_registration.division','ncr_registration.user')->where('ncr_id',$id)->first();
		$resp_problem = ResponseProblem::with('ncr_response','problem_source')->where('resp_id',$resp_data->id)->get();
		return response()->json([
			'ncr_data' => $ncr_data,
			'userinspector' => $userinspector,
			'ncr_id' => $ncr_id,
			'ncr_no' => $ncr_no,
			'ncr_incompatibility_id' => $ncr_incompatibility_id,
			'list_results' => $list_results,
			'resp_data' => $resp_data,
			'resp_problem' => $resp_problem
		], 200);
	}

	public function edit($ncr_id)
	{
		$uid = Auth::user();
        // cari inspector verification 
		$verification = InspectorVerification::where('reg_id', $ncr_id)->first();
         // get data ncr
		$ncr_data = NcrRegistration::with('user','product_identity','project','division',
			'product','disposition_inspector')->where('id',$ncr_id)->first();
		$userinspector = UserInspektor::where('user_id',$ncr_data->user_id)->first();

		if($uid->id != $ncr_data->user_id)
			abort(403);
         //get data response
		$resp_data = NcrResponse::with('user','unit_disposition','mrb_disposition','ncr_registration',
			'ncr_registration.project','ncr_registration.product_identity','ncr_registration.division',
			'ncr_registration.user')->where('ncr_id',$ncr_id)->first();
		$resp_problem = ResponseProblem::with('ncr_response','problem_source')
		->where('resp_id',$resp_data->id)->get();
		return response()->json([
			'ncr_data' => $ncr_data,
			'userinspector' => $userinspector,
			'resp_data' => $resp_data,
			'resp_problem' => $resp_problem
		], 200);
	}

	public function update(Request $request, $ver_id)
	{
        //dd($request, $ver_id);
		$today = Carbon::today()->toDateString();

        //$ncr_response = NcrResponse::select('id')->where('ncr_id',$id)->first();

		$verification = InspectorVerification::find($ver_id);
		
		if ($verification == null) {
			return response()->json(['error' => 'resource not found'], 404);
		}

		$this->validate($request , [
			'verification_result_id' => 'exists:verification_results,id',
			'verification_description' => 'required',    
		]);

		$verification->update([
			'verification_description' => $request->verification_description,
			'verification_result_id' => $request->verification_result_id,
			'publish_date' => Carbon::today()->toDateString()
		]);

		return response()->json([
			'message' => 'inspector verif update succeed.'
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
    	$verification = InspectorVerification::find($id);
    	if ($verification != null) {
    		$verification->delete();
    		return response()->json([
    			'message' => 'Inspector Verification delete succeed'
    		], 201);
    	}
    	return response()->json([
    		'error' => 'resource not found'
    	], 404);
    }
    /*

    public function print($id){
    	$resp_data = NcrResponse::with('unit_disposition','mrb_disposition','ncr_registration','ncr_registration.project','ncr_registration.product_identity','ncr_registration.division','ncr_registration.user')->where('ncr_id',$id)->first();
    	$userinspector = UserInspektor::where('user_id',$resp_data->ncr_registration->user_id)->first();

    	$resp_problem = ResponseProblem::with('ncr_response','problem_source')
    	->where('resp_id',$resp_data->id)->get();
        //$ncr_file = NcrRegistrationFile::select('id')->where('ncr_registration_id',$id)->get();

    	$resp_file = NcrResponseFile::select('id','ncr_response_upload')
    	->where('response_id',$resp_data->id)->get();

    	$inspector_verification = InspectorVerification::with('ver_result')->where('reg_id',$id)
    	->where('resp_id',$resp_data->id)->first();

        //dd($inspector_verification);

    	return view('verification_inspector.show')->with(compact('resp_data','resp_file','resp_download','resp_problem','userinspector','inspector_verification'));

    }

    public function printPdf($ncr_resp_id)
    {
    	$ncr = NcrResponse::find($ncr_resp_id);
    	$ncr_id = $ncr->ncr_id;
    	if ($ncr == null) {
    		return response()->json(['error' => 'resource not found'], 404);
    	}
    	$printer_ncr = new PrintNcr();
    	$pdf = $printer_ncr->ncr_pdf($ncr_id);

    	// return $pdf->stream('index.pdf');
    	return $pdf->download($ncr->ncr_registration->no_reg_ncr . '.pdf');
    */
}