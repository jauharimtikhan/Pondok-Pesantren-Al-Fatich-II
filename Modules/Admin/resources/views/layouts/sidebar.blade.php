<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        @if (checkRole('super admin'))
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

            <li class="sidebar-item  {{ request()->routeIs('program') ? 'active' : '' }}">
                <a href="{{ route('program') }}" class='sidebar-link'>
                    <i class="bi bi-window-stack"></i>
                    <span>Program</span>
                </a>
            </li>

            <li class="sidebar-item  {{ request()->routeIs('kegiatan') ? 'active' : '' }}">
                <a href="{{ route('kegiatan') }}" class='sidebar-link'>
                    <i class="bi bi-calendar-event-fill"></i>
                    <span>Kegiatan Pondok</span>
                </a>
            </li>

            <li class="sidebar-item has-sub" id="mnPost">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-file-post"></i>
                    <span>Manajemen Artikel</span>
                </a>

                <ul class="submenu " id="mnSub">
                    <li class="submenu-item" id="mnSubPost"><a href="{{ route('artikel') }}"
                            class="submenu-link">Artikel</a></li>
                    <li class="submenu-item" id="mnSubKategoriPost">
                        <a href="{{ route('kategori') }}" class="submenu-link">Kategori Artikel</a>
                    </li>
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
                    <li class="submenu-item" id="mnPaketWakafs">
                        <a href="{{ route('paket_wakaf') }}" class="submenu-link">Paket Wakaf</a>
                    </li>

                    <li class="submenu-item" id="mnDataUang">
                        <a href="{{ route('donatur') }}" class="submenu-link">Data Donatur</a>
                    </li>

                </ul>
            </li>

            <li class="sidebar-item  {{ request()->routeIs('settings') ? 'active' : '' }}">
                <a href="{{ route('settings') }}" class='sidebar-link'>
                    <i class="bi bi-gear"></i>
                    <span>Setting</span>
                </a>
            </li>

            <li class="sidebar-item  {{ request()->routeIs('transaction') ? 'active' : '' }}">
                <a href="{{ route('transaction') }}" class='sidebar-link'>
                    <i class="bi bi-bank2"></i>
                    <span>Transaksi</span>
                </a>
            </li>
        @endif

        @if (checkRole('creator'))
            <li class="sidebar-item has-sub" id="mnPost">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-file-post"></i>
                    <span>Manajemen Artikel</span>
                </a>

                <ul class="submenu " id="mnSub">
                    <li class="submenu-item" id="mnSubPost"><a href="{{ route('artikel') }}"
                            class="submenu-link">Artikel</a></li>
                    <li class="submenu-item" id="mnSubKategoriPost">
                        <a href="{{ route('kategori') }}" class="submenu-link">Kategori Artikel</a>
                    </li>
                </ul>
            </li>
        @endif

        @if (checkRole('akuntan'))
            <li class="sidebar-item  {{ request()->routeIs('transaction') ? 'active' : '' }}">
                <span>Saya Seorang Akuntan</span>
            </li>
        @endif

    </ul>
</div>
