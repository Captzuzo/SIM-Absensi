<nav class="main-header navbar navbar-expand navbar-dark bg-dark">
    <!-- Left navbar links (Toggle Sidebar) -->
    <ul class="navbar-nav">
        <li class="nav-item">
            {{-- Tombol toggle sidebar --}}
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
        </li>
    </ul>

    <div class="navbar-nav ml-auto">
        @auth
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle me-1"></i>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <span class="dropdown-item-text">
                    {{ Auth::user()->role->name }}
                </span>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item text-danger" type="submit">Logout</button>
                </form>
            </div>
        </li>
        @endauth
    </div>

</nav>