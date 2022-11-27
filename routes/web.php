<?php

use Illuminate\Support\Facades\Route;

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


Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index']);

Route::get('/notebooks', [\App\Http\Controllers\NotebookController::class, 'index']);
Route::get('/notebooks/{id}', [\App\Http\Controllers\NotebookController::class, 'show']);
Route::get('/notebooks/{notebook_id}/{note_id}', [\App\Http\Controllers\NotebookController::class, 'note']);
