<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:190'],
            'message' => ['required', 'string'],
            'is_read' => ['nullable', 'boolean'],
        ]);

        $validated['is_read'] = $request->boolean('is_read');
        $validated['read_at'] = $validated['is_read'] ? now() : null;

        $message = Message::create($validated);

        return response()->json([
            'message' => 'Pesan berhasil ditambahkan.',
            'data' => $message,
        ], 201);
    }

    public function update(Request $request, Message $message): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:150'],
            'email' => ['sometimes', 'required', 'email', 'max:190'],
            'message' => ['sometimes', 'required', 'string'],
            'is_read' => ['sometimes', 'boolean'],
        ]);

        if (array_key_exists('is_read', $validated)) {
            $isRead = (bool) $validated['is_read'];
            $validated['read_at'] = $isRead ? ($message->read_at ?? now()) : null;
        }

        $message->update($validated);

        return response()->json([
            'message' => 'Pesan berhasil diperbarui.',
            'data' => $message->fresh(),
        ]);
    }

    public function destroy(Message $message): JsonResponse
    {
        $message->delete();

        return response()->json([
            'message' => 'Pesan berhasil dihapus.',
        ]);
    }
}
