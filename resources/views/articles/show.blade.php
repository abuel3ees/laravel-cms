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

    <x-showarticle :article="$article" />
</div>
</body>
</html>
