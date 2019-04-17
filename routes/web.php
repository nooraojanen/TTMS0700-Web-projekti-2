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

Route::get('/', 'EtusivuController@list_all',
function () {
    return view('etusivu');
});
Route::get('etusivu', 'EtusivuController@list_all');

Route::get('tilaukset', 'TilausController@list_all');
Route::get('ostoskoritest', 'OstoskoritestController@list_all');
Route::post('lisaaostoskoriin', 'AjaxController@tulosta');
Route::get('tulostakori', 'AjaxController@naytakori');
Route::post('poistaostoskorista','AjaxController@poistakorista');
Route::post('muutalkm','AjaxController@muutalkm');
Route::get('yhteenveto','YhteenvetoController@yhteenveto');


Route::get('naiset', 'NaisetController@list_all');
Route::get('miehet', 'MiehetController@list_all');

/* SEARCH FORM */

 Route::get('search', array(
     'as'    =>  'search',
     'uses'  =>  'SearchController@index'
 ));


Route::get('lomake', 'LomakeController@lomake');
Route::post('/lomake','LomakeController@store');

Route::get('filter', array(
     'as'    =>  'filter',
     'uses'  =>  'FilterController@index'
 ));

Route::get('filternaiset', array(
     'as'    =>  'filternaiset',
     'uses'  =>  'FilterNaisetController@index'
 ));


Route::get('filtermiehet', array(
     'as'    =>  'filtermiehet',
     'uses'  =>  'FilterMiehetController@index'
 ));

Route::get('lomake', 'AjaxController@vieyhteen');

