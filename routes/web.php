<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MatchController;
use App\Http\Controllers\SwipeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;

// Public landing + pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/features', [PageController::class, 'features'])->name('features');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/browse', [PageController::class, 'browse'])->name('browse'); // list profiles
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Auth-protected user pages (existing)
Route::middleware(['auth','blocked'])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Matches
    Route::get('/matches', [MatchController::class, 'index'])->name('matches.index');
    Route::get('/matches/{id}', [MatchController::class, 'view'])->name('matches.view');

    // Swipe
    Route::get('/swipe', [SwipeController::class, 'index'])->name('swipe');
    Route::get('/swipe/next', [SwipeController::class, 'next'])->name('swipe.next');
    Route::post('/swipe/action', [SwipeController::class, 'swipe'])->name('swipe.action');
});

// Admin routes (existing)
Route::middleware(['auth','admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::post('/settings/save', [SettingController::class, 'save'])->name('admin.settings.save');

    // user management
    Route::post('/users/{id}/block', [UserController::class, 'block'])->name('admin.users.block');
    Route::post('/users/{id}/unblock', [UserController::class, 'unblock'])->name('admin.users.unblock');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
    Route::get('/users/{id}/view', [UserController::class, 'view'])->name('admin.users.view');
    Route::get('/blocked-users', [UserController::class, 'blocked'])->name('admin.blocked.users');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/users/{id}/edit', [UserController::class, 'update'])->name('admin.users.update');
});

require __DIR__.'/auth.php';
