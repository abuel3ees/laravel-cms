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
        <x-editform :article="$article" />
    </form>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="{{ asset('js/init-ckeditor.js') }}"></script>
@endsection
