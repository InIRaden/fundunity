<?php

use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\FocusAreaController as AdminFocusAreaController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\GalleryItemController as AdminGalleryItemController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\AboutUsController as AdminAboutUsController;
use App\Http\Controllers\Admin\ImageSliderController as AdminImageSliderController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\PartnerController as AdminPartnerController;
use App\Http\Controllers\Admin\StakeholderController as AdminStakeholderController;
use App\Http\Controllers\Admin\AdminUiController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
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
Route::post('/contact', [LandingController::class, 'submitContact'])->name('contact.store');
Route::get('/donasi/{campaign?}', [LandingController::class, 'donationForm'])->name('donation.form');
Route::post('/donasi', [LandingController::class, 'submitDonation'])->name('donation.store');
Route::get('/faqs', [LandingController::class, 'faq'])->name('faq');
Route::get('/getinvolved', [LandingController::class, 'getInvolved'])->name('get-involved');
Route::post('/getinvolved', [LandingController::class, 'submitGetInvolved'])->name('get-involved.store');

Route::prefix('landing')->name('landing.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('home');
    Route::get('/about', [LandingController::class, 'about'])->name('about');
    Route::get('/allprograms', [LandingController::class, 'programs'])->name('programs');
    Route::get('/focusareas', [LandingController::class, 'focusAreas'])->name('focus-areas');
    Route::get('/gallery', [LandingController::class, 'gallery'])->name('gallery');
    Route::get('/partners', [LandingController::class, 'partners'])->name('partners');
    Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
    Route::get('/faqs', [LandingController::class, 'faq'])->name('faq');
    Route::get('/getinvolved', [LandingController::class, 'getInvolved'])->name('get-involved');
    Route::post('/getinvolved', [LandingController::class, 'submitGetInvolved'])->name('get-involved.store');
    Route::get('/donate/{campaign?}', [LandingController::class, 'donationForm'])->name('donate');
});

// Super Simple Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminUiController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
    Route::post('/settings/profile', [AdminSettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/identity', [AdminSettingsController::class, 'updateIdentity'])->name('settings.identity.update');
    Route::post('/settings/payment', [AdminSettingsController::class, 'updatePayment'])->name('settings.payment.update');
    Route::post('/settings/seo', [AdminSettingsController::class, 'updateSeo'])->name('settings.seo.update');
    Route::post('/settings/security', [AdminSettingsController::class, 'updateSecurity'])->name('settings.security.update');

    // Converted admin pages from React app flow
    Route::get('/campaign', [AdminUiController::class, 'campaign'])->name('campaign');
    Route::post('/campaign', [AdminCampaignController::class, 'store'])->name('campaign.store');
    Route::put('/campaign/{campaign}', [AdminCampaignController::class, 'update'])->name('campaign.update');
    Route::delete('/campaign/{campaign}', [AdminCampaignController::class, 'destroy'])->name('campaign.destroy');

    Route::get('/keuangantransparansi', [AdminUiController::class, 'keuanganTransparansi'])->name('keuangantransparansi');
    Route::get('/databasestakeholder', [AdminUiController::class, 'databaseStakeholder'])->name('databasestakeholder');
    Route::post('/databasestakeholder/{type}', [AdminStakeholderController::class, 'store'])->name('databasestakeholder.store');
    Route::put('/databasestakeholder/{type}/{id}', [AdminStakeholderController::class, 'update'])->name('databasestakeholder.update');
    Route::delete('/databasestakeholder/{type}/{id}', [AdminStakeholderController::class, 'destroy'])->name('databasestakeholder.destroy');

    Route::get('/messages', [AdminUiController::class, 'messages'])->name('messages');
    Route::post('/messages', [AdminMessageController::class, 'store'])->name('messages.store');
    Route::put('/messages/{message}', [AdminMessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');


    Route::get('/aboutus', [AdminUiController::class, 'aboutUs'])->name('aboutus');
    Route::post('/aboutus', [AdminAboutUsController::class, 'store'])->name('aboutus.store');
    Route::put('/aboutus/{aboutUsItem}', [AdminAboutUsController::class, 'update'])->name('aboutus.update');
    Route::delete('/aboutus/{aboutUsItem}', [AdminAboutUsController::class, 'destroy'])->name('aboutus.destroy');

    Route::get('/focusareas', [AdminUiController::class, 'focusAreas'])->name('focusareas');
    Route::post('/focusareas', [AdminFocusAreaController::class, 'storeFromAdminPage'])->name('focusareas.store');
    Route::put('/focusareas/{focusArea}', [AdminFocusAreaController::class, 'updateFromAdminPage'])->name('focusareas.update');
    Route::delete('/focusareas/{focusArea}', [AdminFocusAreaController::class, 'destroyFromAdminPage'])->name('focusareas.destroy');

    Route::get('/faqs', [AdminUiController::class, 'faqs'])->name('faqs');
    Route::post('/faqs', [AdminFaqController::class, 'store'])->name('faqs.store');
    Route::put('/faqs/{faq}', [AdminFaqController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{faq}', [AdminFaqController::class, 'destroy'])->name('faqs.destroy');
    Route::get('/partners', [AdminUiController::class, 'partners'])->name('partners');
    Route::post('/partners', [AdminPartnerController::class, 'store'])->name('partners.store');
    Route::put('/partners/{partner}', [AdminPartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/{partner}', [AdminPartnerController::class, 'destroy'])->name('partners.destroy');
    Route::get('/gallery', [AdminUiController::class, 'gallery'])->name('gallery');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{galleryItem}', [AdminGalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{galleryItem}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/imageslider', [AdminUiController::class, 'imageSlider'])->name('imageslider');
    Route::post('/imageslider', [AdminImageSliderController::class, 'store'])->name('imageslider.store');
    Route::put('/imageslider/{imageSlider}', [AdminImageSliderController::class, 'update'])->name('imageslider.update');
    Route::delete('/imageslider/{imageSlider}', [AdminImageSliderController::class, 'destroy'])->name('imageslider.destroy');


    Route::resource('programs', AdminProgramController::class)->except(['show']);
    Route::resource('focus-areas', AdminFocusAreaController::class)->except(['show']);
    Route::resource('gallery-items', AdminGalleryItemController::class)->except(['show']);
});

// Newsletter & Legal Routes
Route::post('/newsletter/subscribe', [LandingController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
Route::get('/privacy', [LandingController::class, 'privacy'])->name('privacy');
Route::get('/terms', [LandingController::class, 'terms'])->name('terms');

// Dashboard Route - Redirect to Admin Dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

require __DIR__.'/auth.php';
