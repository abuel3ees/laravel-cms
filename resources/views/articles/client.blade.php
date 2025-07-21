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
        <x-logoutbutton />
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($articles as $article)
            <x-clientarticlecards :article="$article" />
        @endforeach
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {!! $articles->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>
</body>
</html>
