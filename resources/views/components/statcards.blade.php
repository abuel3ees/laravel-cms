<div class="col-md-3 d-flex">
    <div class="card bg-dark text-white border border-secondary shadow-sm w-100">
        <div class="card-body">
            <h5 class="card-title text-uppercase">{{ $title }}</h5>
            <p class="card-text fs-3 {{ $colorClass ?? 'text-danger' }}">{{ $value }}</p>
        </div>
    </div>
</div>