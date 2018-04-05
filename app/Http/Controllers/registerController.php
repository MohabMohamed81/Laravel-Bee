<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Validation\AuthorizesRequests;
use Illuminate\Foundation\Validation\AuthorizesResources;
use Illuminate\Support\Facades\Hash;
use DB;

class registerController extends BaseController
{
    public function register(Request $request){
    	
        $validator = $request->validate([
            'name' => array('required','min:5','regex:/(^([a-zA-Z]+)(\d+)?$)/u'),
            'email' => array('required','email'),
            'password' => array('required','min:6','regex:/^[a-zA-Z0-9!$#%]+$/')
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
    	$password = Hash::make($request->input('password'));

        $existUser = DB::table('users')->where('email',$email)->get();
        if(count($existUser) > 0){
            echo "Change Email";
        } else {
            $old = DB::table('users')->get();
            $old_count = count($old);

            DB::table('users')->insert(
                array(
                    'name' => $name,
                    'email' => $email,
                    'password' => $password
                )
            );

            $new = DB::table('users')->get();
            $new_count = count($new);

            if($new_count > $old_count){
                return redirect('/');
            } else {
                echo "Please Register Again";
            }
        }
    }
}
