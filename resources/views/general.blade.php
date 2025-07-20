@extends('dashboard')
@section('title', 'GENERAL_STATS')
@section('content')

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Custom CSS -->
<link href="{{ asset('css/general-stats.css') }}" rel="stylesheet">

<!-- Custom JS -->
<script src="{{ asset('js/general-stats.js') }}" defer></script>

<div class="row g-4">
    <div class="col-md-3 d-flex">
        <div class="card bg-dark text-white border border-secondary shadow-sm w-100">
            <div class="card-body">
                <h5 class="card-title text-uppercase">TOTAL_ARTICLES</h5>
                <p class="card-text fs-3 text-danger">{{ $totalArticles ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex">
        <div class="card bg-dark text-white border border-secondary shadow-sm w-100">
            <div class="card-body">
                <h5 class="card-title text-uppercase">TOTAL_USERS</h5>
                <p class="card-text fs-3 text-danger">{{ $totalUsers ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex">
        <div class="card bg-dark text-white border border-secondary shadow-sm w-100">
            <div class="card-body">
                <h5 class="card-title text-uppercase">ADMINS</h5>
                <p class="card-text fs-3 text-danger">{{ $totalAdmins ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3 d-flex">
        <div class="card bg-dark text-white border border-secondary shadow-sm w-100">
            <div class="card-body">
                <h5 class="card-title text-uppercase">MEDIA_FILES</h5>
                <p class="card-text fs-3" style="color: #FF7500;">{{ $mediaCount ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>

<h2 class="highlight my-5"></h2>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card bg-dark text-white border border-secondary shadow-sm">
            <div class="card-body">
                <h5 class="card-title">ARTICLES_OVER_TIME</h5>
                <canvas id="articlesChart" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card bg-dark text-white border border-secondary shadow-sm">
            <div class="card-body">
                <h5 class="card-title">USER_REGISTRATIONS</h5>
                <canvas id="usersChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    window.chartData = {
        labels: @json($monthLabels),
        articleData: @json($articleData),
        userData: @json($userData)
    };
</script>

@endsection
