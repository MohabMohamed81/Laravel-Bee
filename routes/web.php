<?php


Route::get('/', function () {
    return view('login');
});

Route::get('/register', function(){
	return view('register');
});

Route::get('/userprofile',function(){
	return view ('home')->with('userInfo');
});


Route::post('/loginme', 'loginController@login')->middleware('api');

Route::post('/registerme', 'registerController@register');

Route::get('/logoutme','loginController@logout');