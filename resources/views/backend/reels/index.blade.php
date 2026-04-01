@extends('backend.layouts.app', ['isBanner' => false])

@section('title', 'Reels')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Reels</h4>
        <a href="{{ route('backend.reels.create') }}" class="btn btn-primary">Upload Reel</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Uploader</th>
                        <th>Source</th>
                        <th>Preview</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reels as $reel)
                        <tr>
                            <td>{{ $reel->id }}</td>
                            <td>{{ $reel->title }}</td>
                            <td>{{ optional($reel->user)->full_name ?? optional($reel->user)->email ?? 'Guest' }}</td>
                            <td>{{ ucfirst($reel->source) }}</td>
                            <td>
                                <video src="{{ $reel->video_url }}" width="170" height="96" controls></video>
                            </td>
                            <td>{{ $reel->created_at?->format('d M Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No reels found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $reels->links() }}
        </div>
    </div>
</div>
@endsection
