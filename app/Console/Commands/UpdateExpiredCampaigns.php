<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class UpdateExpiredCampaigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:update-expired
                            {--dry-run : Preview changes without saving}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically mark active campaigns as selesai when their deadline has passed.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $isDryRun = $this->option('dry-run');
        $today = Carbon::today()->toDateString();

        // Find all campaigns that are still "aktif" but deadline < today
        $expired = Campaign::where('status', 'aktif')
            ->whereDate('deadline', '<', $today)
            ->get();

        if ($expired->isEmpty()) {
            $this->info('✅ Tidak ada campaign yang perlu diperbarui.');
            return Command::SUCCESS;
        }

        $this->table(
            ['ID', 'Title', 'Deadline', 'Status Lama', 'Status Baru'],
            $expired->map(fn (Campaign $c) => [
                $c->id,
                \Illuminate\Support\Str::limit($c->title, 40),
                $c->deadline->toDateString(),
                $c->status,
                'selesai',
            ])
        );

        if ($isDryRun) {
            $this->warn("🔍 Dry-run mode: {$expired->count()} campaign akan diubah ke 'selesai'. Tidak ada yang disimpan.");
            return Command::SUCCESS;
        }

        // Bulk update: mark as selesai
        $updated = Campaign::where('status', 'aktif')
            ->whereDate('deadline', '<', $today)
            ->update(['status' => 'selesai']);

        $this->info("✅ {$updated} campaign berhasil diubah statusnya menjadi 'selesai'.");

        return Command::SUCCESS;
    }
}
