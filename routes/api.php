<?php

use Illuminate\Http\Request;
// use App\Http\Controllers\ContactsController; //nema potrebe jer smo dole pisali ContactsController::class

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('contacts', 'ContactsController@index');
Route::resource('contacts', ContactsController::class)
    ->except([ 'create', 'edit' ]); //ovde smo iskljucili metode koje ne koristimo da nam ne bi izbacivao gresku
