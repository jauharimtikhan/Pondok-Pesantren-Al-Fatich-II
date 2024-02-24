<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>
        <li class="sidebar-item  {{ request()->routeIs('home') ? 'active' : '' }}">
            <a href="{{ route('home') }}" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item  {{ request()->routeIs('user') ? 'active' : '' }}">
            <a href="{{ route('user') }}" class='sidebar-link'>
                <i class="bi bi-person"></i>
                <span>User</span>
            </a>
        </li>

        <li class="sidebar-item has-sub" id="mnPost">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-file-post"></i>
                <span>Manajemen Artikel</span>
            </a>

            <ul class="submenu ">
                <li class="submenu-item" id="mnSubKategoriPost">
                    <a href="{{ route('kategori') }}" class="submenu-link">Kategori Artikel</a>
                </li>
            </ul>
        </li>
    </ul>
</div>
