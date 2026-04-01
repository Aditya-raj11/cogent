<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReelManagementController extends Controller
{
    public function index(): View
    {
        $reels = Reel::query()->with('user:id,first_name,last_name,email')->latest()->paginate(20);

        return view('backend.reels.index', compact('reels'));
    }

    public function create(): View
    {
        return view('backend.reels.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'video' => ['required', 'file', 'mimetypes:video/mp4,video/quicktime,video/x-msvideo,video/x-matroska', 'max:51200'],
            'thumbnail' => ['nullable', 'image', 'max:5120'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $videoPath = $request->file('video')->store('reels/videos', 'public');
        $thumbnailPath = $request->hasFile('thumbnail')
            ? $request->file('thumbnail')->store('reels/thumbnails', 'public')
            : null;

        Reel::query()->create([
            'user_id' => optional(auth()->user())->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'video_path' => $videoPath,
            'thumbnail_path' => $thumbnailPath,
            'source' => 'admin',
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        return redirect()->route('backend.reels.index')->with('success', 'Reel created successfully.');
    }

}
