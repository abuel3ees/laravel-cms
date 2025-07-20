<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ALL_ARTICLES</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <link href="{{ asset('css/client-articles.css') }}" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">BROWSE_ARTICLES</h2>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-warning">
                Logout
            </button>
        </form>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($articles as $article)
            <div class="col">
                <div class="card bg-dark text-white h-100 border border-secondary">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>

                        @if ($article->media)
                            <img src="{{ asset('storage/' . $article->media->file_path) }}"
                                 alt="{{ $article->media->file_name }}"
                                 class="img-fluid rounded mb-3">
                        @endif

                        <div class="article-preview">{!! $article->body !!}</div>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-end">
                        <small class="text-muted">{{ $article->created_at->diffForHumans() }}</small>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn btn-sm btn-outline-warning mt-3">
                            VIEW_MORE
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {!! $articles->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
</body>
</html>
