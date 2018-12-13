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

//ovo da globalno da nam prihvati request koji saljemo i da nemamo CORS gresku, nije najbolji nacin
//ovde nemamo potpunu kontrolu kao sa cors-om
// header('Access-Control-Allow-Origin: *'); //bilo koja aplikacija sa bilo kojeg domena moze da pristupi nasoj aplikaciji, mozemo umesto * navoditi domene koje hocemo da pustimo na nas domen
// header('Access-Control-Allow-Mathods: PUT,POST,GET,DELETE,OPTIONS'); //koje metode koristimo
// header('Access-Control-Allow-Headers: Content-Type,Accept,Origin'); //tip podataka


//moramo pisati namespace jer nam se AuthController nalazi u Auth folderu
Route::group([
    'namespace' => 'Auth',
    'prefix' => 'auth',
], function() {
    Route::post('/login', 'AuthController@login');
});



Route::middleware('auth:api')->group(function() {
    Route::resource('contacts', ContactsController::class)
        ->except([ 'create', 'edit' ]);
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('contacts', 'ContactsController@index');
// Route::resource('contacts', ContactsController::class)
//     ->except([ 'create', 'edit' ]); //ovde smo iskljucili metode koje ne koristimo da nam ne bi izbacivao gresku
