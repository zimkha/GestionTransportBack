<?php

use Illuminate\Http\Request;

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
Route::resource('employe', 'EmployeController');
Route::resource('vehicule', 'VehiculeController');
Route::resource('type_vehicule', 'TypevehiculeController');
Route::resource('contrat', 'ContratController');
Route::resource('typecontrat', 'TypeContratController');
Route::resource('conge', 'CongeController');
Route::resource('type-conge', 'TypecongeController');
Route::resource('affectation', 'AffectationController');
Route::resource('controle-technique', 'ControletechniqueController');