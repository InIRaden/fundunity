<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CampaignUpdateController extends Controller
{
    public function store(Request $request, $campaignId)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:200',
            'content'    => 'required|string',
            'image_file' => 'nullable|image|max:2048',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image_file')) {
            $file     = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/updates'), $filename);
            $imageUrl = '/uploads/updates/' . $filename;
        }

        $update = \App\Models\CampaignUpdate::create([
            'campaign_id' => $campaignId,
            'title'       => $validated['title'],
            'content'     => $validated['content'],
            'image'       => $imageUrl,
        ]);

        if ($request->input('distribute_all') == '1') {
            $campaign = Campaign::findOrFail($campaignId);
            
            // Calculate total distributed so far
            $totalDistributed = Beneficiary::where('program_name', $campaign->title)
                                           ->sum('assistance_value');
            
            $sisaDana = $campaign->collected - $totalDistributed;
            
            if ($sisaDana > 0) {
                // Create beneficiary record for the remaining funds
                Beneficiary::create([
                    'name' => 'Penyaluran Final - ' . $campaign->title,
                    'program_name' => $campaign->title,
                    'location' => 'Sesuai Laporan: ' . $validated['title'],
                    'assistance_value' => $sisaDana,
                    'is_active' => true,
                ]);
            }
            
            // Mark campaign as completed
            $campaign->update(['status' => 'selesai']);
        } else if ($request->filled('amount') && $request->input('amount') > 0) {
            $campaign = Campaign::findOrFail($campaignId);
            $amount = (int) $request->input('amount');
            
            // Create beneficiary record for the inputted amount
            Beneficiary::create([
                'name' => 'Penyaluran Bertahap - ' . $campaign->title,
                'program_name' => $campaign->title,
                'location' => 'Sesuai Laporan: ' . $validated['title'],
                'assistance_value' => $amount,
                'is_active' => true,
            ]);
        }

        return response()->json([
            'message'           => 'Laporan publik berhasil diposting.',
            'update'            => $update,
        ]);
    }

    public function destroy($id)
    {
        $update = \App\Models\CampaignUpdate::findOrFail($id);

        if ($update->image && file_exists(public_path($update->image))) {
            unlink(public_path($update->image));
        }

        $update->delete();

        return response()->json(['message' => 'Update berhasil dihapus.']);
    }
}
