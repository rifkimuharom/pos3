@extends('layouts.app')

@section('title', 'Dashboard - POS System')

@section('content')

<style>
    /* CSS VARIABLES: ROYAL BLUE THEME */
    :root {
        --bg-main: #f0f5ff;             /* Latar belakang utama (Biru Sangat Muda & Segar) */
        --bg-card: #ffffff;             /* Kartu Utama (Putih Bersih agar Kontras) */
        --bg-card-sub: #e6f0ff;         /* Latar Sub-card / Header Tabel (Biru Soft) */
        --bg-banner: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 50%, #0a58ca 100%); /* Banner Biru Royal */
        --cyan-accent: #0d6efd;         /* Aksentuasi Utama (Biru Royal) */
        --cyan-hover: #0b5ed7;          /* Biru Hover */
        --text-primary: #1f3a60;        /* Teks Isian (Biru Gelap Teks) */
        --text-heading: #0a1c33;        /* Judul Utama (Sangat Gelap / Kontras) */
        --text-muted: #6c757d;          /* Teks Sekunder / Redup */
        --border-color: #cce0ff;        /* Border Soft Biru */
        --table-hover: rgba(13, 110, 253, 0.06); /* Efek Hover Tabel */
        --shadow-color: rgba(13, 110, 253, 0.08); /* Bayangan Halus Biru */
    }

    /* DARK MODE OVERRIDES (OPSIONAL) */
    body.dark-theme {
        --bg-main: #0a192f;
        --bg-card: #112240;
        --bg-card-sub: #1e3a5f;
        --bg-banner: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        --cyan-accent: #3d8bfd;
        --cyan-hover: #0d6efd;
        --text-primary: #e2e8f0;
        --text-heading: #ffffff;
        --text-muted: #94a3b8;
        --border-color: #233554;
        --table-hover: rgba(61, 139, 253, 0.1);
        --shadow-color: rgba(0, 0, 0, 0.3);
    }

    body {
        background-color: var(--bg-main) !important;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        color: var(--text-primary);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    /* ================= TOPBAR HEADER ================= */
    .topbar-wrapper {
        background: var(--bg-card) !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 16px;
        padding: 0.75rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px var(--shadow-color);
    }

    .topbar-search-box {
        position: relative;
        width: 320px;
    }

    .topbar-search-box input {
        background: var(--bg-main);
        border: 1px solid var(--border-color);
        border-radius: 10px;
        padding: 0.5rem 0.75rem 0.5rem 2.3rem;
        font-size: 0.875rem;
        width: 100%;
        color: var(--text-heading);
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .topbar-search-box input:focus {
        border-color: var(--cyan-accent);
        background: #ffffff;
        outline: none;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }

    .topbar-search-box i {
        position: absolute;
        left: 0.8rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-muted);
    }

    .btn-quick-kasir {
        background: #10b981 !important;
        color: #ffffff !important;
        font-weight: 700;
        border-radius: 10px;
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .btn-quick-kasir:hover {
        background: #059669 !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 15px rgba(16, 185, 129, 0.3);
    }

    /* HEADER BANNER */
    .dashboard-header-banner {
        background: var(--bg-banner) !important;
        border-radius: 20px;
        padding: 2.5rem 2.25rem;
        color: #ffffff !important;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.25);
        position: relative;
        overflow: hidden;
        border: none;
        transition: all 0.3s ease;
    }

    .dashboard-header-banner::after {
        content: '';
        position: absolute;
        top: -40%;
        right: -8%;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        pointer-events: none;
    }

    .date-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 50px;
        padding: 0.4rem 1rem;
        font-size: 0.825rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* QUICK ACTIONS BUTTONS */
    .btn-quick-action {
        background: #ffffff;
        color: var(--cyan-accent) !important;
        border-radius: 12px;
        padding: 0.65rem 1.25rem;
        font-weight: 700;
        font-size: 0.875rem;
        transition: all 0.25s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-quick-action:hover {
        background: #f0f5ff;
        color: var(--cyan-hover) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    /* DASHBOARD CARDS */
    .dashboard-card {
        border-radius: 20px;
        border: 1px solid var(--border-color) !important;
        background: var(--bg-card) !important;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px var(--shadow-color);
        position: relative;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-4px);
        border-color: var(--cyan-accent) !important;
        box-shadow: 0 12px 30px rgba(13, 110, 253, 0.15);
    }

    .card-top-accent {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--border-color);
    }

    .card-top-accent-accent {
        background: var(--cyan-accent) !important;
    }

    .icon-box-modern {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        transition: all 0.25s ease;
    }

    .bg-accent-subtle-custom {
        background-color: rgba(13, 110, 253, 0.1) !important;
        color: var(--cyan-accent) !important;
    }

    .bg-navy-subtle-custom {
        background-color: var(--bg-card-sub) !important;
        color: var(--cyan-accent) !important;
    }

    .section-title {
        color: var(--text-heading);
        font-weight: 800;
    }

    /* TABLES STYLE */
    .table-custom {
        margin-bottom: 0;
        color: var(--text-primary) !important;
    }

    .table-custom thead {
        background-color: var(--bg-card-sub) !important;
    }

    .table-custom th {
        color: var(--cyan-accent) !important;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 700;
        padding: 0.875rem 1.25rem;
        border-bottom: 1px solid var(--border-color) !important;
    }

    .table-custom td {
        padding: 1rem 1.25rem;
        color: var(--text-primary) !important;
        border-bottom: 1px solid var(--border-color) !important;
        font-size: 0.9rem;
    }

    .table-custom tbody tr:hover {
        background: var(--table-hover) !important;
    }

    /* ACTION TILE STYLE */
    .action-tile {
        display: flex;
        align-items: center;
        gap: 0.875rem;
        padding: 0.875rem 1rem;
        border-radius: 12px;
        border: 1px solid var(--border-color);
        background-color: var(--bg-card-sub);
        text-decoration: none;
        color: var(--text-heading);
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.25s ease;
    }

    .action-tile:hover {
        background-color: #ffffff;
        border-color: var(--cyan-accent);
        color: var(--cyan-accent);
        transform: translateX(4px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.1);
    }

    /* TEXT COLOR OVERRIDES */
    .text-heading-theme { color: var(--text-heading) !important; }
    .text-muted-theme { color: var(--text-muted) !important; }
    .bg-card-sub-theme { background-color: var(--bg-card-sub) !important; }

    @media(max-width: 768px) {
        .dashboard-header-banner { padding: 1.5rem; }
        .dashboard-header-banner h1 { font-size: 1.5rem !important; }
        .topbar-wrapper { flex-direction: column; gap: 0.75rem; align-items: stretch; }
        .topbar-search-box { width: 100%; }
    }
</style>

<div class="container py-4">

    {{-- TOPBAR SEARCH & NOTIFIKASI DROPDOWN --}}
    <div class="topbar-wrapper">
        <div class="topbar-search-box">
            <i class="bi bi-search"></i>
            <input type="text" placeholder="Cari produk / no. transaksi...">
        </div>

        <div class="d-flex align-items-center justify-content-between justify-content-md-end gap-3">
            
            {{-- DROPDOWN NOTIFIKASI --}}
            <div class="dropdown">
                <button class="btn btn-light position-relative rounded-circle border p-2" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Notifikasi Stok" style="width: 38px; height: 38px; display: flex; align-items: center; justify-content: center; background: var(--bg-main); border-color: var(--border-color) !important;">
                    <i class="bi bi-bell text-secondary fs-6"></i>
                    @if(count($produkStokRendah) > 0 || count($produkStokHabis) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                    @endif
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2 mt-2" style="width: 280px; border-radius: 12px;">
                    <li class="dropdown-header fw-bold text-dark fs-6">Pemberitahuan Stok</li>
                    <li><hr class="dropdown-divider my-1"></li>

                    @if(count($produkStokRendah) > 0)
                        <li>
                            <a class="dropdown-item small text-warning d-flex align-items-center gap-2 rounded py-2" href="#">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                <span>{{ count($produkStokRendah) }} Produk Stok Menipis</span>
                            </a>
                        </li>
                    @endif

                    @if(count($produkStokHabis) > 0)
                        <li>
                            <a class="dropdown-item small text-danger d-flex align-items-center gap-2 rounded py-2" href="#">
                                <i class="bi bi-x-circle-fill"></i>
                                <span>{{ count($produkStokHabis) }} Produk Stok Habis</span>
                            </a>
                        </li>
                    @endif

                    @if(count($produkStokRendah) == 0 && count($produkStokHabis) == 0)
                        <li><span class="dropdown-item small text-muted text-center py-2">Semua stok produk aman</span></li>
                    @endif
                </ul>
            </div>

          {{-- TOMBOL KASIR --}}
<a href="{{ route('penjualan.index') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 rounded-3 fw-bold border-0 shadow-sm" style="background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);">
    <i class="bi bi-cart-plus-fill fs-6"></i>
    <span>Buka Kasir</span>
</a>
        </div>
    </div>

    {{-- HEADER BANNER + LIVE CLOCK --}}
    <div class="dashboard-header-banner mb-4">
        <div class="row align-items-center g-3 position-relative" style="z-index: 1;">
            <div class="col-lg-7">
                <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                    <div class="date-badge">
                        <i class="bi bi-calendar3"></i>
                        <span>Hari ini &bull; {{ $tanggalHariIni->translatedFormat('l, d F Y') }}</span>
                    </div>
                    {{-- LIVE DIGITAL CLOCK --}}
                    <div class="date-badge">
                        <i class="bi bi-clock-history"></i>
                        <span id="liveClock">00:00:00 WIB</span>
                    </div>
                </div>
                <h1 class="fw-bold text-white mb-2 fs-2">
                    Selamat Datang Di POS
                </h1>
                <p class="text-white-50 mb-0">Berikut adalah ringkasan aktivitas transaksi, inventaris, dan performa toko Anda.</p>
            </div>

            {{-- TOMBOL AKSES CEPAT BANNER --}}
            <div class="col-lg-5 text-lg-end d-flex flex-wrap gap-2 justify-content-lg-end align-items-center">
                <a href="{{ route('penjualan.index') }}" class="btn-quick-action">
                    <i class="bi bi-cart-plus fs-5"></i> Kasir / Transaksi
                </a>
                <a href="{{ route('produk.index') }}" class="btn-quick-action">
                    <i class="bi bi-box-seam fs-5"></i> Kelola Produk
                </a>
            </div>
        </div>
    </div>

    {{-- SALES OVERVIEW (ADMIN/OWNER ONLY) --}}
    @can('viewAny', App\Models\User::class)

    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <div class="icon-box-modern bg-accent-subtle-custom me-3 shadow-sm">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            <div>
                <h4 class="section-title mb-0 fs-5">Penjualan Hari Ini</h4>
                <span class="text-muted-theme small">Rincian performa keuangan harian</span>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">

        {{-- TOTAL PENJUALAN --}}
        <div class="col-md-6 col-xl-3">
            <div class="card dashboard-card h-100 p-3">
                <div class="card-top-accent card-top-accent-accent"></div>
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted-theme small fw-bold text-uppercase">Total Pendapatan</span>
                        <div class="icon-box-modern bg-accent-subtle-custom">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold mb-2 text-heading-theme fs-3">
                        Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}
                    </h3>
                    <span class="badge rounded-pill fw-semibold bg-accent-subtle-custom" style="font-size: 0.75rem;">
                        <i class="bi bi-arrow-up-short"></i> Omset Hari Ini
                    </span>
                </div>
            </div>
        </div>

        {{-- JUMLAH TRANSAKSI --}}
        <div class="col-md-6 col-xl-3">
            <a href="{{ route('penjualan.index') }}" class="text-decoration-none">
                <div class="card dashboard-card h-100 p-3">
                    <div class="card-top-accent"></div>
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <span class="text-muted-theme small fw-bold text-uppercase">Jumlah Transaksi</span>
                            <div class="icon-box-modern bg-navy-subtle-custom">
                                <i class="bi bi-receipt"></i>
                            </div>
                        </div>
                        <h3 class="fw-bold mb-2 text-heading-theme fs-3">
                            {{ number_format($ringkasan['total_transaksi'], 0, ',', '.') }} <span class="fs-6 text-muted-theme fw-normal">Transaksi</span>
                        </h3>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted-theme small">Total pesanan selesai</span>
                            <span class="small fw-bold" style="color: var(--cyan-accent);">Lihat Semua <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- PEMBAYARAN TUNAI --}}
        <div class="col-md-6 col-xl-3">
            <div class="card dashboard-card h-100 p-3">
                <div class="card-top-accent bg-success"></div>
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted-theme small fw-bold text-uppercase">Tunai (Cash)</span>
                        <div class="icon-box-modern bg-success-subtle text-success">
                            <i class="bi bi-wallet2"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-success mb-2 fs-3">
                        Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}
                    </h3>
                    <span class="text-muted-theme small">Uang di laci kasir</span>
                </div>
            </div>
        </div>

        {{-- PEMBAYARAN NON TUNAI --}}
        <div class="col-md-6 col-xl-3">
            <div class="card dashboard-card h-100 p-3">
                <div class="card-top-accent bg-primary"></div>
                <div class="card-body p-0">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted-theme small fw-bold text-uppercase">Non Tunai (QRIS/TF)</span>
                        <div class="icon-box-modern bg-primary-subtle text-primary">
                            <i class="bi bi-credit-card"></i>
                        </div>
                    </div>
                    <h3 class="fw-bold text-primary mb-2 fs-3">
                        Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}
                    </h3>
                    <span class="text-muted-theme small">Transfer / QRIS</span>
                </div>
            </div>
        </div>

    </div>

    @endcan

    {{-- PRODUK TERLARIS & PUSAT KENDALI OPERASIONAL KASIR --}}
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            {{-- BEST SELLER PRODUCTS --}}
            <div class="card dashboard-card h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="icon-box-modern bg-accent-subtle-custom" style="width: 42px; height: 42px; font-size: 1.1rem;">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-heading-theme fs-5">Produk Terlaris (Best Seller)</h5>
                            <span class="text-muted-theme small">Item dengan performa penjualan tertinggi</span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 mt-2">
                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Nama Produk</th>
                                    <th>Sisa Stok Saat Ini</th>
                                    <th class="pe-4 text-end">Total Terjual</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($produkTerlaris as $produk)
                                <tr>
                                    <td class="fw-semibold text-heading-theme ps-4">
                                        <i class="bi bi-box-seam me-2 text-muted-theme"></i>{{ $produk->nama }}
                                    </td>
                                    <td>
                                        <span class="badge bg-card-sub-theme text-heading-theme border px-3 py-1.5 fw-normal rounded-pill" style="border-color: var(--border-color) !important;">
                                            {{ $produk->stok }} Unit Sisa
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <span class="badge bg-accent-subtle-custom px-3 py-2 rounded-pill fw-bold">
                                            <i class="bi bi-bag-check-fill me-1"></i> {{ number_format($produk->total_terjual, 0, ',', '.') }} Terjual
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted-theme">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        <span>Belum ada data penjualan produk terlaris</span>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- WIDGET PUSAT AKSES CEPAT & SHIFT KASIR --}}
        <div class="col-lg-4">
            <div class="card dashboard-card h-100 p-4">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="icon-box-modern bg-accent-subtle-custom" style="width: 42px; height: 42px; font-size: 1.1rem;">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-heading-theme fs-6">Pusat Pintasan Kasir</h5>
                        <span class="text-muted-theme small">Menu navigasi praktis harian</span>
                    </div>
                </div>

                {{-- DAFTAR TOMBOL AKSES CEPAT --}}
                <div class="d-flex flex-column gap-2 my-2">
                    <a href="{{ route('penjualan.create') ?? route('penjualan.index') }}" class="action-tile">
                        <i class="bi bi-plus-circle-fill text-primary fs-5"></i>
                        <span>Buat Transaksi Baru</span>
                    </a>

                    <a href="{{ route('produk.create') ?? route('produk.index') }}" class="action-tile">
                        <i class="bi bi-box-seam-fill text-warning fs-5"></i>
                        <span>Tambah Stok / Produk</span>
                    </a>
                </div>

                {{-- INFORMASI SHIFT KASIR AKTIF --}}
                <div class="pt-3 border-top mt-auto" style="border-color: var(--border-color) !important;">
                    <div class="p-3 rounded-3 bg-card-sub-theme border mb-3" style="border-color: var(--border-color) !important;">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="text-muted-theme small">Petugas Kasir:</span>
                            <span class="fw-bold small text-heading-theme">{{ auth()->user()->name ?? 'Kasir' }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="text-muted-theme small">Status Peran:</span>
                            <span class="badge bg-accent-subtle-custom fw-semibold text-capitalize">
                                @if(is_object(auth()->user()->role))
                                    {{ optional(auth()->user()->role)->name ?? 'Petugas' }}
                                @else
                                    {{ auth()->user()->role ?? 'Petugas' }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1.5 fw-semibold">
                            <i class="bi bi-circle-fill me-1" style="font-size: 0.5rem;"></i> Sistem Siap
                        </span>
                        <span class="text-muted-theme small">
                            <i class="bi bi-shield-check text-success me-1"></i> POS Online
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- STATS RINGKASAN PRODUK & INVENTARIS --}}
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div class="d-flex align-items-center">
            <div class="icon-box-modern bg-warning-subtle text-warning me-3 shadow-sm">
                <i class="bi bi-box-seam-fill"></i>
            </div>
            <div>
                <h4 class="section-title mb-0 fs-5">Status Inventaris</h4>
                <span class="text-muted-theme small">Pantau ketersediaan produk di gudang</span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">

        {{-- STOK MENIPIS --}}
        <div class="col-lg-6">
            <div class="card dashboard-card h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2 d-flex align-items-center justify-content-between">
                    <span class="fw-bold text-warning d-flex align-items-center gap-2 fs-6">
                        <i class="bi bi-exclamation-triangle-fill"></i> Stok Menipis
                    </span>
                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1">
                        {{ method_exists($produkStokRendah, 'count') ? $produkStokRendah->count() : count($produkStokRendah) }} Produk
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4" style="width: 60px;">#</th>
                                    <th>Produk</th>
                                    <th class="pe-4 text-end">Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($produkStokRendah as $index => $produk)
                                <tr>
                                    <td class="ps-4 text-muted-theme small fw-semibold">
                                        {{ method_exists($produkStokRendah, 'firstItem') ? $produkStokRendah->firstItem() + $index : $loop->iteration }}
                                    </td>
                                    <td class="fw-semibold text-heading-theme">{{ $produk->nama }}</td>
                                    <td class="pe-4 text-end">
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-3 py-1 fw-bold">
                                            {{ $produk->stok }} Unit
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted-theme">
                                        <i class="bi bi-check-circle-fill text-success fs-1 d-block mb-2"></i>
                                        <span>Stok barang masih dalam batas aman</span>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- STOK HABIS --}}
        <div class="col-lg-6">
            <div class="card dashboard-card h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2 d-flex align-items-center justify-content-between">
                    <span class="fw-bold text-danger d-flex align-items-center gap-2 fs-6">
                        <i class="bi bi-x-circle-fill"></i> Stok Habis
                    </span>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1">
                        {{ method_exists($produkStokHabis, 'count') ? $produkStokHabis->count() : count($produkStokHabis) }} Produk
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4" style="width: 60px;">#</th>
                                    <th>Produk</th>
                                    <th class="pe-4 text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($produkStokHabis as $index => $produk)
                                <tr>
                                    <td class="ps-4 text-muted-theme small fw-semibold">
                                        {{ method_exists($produkStokHabis, 'firstItem') ? $produkStokHabis->firstItem() + $index : $loop->iteration }}
                                    </td>
                                    <td class="fw-semibold text-heading-theme">{{ $produk->nama }}</td>
                                    <td class="pe-4 text-end">
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1 fw-bold">
                                            Habis (0)
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted-theme">
                                        <i class="bi bi-emoji-smile-fill text-primary fs-1 d-block mb-2"></i>
                                        <span>Tidak ada stok produk yang habis</span>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- SCRIPT REALTIME CLOCK --}}
<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const clockElem = document.getElementById('liveClock');
        if (clockElem) {
            clockElem.textContent = `${hours}:${minutes}:${seconds} WIB`;
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

@endsection