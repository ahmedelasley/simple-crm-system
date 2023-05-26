<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth'] ], function () {

    Route::resources([
        'users'     => UserController::class,
        'clients'   => ClientController::class,
        'projects'  => ProjectController::class,
        'tasks'     => TaskController::class,
    ]);

    Route::get('/clients/{client}', [ClientController::class, 'archive'])->name('clients.archive');
    Route::get('/projects/{project}', [ProjectController::class, 'archive'])->name('projects.archive');
    Route::get('/tasks/{task}', [TaskController::class, 'archive'])->name('tasks.archive');
    Route::get('/tasks/{task}/completed', [TaskController::class, 'completed'])->name('tasks.completed');

    Route::get('/archives/clients', [ClientController::class, 'archiveList'])->name('clients.archiveList');
    Route::get('/archives/projects', [ProjectController::class, 'archiveList'])->name('projects.archiveList');
    Route::get('/archives/tasks', [TaskController::class, 'archiveList'])->name('tasks.archiveList');

    Route::get('/archives/clients/restore/{id}', [ClientController::class, 'restore'])->name('clients.restore');
    Route::get('/archives/clients/restoreAll', [ClientController::class, 'restoreAll'])->name('clients.restoreAll');

    Route::get('/archives/projects/restore/{id}', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::get('/archives/projects/restoreAll', [ProjectController::class, 'restoreAll'])->name('projects.restoreAll');

    Route::get('/archives/tasks/restore/{id}', [TaskController::class, 'restore'])->name('tasks.restore');
    Route::get('/archives/tasks/restoreAll', [TaskController::class, 'restoreAll'])->name('tasks.restoreAll');

});