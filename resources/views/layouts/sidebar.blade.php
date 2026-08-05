<style>
    /* ==========================================================
   1. CORE SIDEBAR (PAKAI ID AGAR MENGALAHKAN CSS LAIN)
========================================================== */
    #sidebarMenu.sidebar-custom {
        width: var(--sidebar-width, 260px) !important;
        height: 100vh !important;
        background: linear-gradient(180deg, #0d6efd 0%, #0b5ed7 60%, #0a58ca 100%) !important;
        box-shadow: 4px 0 24px rgba(13, 110, 253, 0.18) !important;
        border-right: 1px solid rgba(255, 255, 255, 0.12) !important;
        display: flex !important;
        flex-direction: column !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        z-index: 1030 !important;
        transition: transform 0.3s ease-in-out !important;

        -ms-overflow-style: none !important;
        scrollbar-width: none !important;
    }

    #sidebarMenu::-webkit-scrollbar {
        display: none !important;
    }

    /* ==========================================================
   2. BRANDING & HEADER
========================================================== */
    #sidebarMenu .sidebar-header {
        padding: 1.25rem 1.5rem !important;
        display: flex !important;
        align-items: center !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15) !important;
    }

    #sidebarMenu .navbar-brand-logo {
        width: 42px !important;
        height: 42px !important;
        border-radius: 12px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        background: #ffffff !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12) !important;
        overflow: hidden !important;
        flex-shrink: 0 !important;
    }

    #sidebarMenu .brand-title {
        font-size: 1.25rem !important;
        font-weight: 800 !important;
        letter-spacing: 0.5px !important;
        color: #ffffff !important;
    }

    /* ==========================================================
   3. NAVIGATION MENU LINKS
========================================================== */
    #sidebarMenu .sidebar-menu {
        padding: 1.25rem 0.85rem !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 0.4rem !important;
        flex-grow: 1 !important;
    }

    #sidebarMenu .nav-link-custom {
        color: rgba(255, 255, 255, 0.85) !important;
        padding: 0.75rem 1rem !important;
        border-radius: 12px !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.85rem !important;
        font-weight: 600 !important;
        font-size: 0.925rem !important;
        transition: all 0.25s ease !important;
        text-decoration: none !important;
        background: transparent !important;
    }

    #sidebarMenu .nav-link-custom i {
        font-size: 1.2rem !important;
        color: rgba(255, 255, 255, 0.85) !important;
    }

    /* HOVER STATE */
    #sidebarMenu .nav-link-custom:hover {
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.15) !important;
        transform: translateX(4px) !important;
    }

    #sidebarMenu .nav-link-custom:hover i {
        color: #ffffff !important;
    }

    /* ==========================================================
   PAKSA TOMBOL AKTIF JADI PUTIH & TEKS BIRU (OVERRIDE TOTAL)
========================================================== */
    #sidebarMenu .sidebar-menu .nav-link-custom.active,
    #sidebarMenu .sidebar-menu .nav-link-custom.active:hover {
        background-color: #ffffff !important;
        background: #ffffff !important;
        color: #0b5ed7 !important;
        font-weight: 700 !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15) !important;
        transform: none !important;
    }

    #sidebarMenu .sidebar-menu .nav-link-custom.active i,
    #sidebarMenu .sidebar-menu .nav-link-custom.active:hover i {
        color: #0b5ed7 !important;
    }

    /* ==========================================================
   4. USER PROFILE & FOOTER
========================================================== */
    #sidebarMenu .sidebar-footer {
        padding: 0.85rem !important;
        border-top: 1px solid rgba(255, 255, 255, 0.15) !important;
        background: rgba(0, 0, 0, 0.08) !important;
    }

    #sidebarMenu .user-profile-card {
        background: rgba(255, 255, 255, 0.12) !important;
        border: 1px solid rgba(255, 255, 255, 0.18) !important;
        backdrop-filter: blur(8px) !important;
        border-radius: 12px !important;
        padding: 0.6rem 0.75rem !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        gap: 0.5rem !important;
    }

    #sidebarMenu .btn-logout-custom {
        width: 34px !important;
        height: 34px !important;
        border-radius: 8px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #ffffff !important;
        background: rgba(255, 255, 255, 0.15) !important;
        border: none !important;
        transition: all 0.25s ease !important;
        flex-shrink: 0 !important;
    }

    #sidebarMenu .btn-logout-custom:hover {
        background: #dc3545 !important;
        color: #ffffff !important;
        transform: rotate(90deg) !important;
    }

    /* ==========================================================
   5. MOBILE NAVBAR
========================================================== */
    .mobile-navbar-header {
        display: none;
        background: #0d6efd;
        padding: 0.75rem 1.25rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
    }

    @media (max-width: 991.98px) {
        .mobile-navbar-header {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        #sidebarMenu.sidebar-custom {
            transform: translateX(-100%) !important;
        }

        #sidebarMenu.sidebar-custom.show {
            transform: translateX(0) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25) !important;
        }
    }
</style>

{{-- HEADER MOBILE --}}
<div class="mobile-navbar-header">
    <a class="navbar-brand d-flex align-items-center gap-2 text-decoration-none" href="{{ route('dashboard') }}">
        <div class="navbar-brand-logo" style="width:34px; height:34px; border-radius: 8px;">
            <img src="{{ asset('images/R.png') }}" alt="Logo KUDE" class="w-100 h-100 object-fit-cover">
        </div>
        <span class="brand-title" style="font-size: 1.1rem; color: #ffffff;">POS</span>
    </a>
    <button class="btn text-white p-1 border-0" type="button" id="sidebarToggleBtn">
        <i class="bi bi-list fs-2"></i>
    </button>
</div>

{{-- SIDEBAR UTAMA --}}
<aside class="sidebar-custom" id="sidebarMenu">

    {{-- HEADER DESKTOP --}}
    <div class="sidebar-header">
        <a class="navbar-brand d-flex align-items-center gap-2.5 text-decoration-none" href="{{ route('dashboard') }}">
            <div class="navbar-brand-logo">
                <img src="{{ asset('images/R.png') }}" alt="Logo KUDE" class="w-100 h-100 object-fit-cover">
            </div>
            <div>
                <span class="brand-title">  POS</span>
            </div>
        </a>
    </div>

    {{-- MENU SIDEBAR --}}
    <ul class="sidebar-menu list-unstyled mb-0">
        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('dashboard*') ? 'active' : '' }}"
                style="{{ Request::is('dashboard*') ? 'background-color: #ffffff !important; color: #0b5ed7 !important;' : '' }}"
                href="{{ route('dashboard') }}">
                <i class="bi bi-grid-1x2-fill"
                    style="{{ Request::is('dashboard*') ? 'color: #0b5ed7 !important;' : '' }}"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @php
            $userRole = '';
            if (Auth::check() && Auth::user()->role) {
                $userRole = strtolower(Auth::user()->role->name ?? Auth::user()->role);
            }
        @endphp

        @if (Auth::check() && $userRole == 'admin')
            <li class="nav-item">
                <a class="nav-link-custom {{ Request::is('admin/users*') ? 'active' : '' }}"
                    style="{{ Request::is('admin/users*') ? 'background-color: #ffffff !important; color: #0b5ed7 !important;' : '' }}"
                    href="{{ route('admin.users') }}">
                    <i class="bi bi-people-fill"
                        style="{{ Request::is('admin/users*') ? 'color: #0b5ed7 !important;' : '' }}"></i>
                    <span>Kelola Users</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('produk*') ? 'active' : '' }}"
                style="{{ Request::is('produk*') ? 'background-color: #ffffff !important; color: #0b5ed7 !important;' : '' }}"
                href="{{ route('produk.index') }}">
                <i class="bi bi-box-seam-fill"
                    style="{{ Request::is('produk*') ? 'color: #0b5ed7 !important;' : '' }}"></i>
                <span>Data Produk</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('penjualan*') ? 'active' : '' }}"
                style="{{ Request::is('penjualan*') ? 'background-color: #ffffff !important; color: #0b5ed7 !important;' : '' }}"
                href="{{ route('penjualan.index') }}">
                <i class="bi bi-cart-check-fill"
                    style="{{ Request::is('penjualan*') ? 'color: #0b5ed7 !important;' : '' }}"></i>
                <span>Riwayat Penjualan</span>
            </a>
        </li>
    </ul>

    {{-- USER PROFILE & FOOTER --}}
    @auth
        <div class="sidebar-footer">
            <div class="user-profile-card">
                <button type="button"
                    class="btn p-0 border-0 bg-transparent text-start d-flex align-items-center gap-2 overflow-hidden flex-grow-1"
                    data-bs-toggle="modal" data-bs-target="#userProfileSidebarModal">

                    <img src="{{ asset('images/R.png') }}" alt="Foto Profil"
                        class="rounded-circle object-fit-cover border border-2 border-white"
                        style="width: 36px; height: 36px; flex-shrink: 0;">

                    <div class="text-truncate">
                        <div class="fw-bold text-truncate" style="font-size: 0.85rem; color: #ffffff !important;">
                            {{ Auth::user()->name }}
                        </div>
                        <small class="text-uppercase d-block fw-semibold"
                            style="font-size: 0.68rem; color: rgba(255, 255, 255, 0.75) !important;">
                            {{ optional(Auth::user()->role)->name ?? (Auth::user()->role ?? 'Staff') }}
                        </small>
                    </div>
                </button>

                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-logout-custom" title="Logout">
                        <i class="bi bi-power fs-6"></i>
                    </button>
                </form>
            </div>
        </div>
    @endauth

</aside>

{{-- SCRIPT TOGGLE MOBILE --}}
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const sidebar = document.getElementById('sidebarMenu');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });

                document.addEventListener('click', function(event) {
                    const isClickInside = sidebar.contains(event.target) || toggleBtn.contains(event
                    .target);
                    if (!isClickInside && sidebar.classList.contains('show')) {
                        sidebar.classList.remove('show');
                    }
                });
            }
        });
    </script>
@endpush
