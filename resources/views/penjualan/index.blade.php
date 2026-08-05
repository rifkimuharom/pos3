@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')

@include('layouts.navbar')

<style>
    /* VARIABLES & TEMA DARK NAVY */
    :root {
        --dark-card-bg: #0f223d;
        --dark-input-bg: #0b1727;
        --dark-border: #1e3a5f;
        --text-label: #cbd5e1;
        --text-main: #ffffff;
        --accent-green: #10b981;
    }

    body {
        background-color: var(--dark-input-bg) !important;
        color: var(--text-main);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    }

    /* BANNER HEADER NAVY GRADIENT */
    .banner-navy-gradient {
        background: linear-gradient(
            135deg,
            #0b1727 0%,
            #0f223d 55%,
            #1e3a5f 100%
        ) !important;
        color: #ffffff !important;
        border: 1px solid var(--dark-border);
    }

    /* CARD STATISTIK & TAMPILAN UTAMA */
    .custom-card {
        background-color: var(--dark-card-bg) !important;
        border: 1px solid var(--dark-border) !important;
    }

    .stat-card {
        background-color: var(--dark-card-bg) !important;
        border-radius: 16px;
        border: 1px solid var(--dark-border) !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2) !important;
    }

    /* TABLE STYLING DARK NAVY */
    .custom-table {
        color: var(--text-main) !important;
    }

    .bg-table-head {
        background-color: var(--dark-input-bg) !important;
    }

    .table-head-text {
        color: #94a3b8 !important;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .sale-code-text {
        color: var(--text-main) !important;
        font-weight: 600;
        transition: color 0.15s ease;
    }

    .custom-table tbody tr {
        border-bottom: 1px solid var(--dark-border) !important;
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #132a4b !important;
    }

    /* SEARCH BAR & SELECT */
    .bg-search {
        background-color: var(--dark-input-bg) !important;
        border-color: var(--dark-border) !important;
        color: var(--text-main) !important;
        transition: all 0.2s ease;
    }

    .bg-search::placeholder {
        color: #64748b !important;
    }

    .search-box:focus-within .bg-search {
        border-color: #38bdf8 !important;
    }

    select.bg-search option {
        background-color: var(--dark-input-bg) !important;
        color: var(--text-main) !important;
    }

    /* BADGES DARK STYLING */
    .badge-soft-green {
        background-color: #064e3b !important;
        color: #34d399 !important;
        border: 1px solid #059669 !important;
    }

    .badge-soft-emerald {
        background-color: #064e3b !important;
        color: #34d399 !important;
        border: 1px solid #059669 !important;
    }

    .badge-soft-amber {
        background-color: #78350f !important;
        color: #fcd34d !important;
        border: 1px solid #d97706 !important;
    }

    .badge-soft-rose {
        background-color: #881337 !important;
        color: #fca5a5 !important;
        border: 1px solid #e11d48 !important;
    }

    .badge-soft-sky {
        background-color: #0c4a6e !important;
        color: #38bdf8 !important;
        border: 1px solid #0284c7 !important;
    }

    /* BUTTONS AKSI */
    .btn-gradient-green {
        background: linear-gradient(135deg, #059669 0%, #10b981 100%) !important;
        border: none !important;
        color: white !important;
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }

    .btn-gradient-green:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.35);
        color: white !important;
    }

    .btn-action-info {
        background-color: #0c4a6e !important;
        color: #38bdf8 !important;
        border: none !important;
        transition: all 0.2s ease;
    }
    .btn-action-info:hover {
        background-color: #0284c7 !important;
        color: #ffffff !important;
        transform: scale(1.08);
    }

    .btn-action-edit {
        background-color: #78350f !important;
        color: #fcd34d !important;
        border: none !important;
        transition: all 0.2s ease;
    }
    .btn-action-edit:hover {
        background-color: #d97706 !important;
        color: #ffffff !important;
        transform: scale(1.08);
    }

    .btn-action-delete {
        background-color: #881337 !important;
        color: #fca5a5 !important;
        border: none !important;
        transition: all 0.2s ease;
    }
    .btn-action-delete:hover {
        background-color: #e11d48 !important;
        color: #ffffff !important;
        transform: scale(1.08);
    }

    /* MODE PRINT */
    @media print {
        .no-print, nav, .navbar {
            display: none !important;
        }
        body {
            background: #ffffff !important;
            color: #000000 !important;
        }
        .custom-card, .stat-card {
            background: #ffffff !important;
            border: 1px solid #000 !important;
            color: #000000 !important;
        }
        .banner-navy-gradient {
            background: none !important;
            color: #000000 !important;
            padding: 0 !important;
            border-bottom: 2px solid #000;
        }
        .custom-table {
            color: #000000 !important;
        }
    }

</style>

<div class="container py-4">

    {{-- ALERT ERRORS --}}
    @if(session('errors'))
        <div class="alert alert-danger rounded-3 shadow-sm mb-4 border-0 border-start border-4 border-danger bg-danger text-white">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <div>{{ session('errors') }}</div>
            </div>
        </div>
    @endif

    {{-- HEADER BANNER GRADIENT --}}
    <div class="banner-navy-gradient p-4 p-md-5 rounded-4 mb-4 position-relative overflow-hidden shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative" style="z-index: 1;">
            <div>
                <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                    <i class="bi bi-receipt-cutoff fs-2 text-info"></i> Riwayat Penjualan
                </h2>
                <p class="text-white opacity-75 small mb-0">Pantau transaksi penjualan, metode pembayaran, dan laporan kasir secara real-time.</p>
            </div>
            <div class="d-flex flex-wrap gap-2 no-print">
                {{-- TOMBOL CETAK REKAP --}}
                <button onclick="window.print()" class="btn btn-outline-light rounded-pill px-3 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-printer-fill"></i>
                    <span>Cetak Laporan</span>
                </button>

                <a href="{{ route('penjualan.create') }}" class="btn btn-gradient-green rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-cart-plus-fill"></i>
                    <span>Transaksi Baru</span>
                </a>
            </div>
        </div>
        {{-- Decorative Icon Background --}}
        <div class="position-absolute end-0 bottom-0 opacity-25 pe-4 pb-2 d-none d-md-block">
            <i class="bi bi-currency-dollar text-white" style="font-size: 5rem;"></i>
        </div>
    </div>

    {{-- STATISTIK RINGKASAN TRANSAKSI --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center"
                        style="background: #064e3b; color: #34d399; width: 48px; height: 48px;">
                        <i class="bi bi-receipt fs-4"></i>
                    </div>
                    <div>
                        <span class="text-label small d-block">Total Transaksi</span>
                        <h5 class="fw-bold mb-0 text-white">{{ method_exists($sales, 'total') ? $sales->total() : count($sales) }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: #064e3b; color: #10b981; width: 48px; height: 48px;">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                    <div>
                        <span class="text-label small d-block">Omset Terlihat</span>
                        <h5 class="fw-bold mb-0 text-white">Rp {{ number_format($sales->sum('total_pembayaran'), 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: #0c4a6e; color: #38bdf8; width: 48px; height: 48px;">
                        <i class="bi bi-qr-code-scan fs-4"></i>
                    </div>
                    <div>
                        <span class="text-label small d-block">Digital (QRIS/Trf)</span>
                        <h5 class="fw-bold mb-0 text-white">{{ $sales->whereIn('metode_pembayaran', ['qris', 'transfer', 'QRIS', 'TRANSFER'])->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: #78350f; color: #fcd34d; width: 48px; height: 48px;">
                        <i class="bi bi-cash-stack fs-4"></i>
                    </div>
                    <div>
                        <span class="text-label small d-block">Pembayaran Tunai</span>
                        <h5 class="fw-bold mb-0 text-white">{{ $sales->whereIn('metode_pembayaran', ['tunai', 'cash', 'TUNAI', 'CASH'])->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card">

        {{-- CARD HEADER / FILTER & SEARCH --}}
        <div class="card-header border-0 pt-4 px-4 pb-0" style="background-color: var(--dark-card-bg);">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="row g-2 justify-content-between align-items-center">

                    {{-- SEARCH BAR --}}
                    <div class="col-md-5 col-lg-4">
                        <div class="input-group search-box">
                            <span class="input-group-text border-end-0 rounded-start-pill ps-3 bg-search">
                                <i class="bi bi-search" style="color: var(--accent-green);"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                value="{{ request()->search }}"
                                class="form-control border-start-0 rounded-end-pill ps-0 bg-search shadow-none"
                                placeholder="Cari kode / kasir..."
                            >
                        </div>
                    </div>

                    {{-- FILTER METODE & RESET --}}
                    <div class="col-md-7 col-lg-6 d-flex align-items-center justify-content-md-end gap-2">
                        <select name="metode" class="form-select bg-search rounded-pill shadow-none w-auto" onchange="this.form.submit()">
                            <option value="">Semua Metode</option>
                            <option value="tunai" {{ request('metode') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                            <option value="qris" {{ request('metode') == 'qris' ? 'selected' : '' }}>QRIS</option>
                            <option value="transfer" {{ request('metode') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>

                        @if(request('search') || request('metode'))
                            <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-soft-secondary rounded-pill px-3 border-0" style="background-color: #1e293b; color: #cbd5e1;">
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
                <table class="table align-middle mb-0 custom-table">
                    <thead class="bg-table-head">
                        <tr class="table-head-text small">
                            <th class="ps-4" style="width: 5%;">NO</th>
                            <th>TANGGAL & WAKTU</th>
                            <th>KASIR</th>
                            <th>TOTAL PEMBAYARAN</th>
                            <th>METODE</th>
                            <th>STATUS</th>
                            <th class="pe-4 text-end" style="width: 15%;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($sales as $sale)
                        <tr class="sale-row">
                            <td class="ps-4 text-label small fw-medium">
                                {{ method_exists($sales, 'firstItem') ? $sales->firstItem() + $loop->index : $loop->iteration }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-clock-history text-info"></i>
                                    <span class="sale-code-text">{{ $sale->created_at ? $sale->created_at->translatedFormat('d M Y, H:i') : '-' }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-soft-green px-2.5 py-1 rounded-pill fw-medium">
                                    <i class="bi bi-person-fill me-1"></i>{{ $sale->user->name ?? 'Sistem/Kasir' }}
                                </span>
                            </td>
                            <td class="fw-bold text-white">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </td>
                            <td>
                                @php $metode = strtolower($sale->metode_pembayaran); @endphp
                                @if(in_array($metode, ['qris', 'transfer']))
                                    <span class="badge badge-soft-sky px-3 py-1 rounded-pill fw-semibold">
                                        <i class="bi bi-qr-code-scan me-1"></i>{{ strtoupper($sale->metode_pembayaran) }}
                                    </span>
                                @else
                                    <span class="badge badge-soft-green px-3 py-1 rounded-pill fw-semibold">
                                        <i class="bi bi-cash-stack me-1"></i>{{ ucfirst($sale->metode_pembayaran) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                @php $status = strtolower($sale->status ?? 'selesai'); @endphp
                                @if(in_array($status, ['selesai', 'success', 'lunas']))
                                    <span class="badge badge-soft-emerald px-3 py-1 rounded-pill fw-semibold">
                                        <i class="bi bi-check-circle-fill me-1"></i>{{ ucfirst($status) }}
                                    </span>
                                @elseif(in_array($status, ['pending', 'proses']))
                                    <span class="badge badge-soft-amber px-3 py-1 rounded-pill fw-semibold">
                                        <i class="bi bi-clock-history me-1"></i>{{ ucfirst($status) }}
                                    </span>
                                @else
                                    <span class="badge badge-soft-rose px-3 py-1 rounded-pill fw-semibold">
                                        <i class="bi bi-x-circle-fill me-1"></i>{{ ucfirst($status) }}
                                    </span>
                                @endif
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    {{-- DETAIL / STRUK --}}
                                    <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-action-info rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Lihat Struk / Detail">
                                        <i class="bi bi-receipt"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    @can('update', $sale)
                                        <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-action-edit rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Edit Transaksi">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                    @endcan

                                    {{-- DELETE --}}
                                    @can('delete', $sale)
                                        <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-action-delete rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Hapus Transaksi" onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-label">
                                <i class="bi bi-receipt fs-1 d-block mb-2 style="color: #64748b;"></i>
                                <span>Tidak ada data penjualan yang ditemukan.</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION FOOTER --}}
        @if(method_exists($sales, 'hasPages') && $sales->hasPages())
            <div class="card-footer border-0 px-4 py-3 border-top" style="background-color: var(--dark-card-bg); border-color: var(--dark-border) !important;">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <span class="small text-label">
                        Menampilkan {{ $sales->firstItem() }} - {{ $sales->lastItem() }} dari {{ $sales->total() }} transaksi
                    </span>
                    <div>
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>

</div>

@endsection
