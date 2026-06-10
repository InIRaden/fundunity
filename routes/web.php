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
use App\Http\Controllers\Admin\TeamMemberController as AdminTeamMemberController;
use App\Http\Controllers\Admin\AdminUiController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ForceChangePasswordController;
use App\Http\Controllers\Admin\AdminManagementController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LegalController;
use Illuminate\Support\Facades\Route;

// Landing Page Routes
Route::prefix('landing')->name('landing.')->group(function () {
    Route::get('/', [LandingController::class, 'index'])->name('home');
    Route::get('/about', [LandingController::class, 'about'])->name('about');
    Route::get('/team', [LandingController::class, 'team'])->name('team');
    Route::get('/all-programs', [LandingController::class, 'programs'])->name('programs');
    Route::get('/focus-areas', [LandingController::class, 'focusAreas'])->name('focus-areas');
    Route::get('/gallery', [LandingController::class, 'gallery'])->name('gallery');
    Route::get('/partners', [LandingController::class, 'partners'])->name('partners');
    Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
    Route::get('/faqs', [LandingController::class, 'faq'])->name('faq');
    Route::get('/get-involved', [LandingController::class, 'getInvolved'])->name('get-involved');
    Route::get('/donate', [LandingController::class, 'donationForm'])->name('donate');
    Route::get('/program/{campaign}', [LandingController::class, 'campaignDetail'])->name('program.detail');
    Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');
    Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
});

// Legacy top-level routes (keep for backward compat)
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/team', [LandingController::class, 'team'])->name('team');
Route::get('/all-programs', [LandingController::class, 'programs'])->name('programs');
Route::get('/focus-areas', [LandingController::class, 'focusAreas'])->name('focus-areas');
Route::get('/more-gallery', [LandingController::class, 'gallery'])->name('gallery');
Route::get('/partners', [LandingController::class, 'partners'])->name('partners');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
Route::post('/contact', [LandingController::class, 'submitContact'])->name('contact.store')->middleware('throttle:5,1');
Route::get('/program/{campaign}', [LandingController::class, 'campaignDetail'])->name('campaign.detail');
Route::get('/donasi/{campaign?}', [LandingController::class, 'donationForm'])->name('donation.form');
Route::post('/donasi', [LandingController::class, 'submitDonation'])->name('donation.store')->middleware('throttle:5,1');
Route::get('/faqs', [LandingController::class, 'faq'])->name('faq');
Route::get('/get-involved', [LandingController::class, 'getInvolved'])->name('get-involved');
Route::post('/get-involved', [LandingController::class, 'submitGetInvolved'])->name('get-involved.store')->middleware('throttle:5,1');
Route::get('/privacy', [LegalController::class, 'privacy'])->name('privacy');
Route::get('/terms', [LegalController::class, 'terms'])->name('terms');
Route::get('/manifest.json', [LandingController::class, 'manifest'])->name('manifest');
Route::get('/sw.js', [LandingController::class, 'serviceWorker'])->name('serviceWorker');
Route::get('/offline', [LandingController::class, 'offlineFallback'])->name('offlineFallback');

// Super Simple Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'force-change-password'])->group(function () {
    // Halaman wajib ganti sandi (tidak perlu force-change-password middleware lagi)
    Route::get('/force-change-password', [ForceChangePasswordController::class, 'show'])->name('force-change-password')->withoutMiddleware('force-change-password');
    Route::post('/force-change-password', [ForceChangePasswordController::class, 'update'])->name('force-change-password.update')->withoutMiddleware('force-change-password');

    // Manajemen Admin - hanya Super Admin
    Route::get('/management', [AdminManagementController::class, 'index'])->name('management')->middleware('super-admin');
    Route::post('/management', [AdminManagementController::class, 'store'])->name('management.store')->middleware('super-admin');
    Route::post('/management/{admin}/reset-password', [AdminManagementController::class, 'resetPassword'])->name('management.reset-password')->middleware('super-admin');
    Route::delete('/management/{admin}', [AdminManagementController::class, 'destroy'])->name('management.destroy')->middleware('super-admin');

    Route::get('/dashboard', [AdminUiController::class, 'dashboard'])->name('dashboard');
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
    Route::post('/settings/profile', [AdminSettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/identity', [AdminSettingsController::class, 'updateIdentity'])->name('settings.identity.update');
    Route::post('/settings/payment', [AdminSettingsController::class, 'updatePayment'])->name('settings.payment.update');
    Route::post('/settings/seo', [AdminSettingsController::class, 'updateSeo'])->name('settings.seo.update');
    Route::post('/settings/security', [AdminSettingsController::class, 'updateSecurity'])->name('settings.security.update');
    Route::post('/settings/menu', [AdminSettingsController::class, 'updateMenu'])->name('settings.menu.update');

    // Legal management routes
    Route::get('/legal', [AdminUiController::class, 'legal'])->name('legal');
    Route::post('/legal', [AdminSettingsController::class, 'updateLegal'])->name('legal.update');

    // Dashboard API endpoints
    Route::get('/api/donation-trend', [AdminDashboardController::class, 'getDonationTrend'])->name('api.donation-trend');
    Route::get('/api/kpi-stats', [AdminDashboardController::class, 'getKpiStats'])->name('api.kpi-stats');

    // Converted admin pages from React app flow
    Route::get('/campaign', [AdminUiController::class, 'campaign'])->name('campaign');
    Route::post('/campaign', [AdminCampaignController::class, 'store'])->name('campaign.store');
    Route::put('/campaign/{campaign}', [AdminCampaignController::class, 'update'])->name('campaign.update');
    Route::delete('/campaign/{campaign}', [AdminCampaignController::class, 'destroy'])->name('campaign.destroy');
    
    Route::post('/campaign/{campaign}/updates', [\App\Http\Controllers\Admin\CampaignUpdateController::class, 'store'])->name('campaign.updates.store');
    Route::delete('/campaign/updates/{update}', [\App\Http\Controllers\Admin\CampaignUpdateController::class, 'destroy'])->name('campaign.updates.destroy');

    Route::get('/identity', [AdminUiController::class, 'websiteIdentity'])->name('identity'); // Fix: route hilang

    Route::get('/keuangan-transparansi', [AdminUiController::class, 'keuanganTransparansi'])->name('keuangantransparansi');
    Route::get('/database-stakeholder', [AdminUiController::class, 'databaseStakeholder'])->name('databasestakeholder');
    Route::post('/database-stakeholder/{type}', [AdminStakeholderController::class, 'store'])->name('databasestakeholder.store');
    Route::put('/database-stakeholder/{type}/{id}', [AdminStakeholderController::class, 'update'])->name('databasestakeholder.update');
    Route::delete('/database-stakeholder/{type}/{id}', [AdminStakeholderController::class, 'destroy'])->name('databasestakeholder.destroy');

    Route::get('/messages', [AdminUiController::class, 'messages'])->name('messages');
    Route::post('/messages', [AdminMessageController::class, 'store'])->name('messages.store');
    Route::put('/messages/{message}', [AdminMessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');


    Route::get('/about-us', [AdminUiController::class, 'aboutUs'])->name('aboutus');
    Route::post('/about-us', [AdminAboutUsController::class, 'store'])->name('aboutus.store');
    Route::put('/about-us/{aboutUsItem}', [AdminAboutUsController::class, 'update'])->name('aboutus.update');
    Route::delete('/about-us/{aboutUsItem}', [AdminAboutUsController::class, 'destroy'])->name('aboutus.destroy');

    Route::get('/members', [AdminUiController::class, 'members'])->name('members');
    Route::post('/members', [AdminTeamMemberController::class, 'store'])->name('members.store');
    Route::put('/members/{teamMember}', [AdminTeamMemberController::class, 'update'])->name('members.update');
    Route::delete('/members/{teamMember}', [AdminTeamMemberController::class, 'destroy'])->name('members.destroy');

    Route::get('/focus-areas', [AdminUiController::class, 'focusAreas'])->name('focusareas');
    Route::post('/focus-areas', [AdminFocusAreaController::class, 'store'])->name('focusareas.store');
    Route::put('/focus-areas/{focusArea}', [AdminFocusAreaController::class, 'update'])->name('focusareas.update');
    Route::delete('/focus-areas/{focusArea}', [AdminFocusAreaController::class, 'destroy'])->name('focusareas.destroy');

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

    Route::get('/image-slider', [AdminUiController::class, 'imageSlider'])->name('imageslider');
    Route::post('/image-slider', [AdminImageSliderController::class, 'store'])->name('imageslider.store');
    Route::put('/image-slider/{imageSlider}', [AdminImageSliderController::class, 'update'])->name('imageslider.update');
    Route::delete('/image-slider/{imageSlider}', [AdminImageSliderController::class, 'destroy'])->name('imageslider.destroy');
});

// Newsletter Route
Route::post('/newsletter/subscribe', [LandingController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// Dashboard Route - Redirect to Admin Dashboard
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth');

require __DIR__.'/auth.php';
