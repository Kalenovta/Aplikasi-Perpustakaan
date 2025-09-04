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
                <a class="nav-link {{ request()->is('#members') ? 'active' : '' }}" href="#members">
                    <span data-feather="users"></span>
                    Manage Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#books') ? 'active' : '' }}" href="#books">
                    <span data-feather="book"></span>
                    Manage Books
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#loans') ? 'active' : '' }}" href="#loans">
                    <span data-feather="file"></span>
                    Manage Loans
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#returns') ? 'active' : '' }}" href="#returns">
                    <span data-feather="check-circle"></span>
                    Manage Returns
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#categories') ? 'active' : '' }}" href="#categories">
                    <span data-feather="tag"></span>
                    Manage Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('#staff') ? 'active' : '' }}" href="#staff">
                    <span data-feather="user"></span>
                    Manage Staff
                </a>
            </li>
        </ul>
    </div>
</nav>