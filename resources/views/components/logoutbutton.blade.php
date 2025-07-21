<form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-warning">
                Logout
            </button>
        </form>