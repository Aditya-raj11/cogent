<?php

namespace App\Http\Controllers\Backend\API;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReelController extends Controller
{
    public function index(): JsonResponse
    {
        $reels = Reel::query()
            ->with('user:id,first_name,last_name,email')
            ->where('is_active', true)
            ->latest()
            ->paginate(20);

        return response()->json([
            'status' => true,
            'message' => 'Reels fetched successfully.',
            'data' => $reels,
        ]);
    }

    public function myReels(Request $request): JsonResponse
    {
        $reels = Reel::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(20);

        return response()->json([
            'status' => true,
            'message' => 'My reels fetched successfully.',
            'data' => $reels,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video' => ['required', 'file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska', 'max:51200'],
            'thumbnail' => ['nullable', 'image', 'max:5120'],
        ]);

        $videoPath = $request->file('video')->store('reels/videos', 'public');
        $thumbnailPath = $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->store('reels/thumbnails', 'public')
            : null;

        $reel = Reel::query()->create([
            'user_id' => optional($request->user())->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'video_path' => $videoPath,
            'thumbnail_path' => $thumbnailPath,
            'source' => 'app',
            'is_active' => true,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Reel uploaded successfully.',
            'data' => $reel->fresh(),
        ]);
    }

}
