<form method="GET" action="{{ route('articles.index') }}" class="row g-3 mb-4 p-3 rounded shadow" style="background-color: #1a1a1a; border: 1px solid #2a2a2a;">

    <div class="col-md-3">
        <label for="title" class="form-label text-light">Title</label>
        <input type="text" name="title" id="title"
               class="form-control bg-dark text-white border border-secondary"
               placeholder="Enter title" value="{{ request('title') }}">
    </div>

    <div class="col-md-3">
        <label for="user_id" class="form-label text-light">User</label>
        <select name="user_id" id="user_id"
                class="form-select bg-dark text-white border border-secondary">
            <option value="">All Users</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @selected(request('user_id') == $user->id)>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="from" class="form-label text-light">From</label>
        <input type="date" name="from" id="from"
               class="form-control bg-dark text-white border border-secondary"
               value="{{ request('from') }}">
    </div>

    <div class="col-md-3">
        <label for="to" class="form-label text-light">To</label>
        <input type="date" name="to" id="to"
               class="form-control bg-dark text-white border border-secondary"
               value="{{ request('to') }}">
    </div>

    <div class="col-12 d-flex justify-content-end">
        <button type="submit" class="btn btn-warning px-4">Filter</button>
    </div>
</form>
