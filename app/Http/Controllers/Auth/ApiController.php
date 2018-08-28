<?php 

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use App\User;
use App\UserInspektor;
use App\UnitInspectorCode;  
use Illuminate\Support\Facades\Auth; 
use Validator;

class ApiController extends Controller 
{
	/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
	public function login(){ 
		if(Auth::attempt(['nip' => request('nip'), 'password' => request('password')])){
			$user = Auth::user(); 
			$token =  $user->createToken('NCRPersonal')->accessToken;
			$user_id = Auth::id();
			$user_inspektor = UserInspektor::where('user_id',$user_id)->first();
			$ui_code = null;
			if ($user_inspektor != null) {
				$ui_code = UnitInspectorCode::select('ui_code')
				->where('id', $user_inspektor->inspector_group_id)->first(); 
			}
			return response()->json(['accessToken' => $token, 'user' => $user, 'userInspectorCode' => $ui_code], 200); 
		} 
		else{ 
			return response()->json(['error'=>'Unauthorized'], 401); 
		} 
	}

	public function logout()
	{
		$accessToken = Auth::user()->token();
		\DB::table('oauth_refresh_tokens')
		->where('access_token_id', $accessToken->id)
		->update([
			'revoked' => true
		]);

		$accessToken->revoke();
		return response()->json(['message' => 'logout succeed.'], 201);
	}
	/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
	public function register(Request $request) 
	{ 
		$validator = Validator::make($request->all(), [ 
			'name' => 'required', 
			'nip' => 'required|string',
			'email' => 'required|email', 
			'password' => 'required', 
			'jabatan_id' => 'required|exists:jabatans',
			'divisi_id' => 'required|exists:divisions',
		]);
		if ($validator->fails()) { 
			return response()->json(['error'=>$validator->errors()], 401);            
		}

		$path = 'placeholder image url';
		if($request->hasFile('photo')){
			$this->validate($request, [
				'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5000',
			]);
			$path = $request->photo->store('users');
		}
		$user = User::create([
			'name' => $request->name,
			'nip' => $request->nip,
			'email' => $request->email,
			'password' => bcrypt($request->password),
			'photo' => $path,
			'jabatan_id' => $request->jabatan_id,
			'divisi_id' => $request->divisi_id
		]); 
		$success['name'] =  $user->name;
		$success['token'] =  $user->createToken('NCRPersonal')->accessToken;
		return response()->json(['success'=>$success], 201); 
	}
	/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
	public function details() 
	{ 
		$user = Auth::user(); 
		return response()->json(['success' => $user], 200); 
	} 
}