@extends('dashboard')

@section('title', 'VIEW_ARTICLES')

@section('content')

<!-- External CSS -->
<link href="{{ asset('css/view-articles.css') }}" rel="stylesheet">

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach ($articles as $article)
        <div class="col">
            <div class="card bg-dark text-white h-100 border border-secondary">
                <div class="card-body">

                    <h4 class="card-title" style="color:#FF4433;">{{ $article->title }}</h4>

                    @if ($article->media)
                        <img src="{{ asset('storage/' . $article->media->file_path) }}"
                             alt="{{ $article->media->file_name }}"
                             class="img-fluid rounded mb-3">
                    @endif

                    <p>{!! $article->body !!}</p>

                    <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-square"></i> VIEW/MODIFY
                        </a>

                        <form action="{{ route('articles.softdelete', $article->id) }}" method="POST" onsubmit="return confirm('Delete this article?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i> DELETE
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-footer bg-transparent border-0 text-end">
                    <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="mt-4 d-flex justify-content-center">
    {!! $articles->withQueryString()->links('pagination::bootstrap-5') !!}
</div>

@endsection
