@extends('layouts.app')

@section('title', 'Riwayat Penjualan')

@section('content')

    @include('layouts.navbar')

    <style>
        /* ==========================================================
       1. GLOBAL VARIABLES & TEMA PENJUALAN (ROYAL BLUE THEME)
    ========================================================== */
        :root {
            --bg-body: #f0f5ff;
            /* Latar belakang utama (Biru Soft Segar) */
            --card-bg: #ffffff;
            /* Kartu Utama & Modal (Putih Bersih) */
            --input-bg: #ffffff;
            /* Form Input / Search (Putih) */
            --border-color: #cce0ff;
            /* Border Soft Biru */
            --text-main: #0a1c33;
            /* Teks Utama (Gelap Kontras) */
            --text-muted: #475569;
            /* Teks Sekunder/Sub-label (Abu-abu Tua) */
            --primary-light: rgba(13, 110, 253, 0.08);
            /* Background Header Tabel Soft */
            --primary-color: #0d6efd;
            /* Biru Royal Utama */
            --primary-hover: #0b5ed7;
            /* Biru Royal Hover */
            --danger: #dc3545;
            /* Merah Hapus / Batal */
        }

        body {
            background-color: var(--bg-body) !important;
            color: var(--text-main);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* ==========================================================
       2. BANNER HEADER GRADIENT (RIWAYAT PENJUALAN)
    ========================================================== */
        .banner-gradient {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 60%, #0a58ca 100%) !important;
            color: #ffffff !important;
            border-radius: 16px;
            padding: 2rem 2.25rem;
            box-shadow: 0 10px 30px rgba(13, 110, 253, 0.2);
            border: none !important;
        }

        .banner-gradient h1,
        .banner-gradient h2,
        .banner-gradient h3,
        .banner-gradient h4 {
            color: #ffffff !important;
            font-weight: 800;
        }

        .banner-gradient p,
        .banner-gradient small,
        .banner-gradient span {
            color: rgba(255, 255, 255, 0.92) !important;
            font-weight: 500;
        }

        /* ==========================================================
       3. CARD STATISTIK PENJUALAN & CONTAINER UTAMA
    ========================================================== */
        .custom-card,
        .stat-card {
            background-color: var(--card-bg) !important;
            border: 1px solid var(--border-color) !important;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15) !important;
            border-color: var(--primary-color) !important;
        }

        /* Memaksa Semua Teks di Stat Card Kelihatan Jelas & Tebal */
        .stat-card,
        .stat-card *,
        .stat-card h1,
        .stat-card h2,
        .stat-card h3,
        .stat-card h4,
        .stat-card h5,
        .stat-card h6,
        .stat-card span,
        .stat-card p,
        .stat-card div {
            color: #0a1c33 !important;
            font-weight: 700 !important;
        }

        .stat-card .text-muted,
        .stat-card small,
        .stat-card label {
            color: #475569 !important;
            font-weight: 600 !important;
        }

        .stat-card i,
        .stat-card svg {
            color: var(--primary-color) !important;
        }

        /* ==========================================================
       4. TABEL PENJUALAN (KODE FAKTUR, TOTAL, TANGGAL, DLL)
    ========================================================== */
        .custom-table {
            color: var(--text-main) !important;
            --bs-table-bg: #ffffff !important;
            margin-bottom: 0;
        }

        .bg-table-head {
            background-color: var(--bg-body) !important;
        }

        .table-head-text,
        .custom-table th {
            color: var(--primary-color) !important;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.75rem;
            border-bottom: 1px solid var(--border-color) !important;
        }

        .sale-code-text {
            color: var(--primary-color) !important;
            font-weight: 700;
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

        .custom-table small,
        .custom-table .text-muted {
            color: #475569 !important;
            font-weight: 600 !important;
        }

        /* ==========================================================
       5. SEARCH BAR, FILTER TANGGAL & INPUT
    ========================================================== */
        .bg-search,
        .form-select,
        .form-control {
            background-color: var(--input-bg) !important;
            border-color: var(--border-color) !important;
            color: var(--text-main) !important;
            font-weight: 600 !important;
            border-radius: 10px;
        }

        .bg-search::placeholder,
        .form-control::placeholder {
            color: #64748b !important;
            opacity: 1 !important;
        }

        .search-box:focus-within .bg-search,
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
        }

        /* ==========================================================
       6. BUTTONS AKSI (DETAIL / CETAK STRUK, EDIT, HAPUS, FAKTUR)
    ========================================================== */
        /* Tombol Utama (Tambah Transaksi / Kasir) */
        .btn-primary-custom,
        .btn-primary {
            background: var(--primary-color) !important;
            color: #ffffff !important;
            font-weight: 700;
            border: none !important;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
            transition: all 0.2s ease;
            border-radius: 10px;
        }

        .btn-primary-custom:hover,
        .btn-primary:hover {
            background: var(--primary-hover) !important;
            color: #ffffff !important;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4);
        }

        /* Tombol Detail / Struk (Biru Soft) */
        .btn-action-info {
            background-color: rgba(13, 110, 253, 0.1) !important;
            color: var(--primary-color) !important;
            border: 1px solid rgba(13, 110, 253, 0.25) !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-action-info:hover {
            background-color: var(--primary-color) !important;
            color: #ffffff !important;
            transform: scale(1.05);
        }

        /* Tombol Edit / Penyesuaian (Kuning/Orange Soft) */
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

        /* Tombol Hapus / Batal Transaksi (Merah Soft) */
        .btn-action-delete {
            background-color: rgba(220, 53, 69, 0.1) !important;
            color: var(--danger) !important;
            border: 1px solid rgba(220, 53, 69, 0.25) !important;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-action-delete:hover {
            background-color: var(--danger) !important;
            color: #ffffff !important;
            transform: scale(1.05);
        }

        /* ==========================================================
       7. MODE PRINT / CETAK FAKTUR
    ========================================================== */
        @media print {

            .no-print,
            nav,
            .navbar,
            .sidebar-custom {
                display: none !important;
            }

            body {
                background: #ffffff !important;
                color: #000000 !important;
            }

            .custom-card,
            .stat-card {
                background: #ffffff !important;
                border: 1px solid #000000 !important;
                color: #000000 !important;
                box-shadow: none !important;
            }
        }
    </style>

    <div class="container py-4">

        {{-- ALERT ERRORS --}}
        @if (session('errors'))
            <div
                class="alert alert-danger rounded-3 shadow-sm mb-4 border-0 border-start border-4 border-danger bg-danger text-white">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                    <div>{{ session('errors') }}</div>
                </div>
            </div>
        @endif

        {{-- HEADER BANNER GRADIENT --}}
        <div class="banner-gradient p-4 p-md-5 mb-4 position-relative overflow-hidden shadow-sm">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative"
                style="z-index: 1;">
                <div>
                    <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                        <i class="bi bi-receipt-cutoff fs-2 text-info"></i> Riwayat Penjualan
                    </h2>
                    <p class="text-white opacity-75 small mb-0">Pantau transaksi penjualan, metode pembayaran, dan laporan
                        kasir secara real-time.</p>
                </div>
                <div class="d-flex flex-wrap gap-2 no-print">
                    {{-- TOMBOL CETAK REKAP --}}
                    <button onclick="window.print()"
                        class="btn btn-outline-light rounded-pill px-3 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-printer-fill"></i>
                        <span>Cetak Laporan</span>
                    </button>

                    <a href="{{ route('penjualan.create') }}"
                        class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="bi bi-cart-plus-fill"></i>
                        <span>Transaksi Baru</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- STATISTIK RINGKASAN TRANSAKSI --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card stat-card p-3 shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-primary-subtle text-primary"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-receipt fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Total Transaksi</span>
                            <h5 class="fw-bold mb-0 text-dark">
                                {{ method_exists($sales, 'total') ? $sales->total() : count($sales) }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card p-3 shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-success-subtle text-success"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-wallet2 fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Omset Terlihat</span>
                            <h5 class="fw-bold mb-0 text-dark">Rp
                                {{ number_format($sales->sum('total_pembayaran'), 0, ',', '.') }}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card p-3 shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-info-subtle text-info"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-qr-code-scan fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Digital (QRIS/Trf)</span>
                            <h5 class="fw-bold mb-0 text-dark">
                                {{ $sales->whereIn('metode_pembayaran', ['qris', 'transfer', 'QRIS', 'TRANSFER'])->count() }}
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card stat-card p-3 shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-3 d-flex align-items-center justify-content-center bg-warning-subtle text-warning"
                            style="width: 48px; height: 48px;">
                            <i class="bi bi-cash-stack fs-4"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Pembayaran Tunai</span>
                            <h5 class="fw-bold mb-0 text-dark">
                                {{ $sales->whereIn('metode_pembayaran', ['tunai', 'cash', 'TUNAI', 'CASH'])->count() }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- MAIN CARD --}}
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card">

            {{-- CARD HEADER / FILTER & SEARCH --}}
            <div class="card-header border-0 pt-4 px-4 pb-0 bg-white">
                <form action="{{ route('penjualan.index') }}" method="GET">
                    <div class="row g-2 justify-content-between align-items-center">

                        {{-- SEARCH BAR --}}
                        <div class="col-md-5 col-lg-4">
                            <div class="input-group search-box">
                                <span class="input-group-text border-end-0 rounded-start-pill ps-3 bg-search">
                                    <i class="bi bi-search text-primary"></i>
                                </span>
                                <input type="text" name="search" value="{{ request()->search }}"
                                    class="form-control border-start-0 rounded-end-pill ps-0 bg-search shadow-none"
                                    placeholder="Cari kode / kasir...">
                            </div>
                        </div>

                        {{-- FILTER METODE & RESET --}}
                        <div class="col-md-7 col-lg-6 d-flex align-items-center justify-content-md-end gap-2">
                            <select name="metode" class="form-select bg-search rounded-pill shadow-none w-auto"
                                onchange="this.form.submit()">
                                <option value="">Semua Metode</option>
                                <option value="tunai" {{ request('metode') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                <option value="qris" {{ request('metode') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                <option value="transfer" {{ request('metode') == 'transfer' ? 'selected' : '' }}>Transfer
                                </option>
                            </select>

                            @if (request('search') || request('metode'))
                                <a href="{{ route('penjualan.index') }}"
                                    class="btn btn-sm btn-light border rounded-pill px-3">
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
                                    <td class="ps-4 text-muted small fw-medium">
                                        {{ method_exists($sales, 'firstItem') ? $sales->firstItem() + $loop->index : $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="bi bi-clock-history text-primary"></i>
                                            <span
                                                class="sale-code-text">{{ $sale->created_at ? $sale->created_at->translatedFormat('d M Y, H:i') : '-' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill fw-medium">
                                            <i class="bi bi-person-fill me-1"></i>{{ $sale->user->name ?? 'Sistem/Kasir' }}
                                        </span>
                                    </td>
                                    <td class="fw-bold text-dark">
                                        Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        @php $metode = strtolower($sale->metode_pembayaran); @endphp
                                        @if (in_array($metode, ['qris', 'transfer']))
                                            <span
                                                class="badge bg-info-subtle text-info border border-info-subtle px-3 py-1 rounded-pill fw-semibold">
                                                <i
                                                    class="bi bi-qr-code-scan me-1"></i>{{ strtoupper($sale->metode_pembayaran) }}
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                                                <i
                                                    class="bi bi-cash-stack me-1"></i>{{ ucfirst($sale->metode_pembayaran) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @php $status = strtolower($sale->status ?? 'selesai'); @endphp
                                        @if (in_array($status, ['selesai', 'success', 'lunas', 'open']))
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                                                <i class="bi bi-check-circle-fill me-1"></i>{{ ucfirst($status) }}
                                            </span>
                                        @elseif(in_array($status, ['pending', 'proses']))
                                            <span
                                                class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-1 rounded-pill fw-semibold">
                                                <i class="bi bi-clock-history me-1"></i>{{ ucfirst($status) }}
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-1 rounded-pill fw-semibold">
                                                <i class="bi bi-x-circle-fill me-1"></i>{{ ucfirst($status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="pe-4 text-end">
                                        <div class="d-flex justify-content-end gap-2">
                                            {{-- DETAIL / STRUK --}}
                                            <a href="{{ route('penjualan.show', $sale) }}"
                                                class="btn btn-action-info rounded-circle d-inline-flex align-items-center justify-content-center"
                                                style="width: 34px; height: 34px;" title="Lihat Struk / Detail">
                                                <i class="bi bi-receipt"></i>
                                            </a>

                                            {{-- EDIT --}}
                                            @can('update', $sale)
                                                <a href="{{ route('penjualan.edit', $sale) }}"
                                                    class="btn btn-action-edit rounded-circle d-inline-flex align-items-center justify-content-center"
                                                    style="width: 34px; height: 34px;" title="Edit Transaksi">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                            @endcan

                                            {{-- DELETE --}}
                                            @can('delete', $sale)
                                                <form action="{{ route('penjualan.destroy', $sale) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-action-delete rounded-circle d-inline-flex align-items-center justify-content-center"
                                                        style="width: 34px; height: 34px;" title="Hapus Transaksi"
                                                        onclick="return confirm('Apakah anda yakin akan menghapus penjualan ini?')">
                                                        <i class="bi bi-trash-fill"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-receipt fs-1 d-block mb-2 text-muted"></i>
                                        <span>Tidak ada data penjualan yang ditemukan.</span>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- PAGINATION FOOTER --}}
            @if (method_exists($sales, 'hasPages') && $sales->hasPages())
                <div class="card-footer border-0 px-4 py-3 border-top bg-white">
                    <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                        <span class="small text-muted">
                            Menampilkan {{ $sales->firstItem() }} - {{ $sales->lastItem() }} dari {{ $sales->total() }}
                            transaksi
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
