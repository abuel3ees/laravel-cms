@extends('dashboard')

@section('title', 'VIEW_ARTICLES')

@section('content')

<!-- External CSS -->
<link href="{{ asset('css/view-articles.css') }}" rel="stylesheet">
<x-filteringsystem :users="$users" />
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    @foreach ($articles as $article)
        <x-articlecards :article="$article" />
        <tr>
    <td>
        @if ($article->status === 'pending')
            <span class="badge bg-warning">Pending</span>
        @else
            <span class="badge bg-success">Published</span>
        @endif
    </td>
</tr>
            </div>
        </div>
    @endforeach
    
</div>
<div class="mt-4 d-flex justify-content-center">
    {!! $articles->withQueryString()->links('pagination::bootstrap-5') !!}
</div>

@endsection
