<div class="sidebar d-flex flex-column justify-content-between py-4 px-2">
        <div>
            <a href="/" class="text-decoration-none text-white fw-bold fs-4 mb-4 d-block text-center">ADMIN_CNTR</a>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="bi-house"></i> DASHBOARD
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/articles" class="nav-link">
                        <i class="bi-table"></i> ARTICLES
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/articles/create" class="nav-link">
                        <i class="bi-plus-circle"></i> ADD_ARTICLE
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/media" class="nav-link">
                        <i class="bi-image"></i> MEDIA
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/users" class="nav-link">
                        <i class="bi-people"></i> USERS
                    </a>
                </li>
            </ul>
        </div>

        <!-- Profile Dropdown -->
        <div class="dropdown text-center">
            <a href="#" class="d-flex align-items-center justify-content-center link-light text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown">
                <i class="bi-person-circle fs-4"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser">
                @auth
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">PROFILE</a></li>
                @endauth
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item">LOGOUT</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>