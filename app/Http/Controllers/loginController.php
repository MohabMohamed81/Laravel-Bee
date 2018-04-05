<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Foundation\Validation\AuthorizesResources;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;

class loginController extends BaseController
{

	

	public function login(Request $request){
		$email = $request->input('email');
		$password = $request->input('password');

	     $validator = $request->validate([
            'email' => array('required','email'),
            'password' => array('required','min:6','regex:/^[a-zA-Z0-9!$#%]+$/')
        ]);


		$hashedPassword = DB::table('users')->where('email',$email)->value('password');

		$checkedPassword = Hash::check($password,$hashedPassword);

		$userInfo = DB::table('users')->where('email',$email)->get();

		if($checkedPassword){

			session(['Mohab'=>$userInfo]);
			return redirect('userprofile');

		} else {
			echo "Login Failed";
		}
	}


	public function logout(Request $request){
		Session::flush();
		return redirect('/');
	}
}
