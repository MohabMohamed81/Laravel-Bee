<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controllers;
use Auth;
use Validator;
use App\User;




class UserController extends Controller
{
	public function userLogin(Request $request){

		$Validator = Validator::make($request->all(),[
			'email' => array('required','email'),
			'password' => array('required','min:6','regex:/^[a-zA-Z0-9!$#%]+$/')
		]);

		if($Validator->fails()){
			return response()->json(['error'=>$Validator->errors()],401);
		}

		if(Auth::attempt(['email'=> request('email'), 'password'=>request('password')])){
			$user = Auth::user();
			$success['token'] = $user->createToken('MyApp')->accessToken;
			$success['name'] = $user->name;
			$success['email'] = $user->email;

			return response()->json(['success'=> $success],200);
		}
		else {
			return response()->json(['error'=> 'Unauthorised'],401);
		}
	}
	
	public function userRegister(Request $request){
		$Validator = Validator::make($request->all(),[
			'name' => array('required','min:5','regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
			'email' => array('required','email'),
			'password' => array('required','min:6','regex:/^[a-zA-Z0-9!$#%]+$/')
		]);


		if($Validator->fails()){
			return response()->json(['error'=>$Validator->errors()],401);
		}

		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		$user = User::create($input);
		$success['token'] = $user->createToken('MyApp')->accessToken;
		$success['name'] = $user->name;
		$success['email'] = $user->email;

		return response()->json(['success'=>$success],200);
	}

	public function userDetails(){
		$users = User::get();
		return response()->json(['success'=>$users],200);
	}
}