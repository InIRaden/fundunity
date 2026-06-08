<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CampaignUpdateController extends Controller
{
    public function store(Request $request, $campaignId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'content' => 'required|string',
            'image_file' => 'nullable|image|max:2048',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/updates'), $filename);
            $imageUrl = '/uploads/updates/' . $filename;
        }

        $update = \App\Models\CampaignUpdate::create([
            'campaign_id' => $campaignId,
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imageUrl,
        ]);

        return response()->json([
            'message' => 'Update berhasil ditambahkan.',
            'data' => $update
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
