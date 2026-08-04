<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Kasir')</title>

    {{-- Bootstrap 5 CSS & Icons via CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b132b;
            color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Penyesuaian area Konten Utama agar tidak tertutup/tertindih Sidebar */
        @media (min-width: 992px) {
            .main-wrapper {
                margin-left: var(--sidebar-width) !important;
                width: calc(100% - var(--sidebar-width)) !important;
            }
        }
    </style>
</head>
<body class="antialiased">

    {{-- KONTEN UTAMA HALAMAN --}}
    <div class="main-wrapper min-vh-100">

        {{-- Alert Notifikasi Success --}}
        @if(session('success'))
            <div class="container-fluid px-4 pt-3">
                <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- Alert Notifikasi Error --}}
        @if(session('error'))
            <div class="container-fluid px-4 pt-3">
                <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- Main Content --}}
        <main>
            @yield('content')
        </main>
    </div>

    {{-- ==================== MODAL POP-UP PROFIL ==================== --}}
    @auth
    <div class="modal fade" id="userProfileSidebarModal" tabindex="-1" aria-labelledby="userProfileSidebarModalLabel" aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg text-center" style="border-radius: 20px; background-color: #ffffff; color: #0f172a;">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 pt-0 pb-4">
                    {{-- Foto Profil --}}
                    <img src="{{ asset('images/image copy.png') }}"
                         alt="Foto Profil"
                         class="mx-auto mb-3 rounded-circle shadow object-fit-cover"
                         style="width: 80px; height: 80px; border: 3px solid #64ffda;">

                    {{-- Informasi User --}}
                    <h5 class="fw-bold mb-1" style="color: #0f172a !important;">{{ Auth::user()->name ?? Auth::user()->username }}</h5>
                    <p class="text-muted small mb-2">{{ Auth::user()->email ?? 'Kasir Aktif' }}</p>

                    <span class="badge bg-success-subtle text-success border border-success-subtle text-uppercase px-3 py-1.5 rounded-pill fw-semibold small">
                        <i class="bi bi-shield-check me-1"></i> {{ optional(Auth::user()->role)->name ?? Auth::user()->role ?? 'Kasir' }}
                    </span>

                    <hr class="my-3" style="border-color: #e2e8f0;">

                    {{-- Tombol Logout --}}
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

    {{-- Bootstrap 5 JS Bundle via CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
