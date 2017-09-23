<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/home', function () {
    return redirect('/admin');
});

Route::get('/api/member', 'api\MemberController@index')->name('member');
Route::get('/api/member/{id}', 'api\MemberController@show');

Route::group(['prefix' => config('backpack.base.route_prefix'), 'middleware' => ['admin'] ], function () {

    Route::get('logout', [
        'uses'=> 'Auth\LoginController@logout',
        'as' => 'auth.logout',
    ]);

    Route::get('/user/create', [
        'uses' => 'Auth\UserCrudController@create',
    ]);

    Route::post('/user', [
        'uses' => 'Auth\UserCrudController@store',
    ]);

    CRUD::resource('member', 'Auth\MemberCrudController');

    CRUD::resource('record', 'Auth\RecordCrudController');

});
