<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $article->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/article-show.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <a href="{{ route('articles.client') }}" class="btn btn-outline-light mb-4">← Back to Articles</a>

    <div class="card bg-dark border border-secondary">
        <div class="card-body container text-light">
            <h2 class="card-title" style="color: #FF4433">{{ $article->title }}</h2>

            @if ($article->media)
                <img src="{{ asset('storage/' . $article->media->file_path) }}"
                     alt="{{ $article->media->file_name }}"
                     class="img-fluid rounded mb-3">
            @endif

            <p class="text-muted mb-3">{{ $article->created_at->format('F j, Y') }}</p>
            <div>{!! $article->body !!}</div>
        </div>
    </div>
</div>
</body>
</html>
