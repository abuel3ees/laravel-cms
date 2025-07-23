<form method="GET" action="{{ route('articles.index') }}" class="row g-2 mb-4">
    <div class="col-md-3">
        <input type="text" name="title" class="form-control" placeholder="Title..." value="{{ request('title') }}">
    </div>
    <div class="col-md-3">
        <select name="user_id" class="form-select">
            <option value="">All Users</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
    </div>
    <div class="col-md-3">
        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
    </div>
    <div class="col-md-12">
        <button class="btn btn-warning">Filter</button>
    </div>
</form>
