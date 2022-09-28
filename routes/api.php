<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ImagemHomeController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ImagemController;
use App\Http\Controllers\ItemCarinhoController;

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

Route::post('/usuario/logar',[UsuarioController::class,'Logar']);
Route::post('/usuario/cadastrar',[UsuarioController::class,'Cadastrar']);
Route::post('/usuario/BuscarPorId',[UsuarioController::class,'BuscarPorId']);
Route::post('/usuario/EnviarEmail',[UsuarioController::class,'EnviarEmail']);
Route::post('/usuario/AlterarSenha',[UsuarioController::class,'AlterarSenha']);
Route::post('/usuario/AtivarUsuario',[UsuarioController::class,'AtivarUsuario']);

Route::post('/ItemCarinho/buscarPorUserId',[ItemCarinhoController::class,'BuscarPorUserId']);
Route::post('/ItemCarinho/cadastrar',[ItemCarinhoController::class,'Cadastrar']);
Route::post('/ItemCarinho/apagar',[ItemCarinhoController::class,'Apagar']);
Route::post('/ItemCarinho/atualizar',[ItemCarinhoController::class,'Atualizar']);


Route::post('/imageHome/cadastrar',[ImagemHomeController::class,'Cadastrar']);
Route::post('/imageHome/buscarTodos',[ImagemHomeController::class,'buscarTodos']);
Route::post('/categoria/cadastrar',[CategoriaController::class,'cadastrar']);
Route::post('/categoria/buscarTodos',[CategoriaController::class,'buscarTodos']);
Route::post('/item/cadastrar',[ItemController::class,'cadastrar']);
Route::post('/item/buscarPorCat',[ItemController::class,'buscarPorCat']);
Route::post('/imagem/cadastrar',[ImagemController::class,'cadastrar']);
