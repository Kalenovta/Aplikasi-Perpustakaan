<nav class="col-md-2 d-none d-md-block sidebar">
    <div class="sidebar-sticky">
        
        <div class="sidebar-header">
            <h3>Perpustakaan</h3>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('member') ? 'active' : '' }}" href="{{ route('member') }}">
                    <span data-feather="users"></span>
                    Manage Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#books') ? 'active' : '' }}" href="{{ route('buku')}}">
                    <span data-feather="book"></span>
                    Manage Books
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#loans') ? 'active' : '' }}" href="{{ route('pinjam')}}">
                    <span data-feather="file"></span>
                    Manage Loans
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#returns') ? 'active' : '' }}" href="{{ route('pengembalian') }}">
                    <span data-feather="check-circle"></span>
                    Manage Returns
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#categories') ? 'active' : '' }}" href="{{ route('kategori') }}">
                    <span data-feather="tag"></span>
                    Manage Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('user') ? 'active' : '' }}" href="{{route('user')}}">
                    <span data-feather="user"></span>
                    Manage Staff
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-danger" href="{{ route('logout') }}">
                    <span data-feather="log-out" class=""></span>
                   Logout
                </a>
            </li>
        </ul>
    </div>
</nav>