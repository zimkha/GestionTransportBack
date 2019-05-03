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
Route::resource('commande-marchandise', 'CommandeMarchandiseController');
Route::resource('vehicule', 'VehiculeController');
Route::resource('departement', 'DepartementController');
Route::resource('type_vehicule', 'TypevehiculeController');
Route::resource('contrat', 'ContratController');
Route::resource('typecontrat', 'TypeContratController');
Route::resource('conge', 'CongeController');
Route::resource('type-conge', 'TypecongeController');
Route::resource('affectation', 'AffectationController');
Route::get('affectation/{id}/{datedebut}/{datefin}', 'AffectationController@getLivraisonAffBydDat')->where('id' ,'[0-9]+');
Route::resource('controle-technique', 'ControletechniqueController');
Route::resource('reception', 'ReceptionController');
Route::get('getbydate/{date1}/{date2}', 'ReceptionController@getReceptionbyDate');
Route::get('marchandise/{date1}/{date2}', 'MarchandiseController@getMarchandisplusLivre');
Route::resource('marchandise', 'MarchandiseController');
Route::get('vehicule/disponible', 'VehiculeController@vehiculeDisponible');
Route::get('fournisseurs', 'ReceptionController@getFournisseur_more_reception');
Route::get('reparation-plus-frequent/{dte_debut?}/{dte_fin?}', 'ReparationController@VehiculePlusRepare');