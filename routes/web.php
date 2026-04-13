<?php

use App\Http\Controllers\Admin\ProgramController as AdminProgramController;
use App\Http\Controllers\Admin\FocusAreaController as AdminFocusAreaController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\GalleryItemController as AdminGalleryItemController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\AboutUsController as AdminAboutUsController;
use App\Http\Controllers\Admin\ImageSliderController as AdminImageSliderController;
use App\Http\Controllers\Admin\AdminUiController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Auth;
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
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        // Static dashboard data aligned with React Home component
        $stats = [
            [
                'icon' => 'ph ph-wallet',
                'title' => 'Total Dana Terkumpul',
                'value' => 'Rp 1.460 Juta',
                'change' => '+24% vs Bln lalu',
                'trend' => 'up'
            ],
            [
                'icon' => 'ph ph-hand-heart',
                'title' => 'Telah Disalurkan',
                'value' => 'Rp 1.120 Juta',
                'change' => '76% Tersalur',
                'trend' => 'up'
            ],
            [
                'icon' => 'ph ph-chart-line-up',
                'title' => 'Campaign Berjalan',
                'value' => '18 Aktif',
                'change' => '2 Hampir Timeout',
                'trend' => 'down'
            ],
            [
                'icon' => 'ph ph-users',
                'title' => 'Basis Donatur',
                'value' => '12.450',
                'change' => '+142 Minggu ini',
                'trend' => 'up'
            ]
        ];

        $selectedFilter = '6 Bulan Terakhir';
        $filterOpen = false;
        $filterOptions = ['6 Bulan Terakhir', 'Tahun Ini', 'Tahun Lalu'];

        $pageMeta = [
            'title' => 'Dashboard Admin',
            'subtitle' => 'Pantau metrik dan aktivitas FundUnity'
        ];

        return view('admin.home', compact('stats', 'selectedFilter', 'filterOpen', 'filterOptions', 'pageMeta'))->with('sidebarWidth', '256px');
    })->name('dashboard');
    Route::get('/settings', function () {
        $pageMeta = [
            'title' => 'Pengaturan Admin',
            'subtitle' => 'Kelola pengaturan sistem FundUnity'
        ];
        $user = Auth::user();
        return view('admin.settings', compact('pageMeta', 'user'))->with('sidebarWidth', '256px');
    })->name('settings');

    // Converted admin pages from React app flow
    Route::get('/campaign', [AdminUiController::class, 'campaign'])->name('campaign');
    Route::post('/campaign', [AdminCampaignController::class, 'store'])->name('campaign.store');
    Route::put('/campaign/{campaign}', [AdminCampaignController::class, 'update'])->name('campaign.update');
    Route::delete('/campaign/{campaign}', [AdminCampaignController::class, 'destroy'])->name('campaign.destroy');

    Route::get('/keuangantransparansi', [AdminUiController::class, 'keuanganTransparansi'])->name('keuangantransparansi');
    Route::get('/databasestakeholder', [AdminUiController::class, 'databaseStakeholder'])->name('databasestakeholder');

    Route::get('/messages', [AdminUiController::class, 'messages'])->name('messages');
    Route::post('/messages', [AdminMessageController::class, 'store'])->name('messages.store');
    Route::put('/messages/{message}', [AdminMessageController::class, 'update'])->name('messages.update');
    Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

    Route::get('/notifications', [AdminUiController::class, 'notifications'])->name('notifications');

    Route::get('/aboutus', [AdminUiController::class, 'aboutUs'])->name('aboutus');
    Route::post('/aboutus', [AdminAboutUsController::class, 'store'])->name('aboutus.store');
    Route::put('/aboutus/{aboutUsItem}', [AdminAboutUsController::class, 'update'])->name('aboutus.update');
    Route::delete('/aboutus/{aboutUsItem}', [AdminAboutUsController::class, 'destroy'])->name('aboutus.destroy');

    Route::get('/focusareas', [AdminUiController::class, 'focusAreas'])->name('focusareas');
    Route::post('/focusareas', [AdminFocusAreaController::class, 'storeFromAdminPage'])->name('focusareas.store');
    Route::put('/focusareas/{focusArea}', [AdminFocusAreaController::class, 'updateFromAdminPage'])->name('focusareas.update');
    Route::delete('/focusareas/{focusArea}', [AdminFocusAreaController::class, 'destroyFromAdminPage'])->name('focusareas.destroy');

    Route::get('/faqs', [AdminUiController::class, 'faqs'])->name('faqs');
    Route::get('/partners', [AdminUiController::class, 'partners'])->name('partners');
    Route::get('/gallery', [AdminUiController::class, 'gallery'])->name('gallery');
    Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{galleryItem}', [AdminGalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{galleryItem}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/imageslider', [AdminUiController::class, 'imageSlider'])->name('imageslider');
    Route::post('/imageslider', [AdminImageSliderController::class, 'store'])->name('imageslider.store');
    Route::put('/imageslider/{imageSlider}', [AdminImageSliderController::class, 'update'])->name('imageslider.update');
    Route::delete('/imageslider/{imageSlider}', [AdminImageSliderController::class, 'destroy'])->name('imageslider.destroy');

    Route::get('/identity', [AdminUiController::class, 'websiteIdentity'])->name('identity');
    Route::get('/landing-manager', [AdminUiController::class, 'landingManager'])->name('landing-manager');

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

require __DIR__.'/auth.php';
