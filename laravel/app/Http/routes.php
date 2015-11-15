<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Landing
Route::get('/', function () {
    return view('welcome');
});

// Password reset link request
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// ContentTools save
Route::post('x/save-page', 'ContentToolsController@savePage');

// API
Route::group(array('prefix' => 'api/v1'), function() {

    Route::get('/csrf-token', function() {
        return response()->json([ 'token' => Session::token() ]);
    });

    // Authentication
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@getLogout');
    Route::get('auth/user', 'Auth\AuthController@getUser');

    Route::resource('lc', 'LCController',
                    ['except' => ['create', 'edit']]);
    Route::resource('event', 'EventController',
                    ['only' => ['index', 'show']]);
    Route::resource('member', 'MemberController',
                    ['except' => ['create', 'edit']]);

    Route::resource('lc.event', 'LCEventController',
                    ['except' => ['create', 'edit']]);
    Route::resource('event.group', 'EventGroupController',
                    ['except' => ['create', 'edit']]);
    Route::resource('event.member', 'EventMemberController',
                    ['only' => ['index', 'show']]);
    Route::resource('event.group.member', 'EventGroupMemberController',
                    ['only' => ['index', 'show', 'store', 'destroy']]);
    Route::resource('event.group.score', 'EventGroupScoreController',
                    ['only' => ['index', 'show', 'store', 'destroy']]);

});
