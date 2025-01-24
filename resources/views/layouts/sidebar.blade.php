<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                    @can('create', App\Models\Produk::class)
                        <li class="sidebar-item">
                            <a href="{{ route('produk.index') }}" class='sidebar-link'>
                                <i class="bi bi-box"></i>
                                <span>Produk</span>
                            </a>
                        </li>
                    @endcan
                    @can('create', App\Models\Penjualan::class)
                        <li class="sidebar-item">
                            <a href="{{ route('penjualan.index') }}" class='sidebar-link'>
                                <i class="bi bi-cart"></i>
                                <span>Penjualan</span>
                            </a>
                        </li>
                    @endcan
                    @can('viewAny', App\Models\User::class)
                        <li class="sidebar-item">
                            <a href="{{ route('users.index') }}" class='sidebar-link'>
                                <i class="bi bi-people"></i>
                                <span>Kelola User</span>
                            </a>
                        </li>
                    @endcan

                <li class="sidebar-item">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='sidebar-link'>
                        <i class="bi bi-box-arrow-left"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
