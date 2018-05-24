<?php

use Illuminate\Http\Request;

Route::post('register', 'Admin\ApiRegisterController@register');
Route::post('activate', 'Admin\ApiRegisterController@activate');
Route::post('/oauth/token', [
    'uses' => 'Auth\CustomAccessTokenController@issueUserToken'
]);

Route::get('photos', 'Home\HomeController@index');
Route::get('photo/home/{id}', 'Home\HomeController@photo');

Route::group(['middleware' => 'auth:api'], function(){
	Route::post("sendmail", "PublishPhotoController@send");
	Route::apiResource('photo', 'PublishPhotoController');
	Route::post('confirmInvite', "Home\HomeController@confirmed");
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
