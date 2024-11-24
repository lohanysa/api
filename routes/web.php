<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\libroGoogleController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('inicio.welcome');
});

Route::Resource('google', libroGoogleController::class);

Route::Resource('crudLibro', LibroController::class);


Route::get('estante', [libroGoogleController::class, 'estanteria'])->name('estantePrivado');
Route::Resource('user',UsuarioController ::class);
Route::get('buscar', [libroGoogleController::class, 'googleSearch'])->name('buscar_libro');
Route::post('iniciar', [UsuarioController ::class,'login'])->name('login');
Route::post('salir', [UsuarioController ::class,'logout'])->name('salir');

Route::delete('eliminar/{volId}', [LibroController::class, 'destroy'])->name('libro.eliminar');