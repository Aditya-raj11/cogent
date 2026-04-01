@extends('frontend::layouts.master')

@section('content')
<section class="section-spacing py-5">
    <div class="container" style="max-width: 720px;">
        <div class="card bg-dark text-white border-secondary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Upload Reel</h4>
                <a href="{{ route('reels.index') }}" class="btn btn-sm btn-outline-light">Back</a>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('reels.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Video (max 50MB)</label>
                        <input type="file" class="form-control" name="video" accept="video/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thumbnail (optional)</label>
                        <input type="file" class="form-control" name="thumbnail" accept="image/*">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Reel</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
