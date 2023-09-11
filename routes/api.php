<?php

use App\Http\Controllers\LocalController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rota para autenticação de usuário
Route::post('login', [UserController::class, 'loginUser']);

// Rota para logout
Route::middleware('auth:sanctum')->get('logout', [UserController::class, 'userLogout']);

// Rotas protegidas por autenticação e verificação de nível
Route::middleware(['auth:api', 'verificarLevel:editar,deletar,listar,register'])->group(function () {
    // Apenas nível 1 tem permissão para 'register', todos os níveis têm permissão para outras ações
    Route::get('lista', [UserController::class, 'listaUsers']);
    Route::post('addUser', [UserController::class, 'addUser']);
    Route::put('edite/{id}', [UserController::class, 'edite']);
    Route::delete('delet/{id}', [UserController::class, 'delet']);
});

Route::middleware(['auth:api', 'verificarLevel:listar'])->group(function () {
    // Apenas nível 1 e 2 têm permissão para 'listar'
    Route::post('/pesquisar_local', [LocalController::class, 'pesquisarLocal']);
    Route::get('/listar_local', [LocalController::class, 'listarLocal']);
});

Route::middleware(['auth:api', 'verificarLevel:editar'])->group(function () {
    // Apenas nível 1 e 2 têm permissão para 'editar'
    Route::put('/editar_local/{id}', [LocalController::class, 'editarLocal']);
});

Route::middleware(['auth:api', 'verificarLevel:deletar'])->group(function () {
    // Apenas nível 1 e 2 têm permissão para 'deletar'
    Route::delete('/deletar_local/{id}', [LocalController::class, 'deletarLocal']);
});

// Rota para criar novo local, acessível apenas para nível 1
Route::middleware(['auth:api', 'verificarLevel:register'])->group(function () {
    Route::post('/novo_local', [LocalController::class, 'addLocal']);
});
