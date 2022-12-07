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
    return \Illuminate\Support\Facades\Auth::guest()
        ? redirect("/login")
        : redirect(\App\Providers\RouteServiceProvider::DASHBOARD);
});

Auth::routes();

/*
 * Dashboard
 */
Route::get('/dashboard', \App\Http\Livewire\Views\Dashboard::class);

/*
 * Notebooks
 */
Route::get('/notebooks', \App\Http\Livewire\Views\Notebooks\NotebookList::class);
Route::get('/notebooks/{notebookId}', \App\Http\Livewire\Views\Notebooks\Notebook::class);
Route::get('/notebooks/{notebookId}/{noteId}', \App\Http\Livewire\Views\Notebooks\Note::class);
