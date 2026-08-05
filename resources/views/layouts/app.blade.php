<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem Kasir')</title>

    {{-- Bootstrap 5 CSS & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ==========================================================
           1. GLOBAL CORE VARIABLES & THEME (ROYAL BLUE)
        ========================================================== */
        :root {
            --sidebar-width: 260px;
            --bg-body: #f0f5ff;             /* Background aplikasi (Soft Light Blue) */
            --card-bg: #ffffff;             /* Background Card/Tabel Putih Bersih */
            --border-color: #cce0ff;        /* Border Biru Soft */
            --text-main: #0a1c33;           /* Teks Kontras Utama */
            --text-muted: #475569;          /* Sub-teks */
            --accent-blue: #0d6efd;         /* Biru Royal Utama */
            --accent-hover: #0b5ed7;        /* Biru Royal Hover */
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body) !important;
            color: var(--text-main);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Penyesuaian Area Utama untuk memberikan ruang ke Sidebar */
        @media (min-width: 992px) {
            .main-wrapper {
                margin-left: var(--sidebar-width) !important;
                width: calc(100% - var(--sidebar-width)) !important;
            }
        }

        /* ==========================================================
           2. OVERRIDE SIDEBAR (ROYAL BLUE CONSISTENCY)
        ========================================================== */
        .sidebar, 
        .sidebar-custom, 
        aside,
        [class*="sidebar"] {
            background: linear-gradient(180deg, #0d6efd 0%, #0b5ed7 100%) !important;
            color: #ffffff !important;
        }

        .sidebar a, 
        .sidebar .nav-link,
        .sidebar-custom a {
            color: rgba(255, 255, 255, 0.85) !important;
            font-weight: 600 !important;
            border-radius: 12px;
            transition: all 0.2s ease;
        }

        .sidebar .nav-link.active,
        .sidebar a.active {
            background-color: #ffffff !important;
            color: #0d6efd !important; /* Teks Biru Royal */
            font-weight: 800 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .sidebar .nav-link:hover:not(.active),
        .sidebar a:hover:not(.active) {
            background-color: rgba(255, 255, 255, 0.15) !important;
            color: #ffffff !important;
        }

        /* ==========================================================
           3. OVERRIDE TABEL & CARD UNTUK PERBAIKAN DASHBOARD
        ========================================================== */
        .card,
        .table-responsive,
        .table {
            background-color: var(--card-bg) !important;
            color: var(--text-main) !important;
        }

        .table th {
            background-color: #f8fafc !important;
            color: var(--accent-blue) !important;
            font-weight: 700 !important;
            border-bottom: 1px solid var(--border-color) !important;
        }

        .table td {
            color: var(--text-main) !important;
            border-bottom: 1px solid #f1f5f9 !important;
        }

        .table-dark,
        .table-dark td,
        .table-dark th {
            background-color: #ffffff !important;
            color: var(--text-main) !important;
            border-color: var(--border-color) !important;
        }

        /* ==========================================================
           4. PERBAIKAN WARNA HIJAU SISA (BUKA KASIR & BADGE KASIR)
        ========================================================== */
        /* Ubah tombol Buka Kasir Hijau menjadi Royal Blue Gradient */
        a[href*="kasir"].btn-success,
        .btn-buka-kasir {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
            color: #ffffff !important;
            border: none !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25) !important;
        }

        /* Badge nama kasir di tabel */
        .badge-kasir,
        .custom-table td .badge-success {
            background-color: #e0f2fe !important;
            color: #0284c7 !important;
            border: 1px solid #bae6fd !important;
            font-weight: 700 !important;
        }

        /* Custom Scrollbar agar rapi */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #0d6efd;
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased">

    {{-- Pemanggilan Sidebar --}}
    @include('layouts.sidebar')

    {{-- Area Konten Utama --}}
    <div class="main-wrapper min-vh-100 d-flex flex-column">

        {{-- Notifikasi Sukses --}}
        @if(session('success'))
            <div class="container-fluid px-4 pt-3">
                <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-0" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- Notifikasi Error --}}
        @if(session('error'))
            <div class="container-fluid px-4 pt-3">
                <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-0" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- Main Yield Content --}}
        <main class="p-3 p-md-4 flex-grow-1">
            @yield('content')
        </main>
    </div>

    {{-- Modal Pop-up Profil --}}
    @auth
    <div class="modal fade" id="userProfileSidebarModal" tabindex="-1" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow text-center" style="border-radius: 20px; background-color: #ffffff; color: #0f172a;">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pt-0 pb-4">
                    {{-- Tambahkan ?v=2 agar selalu membaca gambar R.png terbaru --}}
                    <img src="{{ asset('images/R.png') }}?v=2" alt="Foto Profil" class="mx-auto mb-3 rounded-circle shadow-sm object-fit-cover" style="width: 80px; height: 80px; border: 3px solid #0d6efd;">
                    
                    <h5 class="fw-bold mb-1" style="color: #0f172a !important;">{{ Auth::user()->name ?? Auth::user()->username }}</h5>
                    <p class="text-muted small mb-2">{{ Auth::user()->email ?? 'Kasir Aktif' }}</p>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle text-uppercase px-3 py-1.5 rounded-pill fw-semibold small">
                        <i class="bi bi-shield-check me-1"></i> {{ optional(Auth::user()->role)->name ?? Auth::user()->role ?? 'Kasir' }}
                    </span>
                    <hr class="my-3" style="border-color: #e2e8f0;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100 rounded-pill fw-bold py-2 d-flex align-items-center justify-content-center gap-2 shadow-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout / Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script Tambahan untuk Toggle Mobile Sidebar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const sidebar = document.getElementById('sidebarMenu');
            
            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>