<?php

use App\Http\Controllers\CaixasController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ControllerIgreja;
use App\Http\Controllers\DespesasController;
use App\Http\Controllers\DizimosController;
use App\Http\Controllers\MembrosController;
use App\Http\Controllers\OfertasController;
use App\Http\Controllers\User;
use GuzzleHttp\Middleware;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*Route::get('/registrar/dizimo', [ControllerIgreja::class, 'regdizimo']);*/



                            /*Usuarios*/
Route::get('/', [MembrosController::class, 'index'])->name('index');
Route::get('/cadastro/membro', [MembrosController::class, 'cadastro_membro']);
Route::post('/inserir/membro', [MembrosController::class, 'botao_inserir_membro']);
Route::post('/destroy/{id}', [MembrosController::class, 'excluir_membro']);

                            /*Dizimos Por Usuario*/
Route::get('/inserir/dizimos/{id}/{nome}', [DizimosController::class, 'botao_inserir']);
Route::post('/registrar/dizimo', [DizimosController::class, 'botao_registrar_dizimo']);
Route::post('/dizimos/destoy/id', [DizimosController::class, 'botao_excluir_dizimo']);
Route::get('/filtrar/dizimo/{user_id}/{nome}', [DizimosController::class, 'filtrar_dizimo']);


                             /*Ofertas*/
Route::get('/oferta', [OfertasController::class, 'oferta']);
Route::post('/registrar/oferta', [OfertasController::class, 'botao_registrar_oferta']);
Route::post('/destroy/ofertas/id', [OfertasController::class, 'botao_excluir_oferta']);
Route::get('/filtrar/ofertas', [OfertasController::class, 'filtrar']);

                            /* Despesas */
Route::get('/despesas', [DespesasController::class, 'despesas']);
Route::post('/registrar/despesas', [DespesasController::class, 'botao_registrar_despesas']);
Route::post('/destroy/despesas/id', [DespesasController::class, 'botao_excluir_despesas']);
Route::get('/filtrar/despesas/', [DespesasController::class, 'filtrar_despesas']);

                                /*Caixa*/
Route::get('/caixa', [CaixasController::class, 'caixa']);
Route::get('/relatorio', [CaixasController::class, 'relatorio']);
Route::get('/fpdf', [CaixasController::class, 'fpdf']);
Route::post('/filtro/pdf', [CaixasController::class, 'filtrarrelatorio']);
Route::get('/gerar/{dataini}/{datafi}', [CaixasController::class, 'gerar']);
Route::post('/fechar', [CaixasController::class, 'fechar_caixa']);
Route::get('/indexcaixa', [CaixasController::class, 'indexcaixa']);
Route::post('/destroy/caixa/{id}', [CaixasController::class, 'destroy_caixa']);




                             /* LOGIN*/

Route::post('/login/if', [ControllerIgreja::class, 'authenticate']);
Route::get('/cadastro/login', [ControllerIgreja::class, 'form_login']);
Route::post('/cadastro/user', [ControllerIgreja::class, 'cadastro_user']);
Route::get('/login', [ControllerIgreja::class, 'login'])->name('login');

