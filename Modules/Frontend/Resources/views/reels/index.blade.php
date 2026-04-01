@extends('frontend::layouts.master')

@push('after-styles')
<style>
    .reels-page {
        padding: 1rem 0 2rem;
    }

    .reels-shell {
        width: min(100%, 520px);
        margin: 0 auto;
    }

    .reels-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }

    .reels-feed {
        height: calc(100vh - 210px);
        max-height: 860px;
        min-height: 560px;
        overflow: hidden;
        position: relative;
        border-radius: 14px;
        background: #000;
        border: 1px solid rgba(255, 255, 255, 0.12);
    }

    .reel-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        pointer-events: none;
        transition: opacity 220ms ease;
        background: #000;
    }

    .reel-slide.is-active {
        opacity: 1;
        pointer-events: auto;
    }

    .reel-video {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: #000;
    }

    .reel-overlay {
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 1rem;
        color: #fff;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.72), rgba(0, 0, 0, 0));
    }

    .reel-title {
        margin: 0;
        font-size: 1rem;
        font-weight: 700;
    }

    .reel-description {
        margin-top: 0.35rem;
        margin-bottom: 0;
        color: rgba(255, 255, 255, 0.82);
        font-size: 0.9rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .reel-empty {
        display: grid;
        place-items: center;
        color: rgba(255, 255, 255, 0.85);
        height: 100%;
    }

    .reel-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 3;
        width: 42px;
        height: 42px;
        border: 0;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.58);
        color: #fff;
        font-size: 1.25rem;
        line-height: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .reel-nav:hover {
        background: rgba(0, 0, 0, 0.75);
    }

    .reel-nav:disabled {
        opacity: 0.35;
        cursor: not-allowed;
    }

    .reel-nav-prev {
        left: 10px;
    }

    .reel-nav-next {
        right: 10px;
    }

    .reel-count {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 3;
        background: rgba(0, 0, 0, 0.55);
        color: #fff;
        font-size: 0.75rem;
        border-radius: 999px;
        padding: 0.2rem 0.55rem;
    }

    @media (max-width: 767.98px) {
        .reels-page {
            padding-top: 0.75rem;
        }

        .reels-feed {
            width: 100%;
            height: calc(100vh - 180px);
            min-height: 460px;
            border-radius: 10px;
        }
    }
</style>
@endpush

@section('content')
<section class="reels-page">
    <div class="container">
        <div class="reels-shell">
            <div class="reels-header">
                <h2 class="mb-0">Reels</h2>
                @auth
                    <a href="{{ route('reels.create') }}" class="btn btn-primary btn-sm">Upload Reel</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login to Upload</a>
                @endauth
            </div>

            @if(session('success'))
                <div class="alert alert-success py-2">{{ session('success') }}</div>
            @endif

            <div class="reels-feed" id="reelsFeed">
                @forelse($reels as $reel)
                    <article class="reel-slide" data-reel-index="{{ $loop->index }}">
                        <video
                            class="reel-video"
                            src="{{ $reel->video_url }}"
                            preload="metadata"
                            playsinline
                            muted
                            loop
                        ></video>
                        <div class="reel-overlay">
                            <h3 class="reel-title">{{ $reel->title ?: 'Untitled Reel' }}</h3>
                            @if($reel->description)
                                <p class="reel-description">{{ $reel->description }}</p>
                            @endif
                        </div>
                    </article>
                @empty
                    <div class="reel-empty">
                        <p class="mb-0">No reels uploaded yet.</p>
                    </div>
                @endforelse

                @if($reels->count() > 1)
                    <button type="button" class="reel-nav reel-nav-prev" id="reelPrevBtn" aria-label="Previous reel">&#8249;</button>
                    <button type="button" class="reel-nav reel-nav-next" id="reelNextBtn" aria-label="Next reel">&#8250;</button>
                    <div class="reel-count" id="reelCount">1 / {{ $reels->count() }}</div>
                @endif
            </div>

            @if($reels->hasPages())
                <div class="mt-3">
                    {{ $reels->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@push('after-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const feed = document.getElementById('reelsFeed');
        if (!feed) return;

        const slides = Array.from(feed.querySelectorAll('.reel-slide'));
        const videos = Array.from(feed.querySelectorAll('.reel-video'));
        if (!videos.length) return;

        const prevBtn = document.getElementById('reelPrevBtn');
        const nextBtn = document.getElementById('reelNextBtn');
        const countBadge = document.getElementById('reelCount');
        let currentIndex = 0;

        const pauseAll = () => {
            videos.forEach((video) => video.pause());
        };

        const playActive = (index) => {
            const activeSlide = slides[index];
            if (!activeSlide) return;

            slides.forEach((slide, slideIndex) => {
                slide.classList.toggle('is-active', slideIndex === index);
            });

            if (prevBtn) prevBtn.disabled = index === 0;
            if (nextBtn) nextBtn.disabled = index === slides.length - 1;
            if (countBadge) countBadge.textContent = (index + 1) + ' / ' + slides.length;

            pauseAll();

            const activeVideo = activeSlide.querySelector('.reel-video');
            if (!activeVideo) return;
            activeVideo.play().catch(() => {});
        };

        if (prevBtn) {
            prevBtn.addEventListener('click', function () {
                if (currentIndex <= 0) return;
                currentIndex -= 1;
                playActive(currentIndex);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function () {
                if (currentIndex >= slides.length - 1) return;
                currentIndex += 1;
                playActive(currentIndex);
            });
        }

        document.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowLeft' && currentIndex > 0) {
                currentIndex -= 1;
                playActive(currentIndex);
            }
            if (event.key === 'ArrowRight' && currentIndex < slides.length - 1) {
                currentIndex += 1;
                playActive(currentIndex);
            }
        });

        // Disable wheel-based reel switching by preventing feed scroll interaction.
        feed.addEventListener('wheel', function (event) {
            event.preventDefault();
        }, { passive: false });

        playActive(currentIndex);

        videos.forEach((video) => {
            video.addEventListener('click', () => {
                video.muted = !video.muted;
            });
        });
    });
</script>
@endpush
