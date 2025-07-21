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
            <x-mediacard :file="$file" />
        @endforeach
    </div>

    <div class="mt-4 justify-content-center">
        {!! $media->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

@endsection
