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

Route::get('/', function () {
    return redirect()->action('GuestController@createFormRumah');
});

Route::get('/items', 'ItemController@listItem');
Route::get('/items/create', 'ItemController@createForm');
Route::post('/items/create', 'ItemController@createItem');
Route::get('/items/{id}', 'ItemController@showItem');
Route::get('/items/{id}/update', 'ItemController@updateForm');
Route::post('/items/{id}/update', 'ItemController@updateItem');
Route::post('/items/{id}/delete', 'ItemController@deleteItem');

Route::get('/price', 'PriceController@listPrice');
Route::get('/price/create', 'PriceController@createForm');
Route::post('/price/create', 'PriceController@createPrice');
Route::get('/price/{id}', 'PriceController@showPrice');
Route::get('/price/{id}/update', 'PriceController@updateForm');
Route::post('/price/{id}/update', 'PriceController@updatePrice');
Route::post('/price/{id}/delete', 'PriceController@deletePrice');

Route::get('/users', 'UserController@listUser');
Route::get('/users/create', 'UserController@createForm');
Route::post('/users/create', 'UserController@createUser');
Route::get('/users/{id}', 'UserController@showUser');
Route::get('/users/{id}/update', 'UserController@updateForm');
Route::post('/users/{id}/update', 'UserController@updateUser');
Route::post('/users/{id}/delete', 'UserController@deleteUser');
Route::post('/users/{id}/password', 'UserController@changePassword');

Route::get('/fuzzysets', 'FuzzysetController@listSet');
Route::get('/fuzzysets/{id}', 'FuzzysetController@showSet');
Route::get('/fuzzysets/{id}/update', 'FuzzysetController@updateForm');
Route::post('/fuzzysets/{id}/update', 'FuzzysetController@updateSet');

Route::get('/fuzzyranges', 'FuzzyrangeController@listRange');
Route::get('/fuzzyranges/{id}', 'FuzzyrangeController@showRange');
Route::get('/fuzzyranges/{id}/update', 'FuzzyrangeController@updateForm');
Route::post('/fuzzyranges/{id}/update', 'FuzzyrangeController@updateRange');

Route::get('/fuzzy2sets', 'Fuzzy2setController@listSet');
Route::get('/fuzzy2sets/{id}', 'Fuzzy2setController@showSet');
Route::get('/fuzzy2sets/{id}/update', 'Fuzzy2setController@updateForm');
Route::post('/fuzzy2sets/{id}/update', 'Fuzzy2setController@updateSet');

Route::get('/fuzzy2ranges', 'Fuzzy2rangeController@listRange');
Route::get('/fuzzy2ranges/{id}', 'Fuzzy2rangeController@showRange');
Route::get('/fuzzy2ranges/{id}/update', 'Fuzzy2rangeController@updateForm');
Route::post('/fuzzy2ranges/{id}/update', 'Fuzzy2rangeController@updateRange');

Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');

Route::get('/rumah', 'RumahController@listRumah');
Route::get('/rumah/create', 'RumahController@createFormRumah');
Route::post('/rumah/create', 'RumahController@createRumah');
Route::get('/rumah/{id}', 'RumahController@showRumah');
Route::get('/rumah/{id}/update', 'RumahController@updateFormRumah');
Route::post('/rumah/{id}/update', 'RumahController@updateRumah');
Route::post('/rumah/{id}/delete', 'RumahController@deleteRumah');

Route::get('/guest', 'GuestController@createFormRumah');
Route::post('/guest', 'GuestController@createRumah');
Route::get('/guest/{id}', 'GuestController@showRumah');

Route::get('/maps', 'MapController@index');
Route::get('/maps/add', 'MapController@add');
Route::post('/maps/add', 'MapController@save');
Route::get('/maps/show', 'MapController@show');