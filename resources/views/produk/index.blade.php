@extends('layouts.app')

@section('title', 'Kelola Produk - Vlyhadi')

@section('content')

@include('layouts.navbar')

<style>
    /* Global Color Palette (Dark Cyberspace Theme) */
    :root {
        --bg-dark-navy: #0a192f;
        --bg-slate-navy: #112240;
        --bg-light-navy: #233554;
        --cyan-accent: #64ffda;
        --text-slate: #8892b0;
        --text-light-slate: #ccd6f6;
        --white: #e6f1ff;
    }

    body {
        background-color: var(--bg-dark-navy) !important;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        color: var(--text-light-slate);
    }

    /* Header Banner */
    .banner-green-gradient {
        background: linear-gradient(135deg, #020c1b 0%, var(--bg-slate-navy) 60%, var(--bg-light-navy) 100%) !important;
        color: var(--white) !important;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(2, 12, 27, 0.8);
        border: 1px solid var(--bg-light-navy);
        position: relative;
        overflow: hidden;
    }

    /* Card Containers */
    .custom-card {
        background-color: var(--bg-slate-navy) !important;
        border: 1px solid var(--bg-light-navy) !important;
    }

    .stat-card {
        background-color: var(--bg-slate-navy) !important;
        border-radius: 16px;
        border: 1px solid var(--bg-light-navy);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.4) !important;
    }

    /* Dark Mode Table Styling */
    .custom-table {
        color: var(--text-light-slate) !important;
    }

    .bg-table-head {
        background-color: var(--bg-light-navy) !important;
    }

    .table-head-text {
        color: var(--cyan-accent) !important;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .custom-table td, .custom-table th {
        border-color: var(--bg-light-navy) !important;
    }

    .product-name-text {
        color: var(--white) !important;
        font-weight: 600;
        transition: color 0.15s ease;
    }

    .custom-table tbody tr {
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: rgba(100, 255, 218, 0.05) !important;
    }

    .custom-table tbody tr:hover .product-name-text {
        color: var(--cyan-accent) !important;
    }

    /* Search Box & Inputs */
    .bg-search {
        background-color: var(--bg-dark-navy) !important;
        border-color: var(--bg-light-navy) !important;
        color: var(--white) !important;
        transition: all 0.2s ease;
    }

    .bg-search::placeholder {
        color: var(--text-slate) !important;
    }

    .search-box:focus-within .bg-search {
        background-color: var(--bg-dark-navy) !important;
        border-color: var(--cyan-accent) !important;
    }

    .search-box input:focus {
        box-shadow: none !important;
        border-color: var(--cyan-accent) !important;
        color: var(--white) !important;
    }

    /* Badges */
    .badge-soft-green {
        background-color: rgba(100, 255, 218, 0.15) !important;
        color: var(--cyan-accent) !important;
        border: 1px solid rgba(100, 255, 218, 0.3) !important;
    }

    .badge-soft-amber {
        background-color: rgba(245, 158, 11, 0.15) !important;
        color: #fbbf24 !important;
        border: 1px solid rgba(245, 158, 11, 0.3) !important;
    }

    .badge-soft-danger {
        background-color: rgba(239, 68, 68, 0.15) !important;
        color: #f87171 !important;
        border: 1px solid rgba(239, 68, 68, 0.3) !important;
    }

    /* Action Buttons */
    .btn-action-info {
        background-color: rgba(56, 189, 248, 0.15) !important;
        color: #38bdf8 !important;
        border: none !important;
    }
    .btn-action-info:hover {
        background-color: #38bdf8 !important;
        color: #0284c7 !important;
        transform: scale(1.08);
    }

    .btn-action-edit {
        background-color: rgba(251, 191, 36, 0.15) !important;
        color: #fbbf24 !important;
        border: none !important;
    }
    .btn-action-edit:hover {
        background-color: #fbbf24 !important;
        color: #78350f !important;
        transform: scale(1.08);
    }

    .btn-action-delete {
        background-color: rgba(248, 113, 113, 0.15) !important;
        color: #f87171 !important;
        border: none !important;
    }
    .btn-action-delete:hover {
        background-color: #f87171 !important;
        color: #7f1d1d !important;
        transform: scale(1.08);
    }

    /* Thumbnail Placeholder */
    .product-thumb-placeholder {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background-color: var(--bg-light-navy);
        color: var(--cyan-accent);
    }

    /* Dark Modal Styling */
    .modal-content-dark {
        background-color: var(--bg-slate-navy) !important;
        border: 1px solid var(--bg-light-navy) !important;
        color: var(--text-light-slate) !important;
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-green-gradient p-4 p-md-5 rounded-4 mb-4 position-relative overflow-hidden shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative" style="z-index: 1;">
            <div>
                <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                    <i class="bi bi-box-seam-fill fs-2" style="color: var(--cyan-accent);"></i> Kelola Produk
                </h2>
                <p class="small mb-0" style="color: var(--text-slate);">Kelola inventaris, harga jual, dan stok barang toko Anda secara terpusat.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button onclick="window.print()" class="btn btn-outline-light rounded-pill px-3 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-printer-fill"></i>
                    <span>Cetak Data</span>
                </button>

                @can('create', App\Models\Produk::class)
                    <a href="{{ route('produk.create') }}" class="btn rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2" style="background-color: var(--cyan-accent); color: var(--bg-dark-navy) !important;">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Tambah Produk</span>
                    </a>
                @endcan
            </div>
        </div>
        <div class="position-absolute end-0 bottom-0 opacity-25 pe-4 pb-2 d-none d-md-block">
            <i class="bi bi-bag-check-fill" style="font-size: 5rem; color: var(--cyan-accent);"></i>
        </div>
    </div>

    {{-- STATISTIK RINGKASAN --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center"
                    style="background: rgba(100, 255, 218, 0.1); color: var(--cyan-accent); width: 48px; height: 48px;">
                        <i class="bi bi-boxes fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block" style="color: var(--text-slate);">Total Produk</span>
                        <h5 class="fw-bold mb-0 text-white">{{ method_exists($products, 'total') ? $products->total() : count($products) }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: rgba(100, 255, 218, 0.1); color: var(--cyan-accent); width: 48px; height: 48px;">
                        <i class="bi bi-stack fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block" style="color: var(--text-slate);">Total Item Stok</span>
                        <h5 class="fw-bold mb-0 text-white">{{ $products->sum('stok') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: rgba(245, 158, 11, 0.15); color: #fbbf24; width: 48px; height: 48px;">
                        <i class="bi bi-exclamation-triangle-fill fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block" style="color: var(--text-slate);">Stok Kritis</span>
                        <h5 class="fw-bold mb-0 text-white">{{ $products->where('stok', '<=', 10)->where('stok', '>', 0)->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: rgba(239, 68, 68, 0.15); color: #f87171; width: 48px; height: 48px;">
                        <i class="bi bi-x-circle-fill fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block" style="color: var(--text-slate);">Stok Habis</span>
                        <h5 class="fw-bold mb-0 text-white">{{ $products->where('stok', 0)->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL PRODUK MAIN CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card">

        {{-- FILTER & SEARCH --}}
        <div class="card-header border-0 pt-4 px-4 pb-0" style="background-color: transparent;">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="row g-2 justify-content-between align-items-center">

                    <div class="col-md-5 col-lg-4">
                        <div class="input-group search-box">
                            <span class="input-group-text border-end-0 rounded-start-pill ps-3 bg-search">
                                <i class="bi bi-search" style="color: var(--cyan-accent);"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-start-0 rounded-end-pill ps-0 bg-search shadow-none"
                                placeholder="Cari nama produk..."
                                id="fastSearchInput"
                            >
                        </div>
                    </div>

                    <div class="col-md-7 col-lg-6 d-flex align-items-center justify-content-md-end gap-2">
                        <select name="stok_status" class="form-select bg-search rounded-pill shadow-none border-0 w-auto" onchange="this.form.submit()">
                            <option value="">Semua Status Stok</option>
                            <option value="ready" {{ request('stok_status') == 'ready' ? 'selected' : '' }}>Stok Tersedia (>10)</option>
                            <option value="kritis" {{ request('stok_status') == 'kritis' ? 'selected' : '' }}>Stok Kritis (1-10)</option>
                            <option value="habis" {{ request('stok_status') == 'habis' ? 'selected' : '' }}>Stok Habis (0)</option>
                        </select>

                        @if(request('search') || request('stok_status'))
                            <a href="{{ route('produk.index') }}" class="btn btn-sm rounded-pill px-3 border-0" style="background-color: var(--bg-light-navy); color: var(--text-slate);">
                                <i class="bi bi-x-circle me-1"></i>Reset
                            </a>
                        @endif
                    </div>

                </div>
            </form>
        </div>

        {{-- TABLE SECTION --}}
        <div class="card-body p-0 mt-3">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 custom-table">
                    <thead class="bg-table-head border-0">
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
                        <tr class="product-row">
                            <td class="ps-4 small fw-medium" style="color: var(--text-slate);">
                                {{ method_exists($products, 'firstItem') ? $products->firstItem() + $loop->index : $loop->iteration }}
                            </td>
                            <td>
                                @if($product->foto)
                                    <img src="{{ asset('storage/'.$product->foto) }}" alt="{{ $product->nama }}" class="product-thumb shadow-sm border" style="border-color: var(--bg-light-navy) !important; width: 44px; height: 44px; object-fit: cover; border-radius: 10px;">
                                @else
                                    <div class="product-thumb-placeholder d-flex align-items-center justify-content-center fw-bold shadow-sm">
                                        <i class="bi bi-image"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="product-name-text d-block">{{ $product->nama }}</span>
                            </td>
                            <td class="small">
                                <span class="badge badge-soft-green px-2 py-1 rounded-pill fw-normal">
                                    <i class="bi bi-person me-1"></i>{{ $product->user->name ?? '-' }}
                                </span>
                            </td>
                            <td class="small fw-medium" style="color: var(--text-slate);">
                                Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                            </td>
                            <td class="fw-bold small" style="color: var(--white);">
                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                            </td>
                            <td>
                                @if($product->stok > 10)
                                    <span class="badge badge-soft-green px-3 py-1 rounded-pill fw-semibold">
                                        {{ $product->stok }} Pcs
                                    </span>
                                @elseif($product->stok > 0)
                                    <span class="badge badge-soft-amber px-3 py-1 rounded-pill fw-semibold">
                                        {{ $product->stok }} Pcs (Kritis)
                                    </span>
                                @else
                                    <span class="badge badge-soft-danger px-3 py-1 rounded-pill fw-semibold">
                                        Habis
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    @can('view', $product)
                                        <a href="{{ route('produk.show', $product) }}" class="btn btn-action-info rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Lihat Detail">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    @endcan

                                    @can('update', $product)
                                        <a href="{{ route('produk.edit', $product) }}" class="btn btn-action-edit rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Edit Produk">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    @endcan

                                    @can('delete', $product)
                                        <button type="button"
                                                class="btn btn-action-delete rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 34px; height: 34px;"
                                                title="Hapus Produk"
                                                onclick="triggerDeleteModal(
                                                    {{ Js::from(route('produk.destroy', $product)) }},
                                                    {{ Js::from($product->nama) }}
                                                )">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5" style="color: var(--text-slate);">
                                <i class="bi bi-box-seam fs-1 d-block mb-2" style="color: var(--cyan-accent);"></i>
                                <span>Tidak ada data produk yang ditemukan.</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        @if(method_exists($products, 'hasPages') && $products->hasPages())
            <div class="card-footer border-0 px-4 py-3 border-top" style="background-color: transparent; border-color: var(--bg-light-navy) !important;">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <span class="small" style="color: var(--text-slate);">
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

{{-- MODAL HAPUS DARK MODE --}}
<div class="modal fade" id="globalDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content modal-content-dark border-0 shadow-lg rounded-4 overflow-hidden text-center p-3">
            <div class="modal-body p-3">
                <div class="rounded-circle bg-danger bg-opacity-10 text-danger mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="bi bi-exclamation-triangle-fill fs-2"></i>
                </div>
                <h5 class="fw-bold mb-1 text-white">Hapus Produk?</h5>
                <p class="small mb-0" style="color: var(--text-slate);">Apakah Anda yakin ingin menghapus produk <strong id="deleteProductNameText" class="text-white"></strong>? Data ini tidak bisa dikembalikan.</p>
            </div>
            <div class="d-flex gap-2 justify-content-center px-3 pb-2">
                <button type="button" class="btn btn-light rounded-pill px-3 fw-semibold w-50" data-bs-dismiss="modal">Batal</button>
                <form id="globalDeleteForm" action="" method="POST" class="w-50">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-3 fw-semibold w-100">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function triggerDeleteModal(deleteUrl, productName) {
        document.getElementById('deleteProductNameText').innerText = `"${productName}"`;
        document.getElementById('globalDeleteForm').action = deleteUrl;

        var myModal = new bootstrap.Modal(document.getElementById('globalDeleteModal'));
        myModal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('fastSearchInput');
        const tableRows = document.querySelectorAll('.custom-table tbody tr.product-row');

        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const keyword = this.value.toLowerCase();

                tableRows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    if (text.includes(keyword)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
    });
</script>

@endsection
