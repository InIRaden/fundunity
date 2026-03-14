<?php

use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

// Landing Page Routes
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/allprograms', [LandingController::class, 'programs'])->name('programs');
Route::get('/focusareas', [LandingController::class, 'focusAreas'])->name('focus-areas');
Route::get('/moregallery', [LandingController::class, 'gallery'])->name('gallery');
Route::get('/partners', [LandingController::class, 'partners'])->name('partners');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
Route::get('/faqs', [LandingController::class, 'faq'])->name('faq');
Route::get('/getinvolved', [LandingController::class, 'getInvolved'])->name('get-involved');

// Super Simple Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('programs', AdminProgramController::class)->except(['show']);
});

// Newsletter & Legal Routes
Route::post('/newsletter/subscribe', [LandingController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
Route::get('/privacy', [LandingController::class, 'privacy'])->name('privacy');
Route::get('/terms', [LandingController::class, 'terms'])->name('terms');

// Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
