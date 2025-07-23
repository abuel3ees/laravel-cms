@extends('dashboard')
@section('title', 'IMPORT_ARTICLES')
@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('articles.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Select Excel/CSV File</label>
            <input type="file" name="file" class="form-control" required>
        </div>
        <button class="btn" style="background-color: #F75000">Import</button>
    </form>
</div>
@endsection
