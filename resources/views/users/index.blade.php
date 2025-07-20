@extends('dashboard')

@section('title', 'ALL_USERS')

@section('content')

<!-- External CSS -->
<link href="{{ asset('css/all-users.css') }}" rel="stylesheet">

<div class="container">
    <div class="table-responsive rounded shadow border border-secondary">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead class="table-dark border-bottom border-secondary">
                <tr class="text-[#FF4433]">
                    <th>#</th>
                    <th>NAME</th>
                    <th>ROLE</th>
                    <th>EMAIL</th>
                    <th>JOINED</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-top border-secondary">
                        <td>{{ $loop->iteration + (($users->currentPage() - 1) * $users->perPage()) }}</td>
                        <td class="fw-semibold text-white">{{ $user->name }}</td>
                        <td style="color: #FF4433">{{ $user->role }}</td>
                        <td style="color: #FF4433">{{ $user->email }}</td>
                        <td><small style="color:#FF4433">{{ $user->created_at->diffForHumans() }}</small></td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4 justify-content-center">
        {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>
</div>

@endsection
