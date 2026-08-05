@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')

@include('layouts.navbar')

<style>
/* ==========================================================
   1. GLOBAL COLOR PALETTE & VARIABLES (ROYAL BLUE THEME)
========================================================== */
:root {
    --bg-body: #f0f5ff;             /* Latar belakang utama (Biru Soft Segar) */
    --card-bg: #ffffff;             /* Kartu & Modal (Putih Bersih) */
    --border-color: #cce0ff;        /* Border Soft Biru */
    --text-primary: #0a1c33;        /* Teks Utama (Gelap Kontras) */
    --text-secondary: #475569;      /* Teks Sekunder (Abu-abu Tua) */
    --accent-primary: #0d6efd;      /* Biru Royal */
    --accent-hover: #0b5ed7;        /* Biru Royal Hover */
    --danger: #dc3545;            /* Merah Danger */
}

body {
    background-color: var(--bg-body) !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--text-primary);
}

/* ==========================================================
   2. HEADER BANNER (KELOLA PRODUK)
========================================================== */
.banner-light {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 60%, #0a58ca 100%) !important;
    color: #ffffff !important;
    border-radius: 16px;
    padding: 2rem 2.25rem;
    box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
    border: none !important;
}

.banner-light h1,
.banner-light h2,
.banner-light h3,
.banner-light h4 {
    color: #ffffff !important;
    font-weight: 800;
}

.banner-light p,
.banner-light small {
    color: rgba(255, 255, 255, 0.92) !important;
    font-weight: 500;
}

/* ==========================================================
   3. STAT CARDS (TOTAL PRODUK, ITEM STOK, STOK KRITIS, DLSB)
========================================================== */
.custom-card,
.stat-card {
    background-color: var(--card-bg) !important;
    border-radius: 16px;
    border: 1px solid var(--border-color) !important;
    box-shadow: 0 4px 15px rgba(13, 110, 253, 0.05);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15) !important;
    border-color: var(--accent-primary) !important;
}

/* Memaksa Teks di Stat Card Sangat Jelas & Tebal */
.stat-card,
.stat-card *,
.stat-card h1, .stat-card h2, .stat-card h3, 
.stat-card h4, .stat-card h5, .stat-card h6,
.stat-card span, .stat-card p, .stat-card div {
    color: #0a1c33 !important;
    font-weight: 700 !important;
}

.stat-card .text-secondary,
.stat-card .text-muted,
.stat-card small,
.stat-card label {
    color: #475569 !important;
    font-weight: 600 !important;
}

/* ==========================================================
   4. TABEL PRODUK & CONTAINER
========================================================== */
.custom-table {
    color: var(--text-primary) !important;
    --bs-table-bg: #ffffff !important;
    margin-bottom: 0;
}

.bg-table-head {
    background-color: var(--bg-body) !important;
}

.table-head-text,
.custom-table th {
    color: var(--accent-primary) !important;
    font-weight: 700;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    font-size: 0.75rem;
    border-bottom: 1px solid var(--border-color) !important;
}

.custom-table td {
    border-color: var(--border-color) !important;
    color: #0a1c33 !important;
    font-weight: 500;
    vertical-align: middle;
}

.custom-table tbody tr {
    background-color: #ffffff !important;
    border-bottom: 1px solid var(--border-color) !important;
    transition: background-color 0.15s ease;
}

.custom-table tbody tr:hover {
    background-color: rgba(13, 110, 253, 0.04) !important;
}

/* Gambar / Placeholder Thumbnail Produk */
.product-thumb-placeholder {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background-color: rgba(13, 110, 253, 0.08);
    color: var(--accent-primary);
    border: 1px solid var(--border-color);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

/* ==========================================================
   5. SEARCH, FILTER DROPDOWN & PLACEHOLDER
========================================================== */
.bg-search,
.form-select {
    background-color: #ffffff !important;
    border-color: var(--border-color) !important;
    color: var(--text-primary) !important;
    font-weight: 600 !important;
    border-radius: 10px;
}

.bg-search::placeholder {
    color: #64748b !important;
    opacity: 1 !important;
}

.search-box input:focus,
.search-box select:focus,
.bg-search:focus {
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
    border-color: var(--accent-primary) !important;
}

/* ==========================================================
   6. BADGES STATUS STOK PRODUK
========================================================== */
.badge-soft-primary {
    background-color: rgba(13, 110, 253, 0.12) !important;
    color: #0d6efd !important;
    border: 1px solid rgba(13, 110, 253, 0.3) !important;
    font-weight: 700 !important;
}

.badge-soft-success {
    background-color: rgba(25, 135, 84, 0.12) !important;
    color: #198754 !important;
    border: 1px solid rgba(25, 135, 84, 0.3) !important;
    font-weight: 700 !important;
}

.badge-soft-warning {
    background-color: rgba(255, 193, 7, 0.18) !important;
    color: #b45309 !important;
    border: 1px solid rgba(255, 193, 7, 0.4) !important;
    font-weight: 700 !important;
}

.badge-soft-danger {
    background-color: rgba(220, 53, 69, 0.12) !important;
    color: #dc3545 !important;
    border: 1px solid rgba(220, 53, 69, 0.3) !important;
    font-weight: 700 !important;
}

/* ==========================================================
   7. ACTION BUTTONS (DETAIL, EDIT, DELETE, TAMBAH PRODUK)
========================================================== */
/* Tombol Utama (Tambah Produk) */
.btn-primary-custom,
.btn-accent {
    background: var(--accent-primary) !important;
    color: #ffffff !important;
    font-weight: 700;
    border: none !important;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    transition: all 0.2s ease;
    border-radius: 10px;
}

.btn-primary-custom:hover,
.btn-accent:hover {
    background: var(--accent-hover) !important;
    color: #ffffff !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4);
}

/* Tombol Detail (Biru Soft) */
.btn-action-info {
    background-color: rgba(13, 110, 253, 0.1) !important;
    color: #0d6efd !important;
    border: 1px solid rgba(13, 110, 253, 0.25) !important;
    border-radius: 8px;
    transition: all 0.2s ease;
}
.btn-action-info:hover {
    background-color: #0d6efd !important;
    color: #ffffff !important;
    transform: scale(1.05);
}

/* Tombol Edit (Kuning Soft) */
.btn-action-edit {
    background-color: rgba(255, 193, 7, 0.15) !important;
    color: #d97706 !important;
    border: 1px solid rgba(255, 193, 7, 0.35) !important;
    border-radius: 8px;
    transition: all 0.2s ease;
}
.btn-action-edit:hover {
    background-color: #d97706 !important;
    color: #ffffff !important;
    transform: scale(1.05);
}

/* Tombol Hapus (Merah Soft) */
.btn-action-delete {
    background-color: rgba(220, 53, 69, 0.1) !important;
    color: #dc3545 !important;
    border: 1px solid rgba(220, 53, 69, 0.25) !important;
    border-radius: 8px;
    transition: all 0.2s ease;
}
.btn-action-delete:hover {
    background-color: #dc3545 !important;
    color: #ffffff !important;
    transform: scale(1.05);
}
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-light p-4 rounded-4 mb-4 shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
            <div>
                <h2 class="fw-bold mb-1 d-flex align-items-center gap-2 text-dark">
                    <i class="bi bi-box-seam-fill text-primary fs-2"></i> Kelola Produk
                </h2>
                <p class="small mb-0 text-muted">Kelola inventaris, harga jual, dan stok barang toko Anda secara terpusat.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button onclick="window.print()" class="btn btn-outline-secondary rounded-pill px-3 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-printer-fill"></i>
                    <span>Cetak Data</span>
                </button>

                @can('create', App\Models\Produk::class)
                    <a href="{{ route('produk.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Tambah Produk</span>
                    </a>
                @endcan
            </div>
        </div>
    </div>

    {{-- STATISTIK RINGKASAN --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary" style="width: 48px; height: 48px;">
                        <i class="bi bi-boxes fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block text-muted">Total Produk</span>
                        <h5 class="fw-bold mb-0 text-dark">{{ method_exists($products, 'total') ? $products->total() : count($products) }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success" style="width: 48px; height: 48px;">
                        <i class="bi bi-stack fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block text-muted">Total Item Stok</span>
                        <h5 class="fw-bold mb-0 text-dark">{{ $products->sum('stok') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-warning bg-opacity-15 text-warning" style="width: 48px; height: 48px;">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block text-muted">Stok Kritis</span>
                        <h5 class="fw-bold mb-0 text-dark">{{ $products->where('stok', '<=', 10)->where('stok', '>', 0)->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger" style="width: 48px; height: 48px;">
                        <i class="bi bi-x-circle-fill fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block text-muted">Stok Habis</span>
                        <h5 class="fw-bold mb-0 text-dark">{{ $products->where('stok', 0)->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card">

        {{-- FILTER & SEARCH --}}
        <div class="card-header border-0 pt-4 px-4 pb-0 bg-transparent">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="row g-2 justify-content-between align-items-center">
                    <div class="col-md-5 col-lg-4">
                        <div class="input-group search-box">
                            <span class="input-group-text border-end-0 rounded-start-pill ps-3 bg-search">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-start-0 rounded-end-pill ps-0 bg-search shadow-none"
                                placeholder="Cari nama produk..."
                            >
                        </div>
                    </div>

                    <div class="col-md-7 col-lg-6 d-flex align-items-center justify-content-md-end gap-2">
                        <select name="stok_status" class="form-select bg-search rounded-pill shadow-none border w-auto" onchange="this.form.submit()">
                            <option value="">Semua Status Stok</option>
                            <option value="ready" {{ request('stok_status') == 'ready' ? 'selected' : '' }}>Stok Tersedia (>10)</option>
                            <option value="kritis" {{ request('stok_status') == 'kritis' ? 'selected' : '' }}>Stok Kritis (1-10)</option>
                            <option value="habis" {{ request('stok_status') == 'habis' ? 'selected' : '' }}>Stok Habis (0)</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        {{-- TABLE SECTION --}}
        <div class="card-body p-0 mt-3">
            <div class="table-responsive">
                <table class="table align-middle mb-0 custom-table">
                    <thead class="bg-table-head border-bottom">
                        <tr class="table-head-text small">
                            <th class="ps-4" style="width: 5%;">NO</th>
                            <th style="width: 8%;">FOTO</th>
                            <th>NAMA PRODUK</th>
                            <th>DITAMBAHKAN</th>
                            <th>HARGA BELI</th>
                            <th>HARGA JUAL</th>
                            <th>STOK</th>
                            <th class="pe-4 text-end" style="width: 15%;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="ps-4 small fw-medium text-muted">
                                {{ method_exists($products, 'firstItem') ? $products->firstItem() + $loop->index : $loop->iteration }}
                            </td>
                            <td>
                                @if($product->foto && file_exists(public_path('storage/'.$product->foto)))
                                    <img src="{{ asset('storage/'.$product->foto) }}" alt="{{ $product->nama }}" class="border" style="width: 42px; height: 42px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div class="product-thumb-placeholder d-flex align-items-center justify-content-center border">
                                        <i class="bi bi-box-seam fs-5"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-semibold text-dark d-block">{{ $product->nama }}</span>
                            </td>
                            <td class="small">
                                <span class="badge badge-soft-primary px-2 py-1 rounded-pill fw-normal">
                                    <i class="bi bi-person me-1"></i>{{ $product->user->name ?? '-' }}
                                </span>
                            </td>
                            <td class="small fw-medium text-muted">
                                Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                            </td>
                            <td class="fw-bold small text-dark">
                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($product->stok > 10)
                                    <span class="badge badge-soft-success px-3 py-1 rounded-pill fw-semibold">
                                        {{ $product->stok }} Pcs
                                    </span>
                                @elseif($product->stok > 0)
                                    <span class="badge badge-soft-warning px-3 py-1 rounded-pill fw-semibold">
                                        {{ $product->stok }} Pcs
                                    </span>
                                @else
                                    <span class="badge badge-soft-danger px-3 py-1 rounded-pill fw-semibold">
                                        Habis
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('produk.show', $product) }}" class="btn btn-action-info rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Detail">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                    <a href="{{ route('produk.edit', $product) }}" class="btn btn-action-edit rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action-delete rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" title="Hapus">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-muted">
                                <i class="bi bi-box-seam fs-1 d-block mb-2 text-primary"></i>
                                <span>Tidak ada data produk.</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($products, 'hasPages') && $products->hasPages())
            <div class="card-footer border-top px-4 py-3 bg-transparent">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <span class="small text-muted">
                        Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} produk
                    </span>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>

</div>

@endsection