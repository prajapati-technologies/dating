<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\SwipeController;
use App\Http\Controllers\Admin\SettingController;
use App\Models\Setting;

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $settings = Setting::first();
    return view('landing', compact('settings'));
});

/*
|--------------------------------------------------------------------------
| User Auth Required Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | User Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | Matches Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
    Route::get('/matches/{id}', [MatchController::class, 'view'])->name('matches.view');


    /*
    |--------------------------------------------------------------------------
    | Swipe Routes (Tinder Style)
    |--------------------------------------------------------------------------
    */
    Route::get('/swipe', function () {
        return view('swipe.index');
    })->name('swipe');

    Route::get('/swipe/next', [SwipeController::class, 'next'])->name('swipe.next');
    Route::post('/swipe/action', [SwipeController::class, 'swipe'])->name('swipe.action');

});


/*
|--------------------------------------------------------------------------
| Admin Panel (Only Admin Users)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', [AdminController::class, 'index'])
            ->name('admin.dashboard');

        // User Management
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/blocked-users', [UserController::class, 'blocked'])->name('admin.blocked.users');
        Route::get('/users/{id}/view', [UserController::class, 'view'])->name('admin.users.view');

        Route::post('/users/{id}/block', [UserController::class, 'block'])->name('admin.users.block');
        Route::post('/users/{id}/unblock', [UserController::class, 'unblock'])->name('admin.users.unblock');
        Route::delete('/users/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
        Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [SettingController::class, 'update'])->name('admin.settings.update');
    });

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
