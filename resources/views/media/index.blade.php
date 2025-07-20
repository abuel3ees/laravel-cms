@extends('dashboard')

@section('title', 'MEDIA_LIBRARY')

@section('content')

<!-- External CSS -->
<link href="{{ asset('css/media-library.css') }}" rel="stylesheet">

<div class="container py-5 text-light">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach($media as $file)
            <div class="col">
                <div class="card bg-dark text-white border border-secondary">
                    <img src="{{ asset('storage/' . $file->file_path) }}" class="card-img-top" alt="Image">

                    <div class="card-body">
                        <small class="d-block text-muted mb-2">{{ $file->file_name }}</small>

                        <form action="{{ route('media.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger w-100" type="submit">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4 justify-content-center">
        {!! $media->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

@endsection
