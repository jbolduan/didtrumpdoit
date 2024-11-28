<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLevelController;
use App\Http\Controllers\StatementController;
use App\Models\Statement;
use App\Http\Resources\StatementResource;
use App\Http\Resources\StatementCollection;

Route::get('/', [StatementController::class, 'showMainPage'])
    ->withoutMiddleware('auth')
    ->name('main');

Route::view('open-data', 'open_data')
    ->withoutMiddleware('auth')
    ->name('open-data');

Route::view('submit-statement', 'submit_statement')
    ->withoutMiddleware('auth')
    ->name('submit-statement');

Route::view('about', 'about')
    ->withoutMiddleware('auth')
    ->name('about');

Route::prefix('/api')->group( function() {
    Route::view('/', 'api.index')->withoutMiddleware('auth')->name('api');
    
    Route::get('/statements', function() {
        return new StatementCollection(Statement::all());
    });

    Route::get('/statement/{id}', function($id) {
        return new StatementResource(Statement::find($id));
    });
});

Route::prefix('/statements')->group(function () {
    Route::get('/', [StatementController::class, 'indexPublic'])
        ->withoutMiddleware('auth')
        ->name('statements.index');

    Route::post('/', [StatementController::class, 'storePublic'])
        ->withoutMiddleware('auth')
        ->name('statements.storePublic');

    Route::get('/create', [StatementController::class, 'createPublic'])
        ->withoutMiddleware('auth')
        ->name('statements.createPublic');
    
    Route::get('/{statement}', [StatementController::class, 'showPublic'])
        ->withoutMiddleware('auth')
        ->name('statements.showPublic');
});

Auth::routes();

Route::get('/admin', [AdminController::class, 'index'])
    ->middleware('auth')
    ->name('admin');

Route:
Route::prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class)
        ->middleware('auth');

    Route::prefix('statements')->group( function() {
        Route::get('/', [StatementController::class, 'index'])
            ->middleware('auth')
            ->name('admin.statements.index');

        Route::post('/', [StatementController::class, 'store'])
            ->middleware('auth')
            ->name('admin.statements.store');

        Route::get('/create', [StatementController::class, 'create'])
            ->middleware('auth')
            ->name('admin.statements.create');
        
        Route::get('/{statement}', [StatementController::class, 'show'])
            ->middleware('auth')
            ->name('admin.statements.show');

        Route::get('/{statement}/edit', [StatementController::class, 'edit'])
            ->middleware('auth')
            ->name('admin.statements.edit');

        Route::put('/{statement}', [StatementController::class, 'update'])
            ->middleware('auth')
            ->name('admin.statements.update');
    });

    // Route::resource('admin.statements', StatementController::class)
    //     ->middleware('auth');

    Route::resource('statuses', StatusController::class)
        ->middleware('auth');
})->middleware('auth')->name('admin');

Route::prefix('admin')->group(function () {});

Route::get('/users', [UserController::class, 'index'])
    ->middleware('auth')
    ->name('users.index');

Route::get('/users/{user}/edit', [UserLevelController::class, 'edit'])
    ->middleware('auth')
    ->name('userlevels.edit');

Route::put('/users/{user}', [UserLevelController::class, 'update'])
    ->middleware('auth')
    ->name('userlevels.update');

Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->middleware('auth')
    ->name('users.destroy');
