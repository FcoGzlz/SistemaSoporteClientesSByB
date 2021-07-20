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


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['role:UAdministrador']], function(){
    Route::get('/solicitudes-clientes', 'SolicitudController@solicitudesClientes')->name('solicitudesClientes');
    Route::match(['get', 'post'], '/definir_prioridad', 'SolicitudController@definirPrioridad')->name('definirPrioridad');
    Route::match(['get', 'post'], '/ingresar_solicitud', 'SolicitudController@ingresarSolicitud')->name('ingresarSolicitud');
    Route::get('/solicitudes_ingresadas', 'SolicitudController@solicitudesIngresadas')->name('solicitudesIngresadas');
    Route::get('/nueva-solicitud', 'SolicitudController@nuevaSolicitud')->name('nuevaSolicitud');
    Route::POST('/agregar-solicitud', 'SolicitudController@agregarSolicitud')->name('agregarSolicitud');
    Route::POST('/detalle-solicitud', 'SolicitudController@detalleSolicitud')->name('detalleSolicitud');
    Route::POST('/editar-solicitud', 'SolicitudController@editarSolicitud')->name('editarSolicitud');
    Route::any('/guardar-solicitud', 'SolicitudController@guardarSolicitud')->name('guardarSolicitud');
    Route::POST('/eliminar-solicitud', 'solicitudController@eliminarSolicitud')->name('eliminarSolicitud');
});

Route::group(['middleware' => ['role:UOperativo']], function(){
    Route::get('/solicitudes-pendientes', 'UOperativoController@solicitudesPendientes')->name('solicitudesPendientes');
    Route::match(['get', 'post'],'/detalle-solicitud', 'UOperativoController@detalleSolicitud')->name('detalle');
    Route::POST('/agregar-detalle', 'UOperativoController@agregarDetalle')->name('agregarDetalle');
    Route::POST('/guardar-detalle', 'UOperativoController@guardarDetalle')->name('guardarDetalle');
    Route::get('/finalizar-solicitud', 'UOperativoController@finalizarSolicitud')->name('finalizarSolicitud');
    Route::get('/solicitudes-finalizadas', 'UOperativoController@solicitudesFinalizadas')->name('solicitudesFinalizadas');
    Route::POST('/resumen-solicitud', 'UOperativoController@resumenSolicitud')->name('resumen');
});


