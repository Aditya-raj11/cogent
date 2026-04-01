<?php

namespace Modules\Frontend\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReelFrontendController extends Controller
{
    public function index(): View
    {
        $reels = Reel::query()->where('is_active', true)->latest()->paginate(18);

        return view('frontend::reels.index', compact('reels'));
    }

    public function create(): View
    {
        return view('frontend::reels.create');
    }

    public function store(Request $request): RedirectResponse
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

        Reel::query()->create([
            'user_id' => optional(auth()->user())->id,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'video_path' => $videoPath,
            'thumbnail_path' => $thumbnailPath,
            'source' => 'website',
            'is_active' => true,
        ]);

        return redirect()->route('reels.index')->with('success', 'Reel uploaded successfully.');
    }

}
