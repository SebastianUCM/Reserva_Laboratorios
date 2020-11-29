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

Route::get('/Reservas/{reserva}/Modulos', 'ReservasController@ActualizarModulo');
Route::put('/Reservas/{reserva}/Modulos_update', 'ReservasController@ModificarModulos');

Route::get('/Reservas/{reserva}/desactivar', 'ReservasController@desactivarFecha');
Route::put('/Reservas/{reserva}/desactivar_Fechas', 'ReservasController@desocuparFecha');



Route::get('Reserva/index','ReservasController@index_C');
Route::get('Reserva/detalle/{id}','ReservasController@details');



Route::get('/agenda', 'AgendaController@index');


