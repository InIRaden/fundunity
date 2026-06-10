<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\Donor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController
{
    /**
     * Get monthly donation trend data
     */
    public function getDonationTrend(Request $request): JsonResponse
    {
        try {
            $filter = $request->query('filter', '6 Bulan Terakhir');
            $currentMonth = now();
            
            if ($filter === 'Tahun Ini') {
                $months = max(1, $currentMonth->month);
            } elseif ($filter === 'Tahun Lalu') {
                $months = 12;
                $currentMonth = now()->subYear()->endOfYear();
            } elseif ($filter === '3 Bulan Terakhir') {
                $months = 3;
            } else {
                $months = 6; // Default 6 Bulan Terakhir
            }
            
            $monthlyData = [];

            // Generate past months
            for ($i = $months - 1; $i >= 0; $i--) {
                $date = $currentMonth->copy()->subMonths($i);
                $monthKey = $date->format('Y-m');
                $monthLabel = $date->format('M Y');

                // Get campaigns created or active in this month
                $campaignAmount = Campaign::query()
                    ->whereMonth('created_at', $date->month)
                    ->whereYear('created_at', $date->year)
                    ->sum('collected');

                // Get donors active in this month
                $donorAmount = Donor::query()
                    ->whereMonth('last_donation', $date->month)
                    ->whereYear('last_donation', $date->year)
                    ->sum('total_donation');

                // Combine data (net donation = campaign collected + donor contributions)
                $totalAmount = ($campaignAmount + $donorAmount) / 2; // Average to simulate net after fees

                $monthlyData[] = [
                    'month' => $monthLabel,
                    'monthKey' => $monthKey,
                    'amount' => max(0, intval($totalAmount)), // Ensure no negative values
                    'formatted' => 'Rp ' . number_format(max(0, intval($totalAmount)), 0, ',', '.'),
                ];
            }

            // Calculate stats
            $totalAmount = array_sum(array_column($monthlyData, 'amount'));
            $avgAmount = count($monthlyData) > 0 ? intval($totalAmount / count($monthlyData)) : 0;
            $maxAmount = max(array_column($monthlyData, 'amount')) ?: 0;

            return response()->json([
                'success' => true,
                'data' => $monthlyData,
                'stats' => [
                    'total' => $totalAmount,
                    'totalFormatted' => 'Rp ' . number_format($totalAmount, 0, ',', '.'),
                    'average' => $avgAmount,
                    'averageFormatted' => 'Rp ' . number_format($avgAmount, 0, ',', '.'),
                    'max' => $maxAmount,
                    'maxFormatted' => 'Rp ' . number_format($maxAmount, 0, ',', '.'),
                ],
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Crash in getDonationTrend: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem.'], 500);
        }
    }

    /**
     * Get KPI stats for dashboard
     */
    public function getKpiStats(): JsonResponse
    {
        try {
            $campaigns = Campaign::where('is_active', true)->count();
            $donors = Donor::where('is_active', true)->count();
            $totalCollected = Campaign::where('is_active', true)->sum('collected');
            $activePrograms = Campaign::where('status', 'aktif')->count();

            return response()->json([
                'campaigns' => $campaigns,
                'donors' => $donors,
                'totalCollected' => $totalCollected,
                'totalCollectedFormatted' => 'Rp ' . number_format($totalCollected, 0, ',', '.'),
                'activePrograms' => $activePrograms,
            ]);
        } catch (\Throwable $e) {
            \Illuminate\Support\Facades\Log::error('Crash in getKpiStats: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan sistem.'], 500);
        }
    }
}
