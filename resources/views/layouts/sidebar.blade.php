<style>
:root {
    --bg-dark-navy: #0a192f;
    --bg-slate-navy: #112240;
    --bg-light-navy: #233554;
    --cyan-accent: #64ffda;
    --text-slate: #8892b0;
    --text-light-slate: #ccd6f6;
    --white: #e6f1ff;
    --danger: #ff6b6b;
    --sidebar-width: 260px;
}

/* ==========================
   SIDEBAR BASE (FIXED DESKTOP)
========================== */
/* ==========================
   SIDEBAR BASE (DESKTOP FIXED)
========================== */
.sidebar-custom {
    width: var(--sidebar-width);
    height: 100vh;
    background: linear-gradient(
        180deg,
        #020c1b,
        var(--bg-dark-navy) 40%,
        var(--bg-slate-navy)
    ) !important;
    box-shadow: 10px 0 30px rgba(2, 12, 27, 0.8);
    backdrop-filter: blur(18px);
    border-right: 1px solid var(--bg-light-navy);
    display: flex;
    flex-direction: column;

    /* --- SCROLLBAR DIMATIKAN TOTAL --- */
    overflow: hidden !important;
    -ms-overflow-style: none;
    scrollbar-width: none;

    transition: all 0.3s ease-in-out;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1030;
}

/* Sembunyikan scrollbar bawaan Chrome & Edge */
.sidebar-custom::-webkit-scrollbar {
    display: none !important;
    width: 0 !important;
}

/* KODE DI BAWAH INI TETAP/TIDAK DIUBAH */
.sidebar-custom::after {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(
        180deg,
        transparent,
        var(--cyan-accent),
        rgba(100, 255, 218, 0.2),
        transparent
    );
    animation: glowLineVertical 5s linear infinite;
}

@keyframes glowLineVertical {
    0% { transform: translateY(-100%); }
    100% { transform: translateY(100%); }
}

/* ==========================
   LOGO & BRANDING
========================== */
.sidebar-header {
    padding: 1.5rem;
    display: flex;
    align-items: center;
    border-bottom: 1px solid var(--bg-light-navy);
}

.navbar-brand-logo {
    width: 44px;
    height: 44px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--bg-slate-navy);
    border: 1px solid var(--cyan-accent);
    box-shadow: 0 0 15px rgba(100, 255, 218, 0.2);
    overflow: hidden;
    position: relative;
    transition: .35s;
    flex-shrink: 0;
}

.navbar-brand-logo::before {
    content: "";
    position: absolute;
    width: 100px;
    height: 30px;
    background: rgba(100, 255, 218, 0.2);
    transform: rotate(-45deg) translate(-80px);
    transition: .5s;
}

.navbar-brand:hover .navbar-brand-logo::before {
    transform: rotate(-45deg) translate(80px);
}

.navbar-brand:hover .navbar-brand-logo {
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 0 25px rgba(100, 255, 218, 0.4);
}

.brand-title {
    font-size: 1.25rem;
    font-weight: 900;
    letter-spacing: 1px;
    background: linear-gradient(90deg, var(--white), var(--cyan-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* ==========================
   NAV MENU LINKS
========================== */
.sidebar-menu {
    padding: 1.25rem 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    flex-grow: 1;
}

.nav-link-custom {
    color: var(--text-slate) !important;
    padding: 0.8rem 1rem !important;
    border-radius: 14px;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 600;
    transition: .3s;
    position: relative;
    overflow: hidden;
    text-decoration: none;
}

.nav-link-custom i {
    font-size: 1.15rem;
    transition: .3s;
    color: var(--text-slate);
}

.nav-link-custom:hover {
    color: var(--cyan-accent) !important;
    background: rgba(100, 255, 218, 0.08);
    transform: translateX(4px);
}

.nav-link-custom:hover i {
    color: var(--cyan-accent);
    transform: scale(1.2);
}

/* ACTIVE MENU */
.nav-link-custom.active {
    color: #0a192f !important;
    background: var(--cyan-accent) !important;
    font-weight: 700;
    box-shadow: 0 5px 20px rgba(100, 255, 218, 0.3);
}

.nav-link-custom.active i {
    color: #0a192f !important;
}

/* ==========================
   USER PROFILE & LOGOUT
========================== */
.sidebar-footer {
    padding: 1rem;
    border-top: 1px solid var(--bg-light-navy);
    background: rgba(2, 12, 27, 0.5);
}

.user-profile-card {
    background: var(--bg-slate-navy);
    border: 1px solid var(--bg-light-navy);
    backdrop-filter: blur(15px);
    border-radius: 16px;
    padding: 0.6rem 0.75rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 0.5rem;
    transition: .3s;
}

.user-profile-card:hover {
    border-color: rgba(100, 255, 218, 0.5);
    box-shadow: 0 0 15px rgba(100, 255, 218, 0.15);
}

.btn-logout-custom {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-slate) !important;
    background: var(--bg-light-navy);
    border: 1px solid rgba(255, 255, 255, 0.05);
    transition: .35s;
    flex-shrink: 0;
}

.btn-logout-custom:hover {
    background: var(--danger) !important;
    color: white !important;
    border-color: var(--danger);
    box-shadow: 0 0 15px rgba(255, 107, 107, 0.5);
    transform: rotate(90deg);
}

/* ==========================
   RESPONSIVE MOBILE
========================== */
.mobile-navbar-header {
    display: none;
    background: #020c1b;
    padding: 0.75rem 1.25rem;
    border-bottom: 1px solid var(--bg-light-navy);
}

@media (max-width: 991.98px) {
    .mobile-navbar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 1020;
    }

    .sidebar-custom {
        transform: translateX(-100%);
    }

    .sidebar-custom.show {
        transform: translateX(0);
    }
}
</style>

{{-- HEADER UNTUK MOBILE --}}
<div class="mobile-navbar-header">
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('dashboard') }}">
        <div class="navbar-brand-logo" style="width:36px; height:36px;">
            <img src="{{ asset('images/vly.png') }}" alt="Logo Vlyhadi" class="w-100 h-100 object-fit-cover">
        </div>
        <span class="brand-title" style="font-size: 1.1rem;">KUDE</span>
    </a>
    <button class="btn text-white p-1 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
        <i class="bi bi-list fs-2" style="color: var(--cyan-accent);"></i>
    </button>
</div>

{{-- SIDEBAR UTAMA --}}
<aside class="sidebar-custom collapse d-lg-flex" id="sidebarMenu">

    <div class="sidebar-header">
        <a class="navbar-brand d-flex align-items-center gap-3" href="{{ route('dashboard') }}">
            <div class="navbar-brand-logo">
                <img src="{{ asset('images/image copy.png') }}" alt="Logo KUDE" class="w-100 h-100 object-fit-cover">
            </div>
            <div>
                <span class="brand-title">KUDE</span>
            </div>
        </a>
    </div>

    <ul class="sidebar-menu list-unstyled mb-0">
        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('dashboard*') ? 'active':'' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @php
            $userRole = '';
            if(Auth::check() && Auth::user()->role){
                $userRole = strtolower(Auth::user()->role->name ?? Auth::user()->role);
            }
        @endphp

        @if(Auth::check() && $userRole == 'admin')
        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('admin/users*')?'active':'' }}" href="{{ route('admin.users') }}">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>
        </li>
        @endif

        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('produk*')?'active':'' }}" href="{{ route('produk.index') }}">
                <i class="bi bi-box-seam-fill"></i>
                <span>Produk</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link-custom {{ Request::is('penjualan*')?'active':'' }}" href="{{ route('penjualan.index') }}">
                <i class="bi bi-cart-check-fill"></i>
                <span>Penjualan</span>
            </a>
        </li>
    </ul>

    @auth
    <div class="sidebar-footer">
        <div class="user-profile-card">
            {{-- Tombol Klik Profil (Modal Trigger) --}}
            <button type="button"
                    class="btn p-0 border-0 bg-transparent text-start d-flex align-items-center gap-2 overflow-hidden flex-grow-1"
                    data-bs-toggle="modal"
                    data-bs-target="#userProfileSidebarModal">

                <img src="{{ asset('images/image copy.png') }}"
                     alt="Foto Profil"
                     class="rounded-circle object-fit-cover border border-info"
                     style="width: 36px; height: 36px; flex-shrink: 0;">

                <div class="text-truncate">
                    <div class="fw-bold text-truncate" style="font-size: 0.875rem; color: var(--white);">
                        {{ Auth::user()->name }}
                    </div>
                    <small class="text-uppercase d-block fw-semibold" style="font-size: 0.7rem; color: var(--cyan-accent);">
                        {{ optional(Auth::user()->role)->name ?? Auth::user()->role ?? 'Staff' }}
                    </small>
                </div>
            </button>

            {{-- Tombol Logout Langsung --}}
            <form action="{{ route('logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-logout-custom" title="Logout">
                    <i class="bi bi-power"></i>
                </button>
            </form>
        </div>
    </div>
    @endauth

</aside>
