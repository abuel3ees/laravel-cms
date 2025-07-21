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
<x-statcards title="TOTAL_ARTICLES" :value="$totalArticles ?? 'N/A'" />
<x-statcards title="TOTAL_USERS" :value="$totalUsers ?? 'N/A'" />
<x-statcards title="ADMINS" :value="$totalAdmins ?? 'N/A'" />
<x-statcards title="MEDIA_FILES" :value="$mediaCount ?? 'N/A'" />

<h2 class="highlight my-5"></h2>
<x-chartcards title="ARTICLES_OVER_TIME" chart-id="articlesChart" />
<x-chartcards title="USER_REGISTRATIONS" chart-id="usersChart" />


<script>
    window.chartData = {
        labels: @json($monthLabels),
        articleData: @json($articleData),
        userData: @json($userData)
    };
</script>

@endsection
