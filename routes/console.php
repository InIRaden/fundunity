<?php

use App\Console\Commands\UpdateExpiredCampaigns;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Setiap hari tengah malam, cek campaign yang sudah melewati deadline dan ubah statusnya ke 'selesai'
Schedule::command(UpdateExpiredCampaigns::class)->dailyAt('00:05')->withoutOverlapping();
