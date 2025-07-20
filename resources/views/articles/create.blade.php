@extends('dashboard')

@section('title', 'Create Article')

@section('content')

<!-- External CSS -->
<link href="{{ asset('css/create-article.css') }}" rel="stylesheet">

<div class="container mt-5" style="max-width: 700px; font-family: 'Roboto Condensed', sans-serif;">
    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" class="p-4 rounded shadow" style="background-color: #1a1a1a; border: 1px solid #2a2a2a;">
        @csrf

        <div class="mb-4">
            <label for="title" class="form-label text-warning fs-5">Title</label>
            <input type="text" name="title" id="title"
                   class="form-control bg-dark text-white border border-secondary"
                   placeholder="Enter article title" required
                   value="{{ old('title') }}">
        </div>

        <div class="mb-4">
            <label for="body" class="form-label text-warning fs-5">Body</label>
            <textarea name="body" id="body" rows="6"
                      class="form-control bg-dark text-white border border-secondary"
                      placeholder="Write something..." required>{{ old('body') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label text-light">Upload Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit"
                class="btn text-white px-4 py-2"
                style="background-color: #FF7500; border: none;">
            Post Article
        </button>
    </form>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="{{ asset('js/init-ckeditor.js') }}"></script>

@endsection
