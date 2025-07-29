@extends('dashboard')

@section('title', 'CREATE_ARTICLE')

@section('content')

<!-- External CSS -->
<link href="{{ asset('css/create-article.css') }}" rel="stylesheet">

<div class="container mt-5" style="max-width: 700px; color: #ff4333; font-family: 'space mono', monospace;">
    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" class="p-4 rounded shadow" style="background-color: #1a1a1a; border: 1px solid #2a2a2a; color: #ff4333;">
        @csrf
        <div class="mb-4" style="color: #ff4333">
          <x-createform />
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="{{ asset('js/init-ckeditor.js') }}"></script>

@endsection
