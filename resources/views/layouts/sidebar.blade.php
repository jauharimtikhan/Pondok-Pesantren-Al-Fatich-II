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

            <ul class="submenu " id="mnSub">
                <li class="submenu-item" id="mnSubKategoriPost">
                    <a href="{{ route('kategori') }}" class="submenu-link">Kategori Artikel</a>
                </li>
                <li class="submenu-item" id="mnSubPost"><a href="{{ route('artikel') }}"
                        class="submenu-link">Artikel</a></li>
            </ul>
        </li>

        <li class="sidebar-item has-sub" id="mnWakaf">
            <a href="#" class='sidebar-link'>
                <i class="bi bi-wallet"></i>
                <span>Manajemen Wakaf</span>
            </a>

            <ul class="submenu " id="mnWakafs">
                <li class="submenu-item" id="mnListWakafs">
                    <a href="{{ route('wakaf') }}" class="submenu-link">Wakaf</a>
                </li>
                <li class="submenu-item" id="mnPaketWakafs"><a href="{{ route('paket_wakaf') }}"
                        class="submenu-link">Paket Wakaf</a></li>
            </ul>
        </li>
    </ul>
</div>
