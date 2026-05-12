```php
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Middleware\LogAdminCrudActivity;

use App\Http\Controllers\LandingController;

use App\Http\Controllers\Admin\AdminUiController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;

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

/*
|--------------------------------------------------------------------------
| PUBLIC / LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/allprograms', [LandingController::class, 'programs'])->name('programs');
Route::get('/focusareas', [LandingController::class, 'focusAreas'])->name('focus-areas');
Route::get('/moregallery', [LandingController::class, 'gallery'])->name('gallery');
Route::get('/partners', [LandingController::class, 'partners'])->name('partners');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
Route::post('/contact', [LandingController::class, 'submitContact'])->name('contact.store');

Route::get('/faqs', [LandingController::class, 'faq'])->name('faq');

Route::get('/getinvolved', [LandingController::class, 'getInvolved'])->name('get-involved');
Route::post('/getinvolved', [LandingController::class, 'submitGetInvolved'])->name('get-involved.store');

Route::get('/donasi/{campaign?}', [LandingController::class, 'donationForm'])->name('donation.form');
Route::post('/donasi', [LandingController::class, 'submitDonation'])->name('donation.store');

/*
|--------------------------------------------------------------------------
| OPTIONAL LANDING PREFIX
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| ADMIN PANEL
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', LogAdminCrudActivity::class])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminUiController::class, 'dashboard'])->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Settings
        |--------------------------------------------------------------------------
        */

        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
        Route::post('/settings/profile', [AdminSettingsController::class, 'updateProfile'])->name('settings.profile.update');
        Route::post('/settings/identity', [AdminSettingsController::class, 'updateIdentity'])->name('settings.identity.update');
        Route::post('/settings/payment', [AdminSettingsController::class, 'updatePayment'])->name('settings.payment.update');
        Route::post('/settings/seo', [AdminSettingsController::class, 'updateSeo'])->name('settings.seo.update');
        Route::post('/settings/security', [AdminSettingsController::class, 'updateSecurity'])->name('settings.security.update');

        /*
        |--------------------------------------------------------------------------
        | Admin UI Pages
        |--------------------------------------------------------------------------
        */

        Route::get('/campaign', [AdminUiController::class, 'campaign'])->name('campaign');
        Route::get('/keuangantransparansi', [AdminUiController::class, 'keuanganTransparansi'])->name('keuangantransparansi');
        Route::get('/databasestakeholder', [AdminUiController::class, 'databaseStakeholder'])->name('databasestakeholder');
        Route::get('/messages', [AdminUiController::class, 'messages'])->name('messages');
        Route::get('/aboutus', [AdminUiController::class, 'aboutUs'])->name('aboutus');
        Route::get('/focusareas', [AdminUiController::class, 'focusAreas'])->name('focusareas');
        Route::get('/faqs', [AdminUiController::class, 'faqs'])->name('faqs');
        Route::get('/partners', [AdminUiController::class, 'partners'])->name('partners');
        Route::get('/gallery', [AdminUiController::class, 'gallery'])->name('gallery');
        Route::get('/imageslider', [AdminUiController::class, 'imageSlider'])->name('imageslider');

        /*
        |--------------------------------------------------------------------------
        | Campaign CRUD
        |--------------------------------------------------------------------------
        */

        Route::post('/campaign', [AdminCampaignController::class, 'store'])->name('campaign.store');
        Route::put('/campaign/{campaign}', [AdminCampaignController::class, 'update'])->name('campaign.update');
        Route::delete('/campaign/{campaign}', [AdminCampaignController::class, 'destroy'])->name('campaign.destroy');

        /*
        |--------------------------------------------------------------------------
        | Stakeholder CRUD
        |--------------------------------------------------------------------------
        */

        Route::post('/databasestakeholder/{type}', [AdminStakeholderController::class, 'store'])->name('databasestakeholder.store');
        Route::put('/databasestakeholder/{type}/{id}', [AdminStakeholderController::class, 'update'])->name('databasestakeholder.update');
        Route::delete('/databasestakeholder/{type}/{id}', [AdminStakeholderController::class, 'destroy'])->name('databasestakeholder.destroy');

        /*
        |--------------------------------------------------------------------------
        | Messages CRUD
        |--------------------------------------------------------------------------
        */

        Route::post('/messages', [AdminMessageController::class, 'store'])->name('messages.store');
        Route::put('/messages/{message}', [AdminMessageController::class, 'update'])->name('messages.update');
        Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

        /*
        |--------------------------------------------------------------------------
        | About Us CRUD
        |--------------------------------------------------------------------------
        */

        Route::post('/aboutus', [AdminAboutUsController::class, 'store'])->name('aboutus.store');
        Route::put('/aboutus/{aboutUsItem}', [AdminAboutUsController::class, 'update'])->name('aboutus.update');
        Route::delete('/aboutus/{aboutUsItem}', [AdminAboutUsController::class, 'destroy'])->name('aboutus.destroy');

        /*
        |--------------------------------------------------------------------------
        | Focus Areas CRUD
        |--------------------------------------------------------------------------
        */

        Route::post('/focusareas', [AdminFocusAreaController::class, 'storeFromAdminPage'])->name('focusareas.store');
        Route::put('/focusareas/{focusArea}', [AdminFocusAreaController::class, 'updateFromAdminPage'])->name('focusareas.update');
        Route::delete('/focusareas/{focusArea}', [AdminFocusAreaController::class, 'destroyFromAdminPage'])->name('focusareas.destroy');

        /*
        |--------------------------------------------------------------------------
        | FAQ CRUD
        |--------------------------------------------------------------------------
        */

        Route::post('/faqs', [AdminFaqController::class, 'store'])->name('faqs.store');
        Route::put('/faqs/{faq}', [AdminFaqController::class, 'update'])->name('faqs.update');
        Route::delete('/faqs/{faq}', [AdminFaqController::class, 'destroy'])->name('faqs.destroy');

        /*
        |--------------------------------------------------------------------------
        | Partner CRUD
        |--------------------------------------------------------------------------
        */

        Route::post('/partners', [AdminPartnerController::class, 'store'])->name('partners.store');
        Route::put('/partners/{partner}', [AdminPartnerController::class, 'update'])->name('partners.update');
        Route::delete('/partners/{partner}', [AdminPartnerController::class, 'destroy'])->name('partners.destroy');

        /*
        |--------------------------------------------------------------------------
        | Gallery CRUD
        |--------------------------------------------------------------------------
        */

        Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
        Route::put('/gallery/{galleryItem}', [AdminGalleryController::class, 'update'])->name('gallery.update');
        Route::delete('/gallery/{galleryItem}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

        /*
        |--------------------------------------------------------------------------
        | Image Slider CRUD
        |--------------------------------------------------------------------------
        */

        Route::post('/imageslider', [AdminImageSliderController::class, 'store'])->name('imageslider.store');
        Route::put('/imageslider/{imageSlider}', [AdminImageSliderController::class, 'update'])->name('imageslider.update');
        Route::delete('/imageslider/{imageSlider}', [AdminImageSliderController::class, 'destroy'])->name('imageslider.destroy');

        /*
        |--------------------------------------------------------------------------
        | Resource Routes
        |--------------------------------------------------------------------------
        */

        Route::resource('programs', AdminProgramController::class)->except(['show']);
        Route::resource('focus-areas', AdminFocusAreaController::class)->except(['show']);
        Route::resource('gallery-items', AdminGalleryItemController::class)->except(['show']);
    });

/*
|--------------------------------------------------------------------------
| NEWSLETTER + LEGAL
|--------------------------------------------------------------------------
*/

Route::post('/newsletter/subscribe', [LandingController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

Route::get('/privacy', [LandingController::class, 'privacy'])->name('privacy');
Route::get('/terms', [LandingController::class, 'terms'])->name('terms');

/*
|--------------------------------------------------------------------------
| REDIRECT USER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

require __DIR__ . '/auth.php';