<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class EnsurePublicSiteAvailable
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->shouldBypass($request) || ! Schema::hasTable('site_settings')) {
            return $next($request);
        }

        $maintenanceMode = SiteSetting::query()
            ->where('key', 'maintenance_mode')
            ->value('value');

        if ($maintenanceMode !== '1') {
            return $next($request);
        }

        $maintenanceMessage = SiteSetting::query()
            ->where('key', 'maintenance_message')
            ->value('value');

        return response()->view('maintenance', [
            'message' => $maintenanceMessage ?: 'Website sedang dalam pemeliharaan. Silakan kembali lagi nanti.',
        ], 503);
    }

    private function shouldBypass(Request $request): bool
    {
        return $request->is('admin')
            || $request->is('admin/*')
            || $request->is('api')
            || $request->is('api/*')
            || $request->is('login')
            || $request->is('register')
            || $request->is('logout')
            || $request->is('password/*')
            || $request->is('forgot-password')
            || $request->is('reset-password/*')
            || $request->is('verify-email')
            || $request->is('email/*')
            || $request->is('up')
            || $request->is('storage/*');
    }
}
