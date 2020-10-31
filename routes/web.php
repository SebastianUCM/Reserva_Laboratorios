<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; 

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

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/Laboratorios','LaboratoriosController@index');
//Route::get('/Laboratorios/Crear','LaboratoriosController@create');
Route::resource('Laboratorios', 'LaboratoriosController');
Route::delete('Laboratorios/{id}','LaboratoriosController@destroy')->name('Laboratorios.destroy');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes(['reset'=>false,'forgot'=>false]);


Route::resource('Usuarios', 'UsuariosController');

Route::resource('Reservas', 'ReservasController');

Route::resource('User', 'UsuariosController');

Route::get('Calendario/reserva/{mes}','CalendarioController@index_month');
Route::get('Calendario/reserva','CalendarioController@index');

Route::get('Reserva/index','ReservasController@index_C');
Route::get('Reserva/detalle/{id}','ReservasController@details');



Route::get('/agenda', 'AgendaController@index');


