@extends('dashboard')

@section('title', 'Update Article')

@section('content')

<!-- External CSS -->
<link href="{{ asset('css/edit-article.css') }}" rel="stylesheet">

<div class="container">
    <h2 class="mb-4">Edit Article</h2>

    <form method="POST" action="{{ route('articles.update', $article->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $article->title) }}" class="form-control" id="title" required>
        </div>

        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" class="form-control" rows="8" required>{{ old('body', $article->body) }}</textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" class="btn btn-warning">Update Article</button>
        </div>
    </form>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="{{ asset('js/init-ckeditor.js') }}"></script>

@endsection
