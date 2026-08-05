@extends('layouts.app')

@section('title', 'Detail Penjualan #' . $penjualan->id)

@section('content')

<style>
/* ==========================================================
   1. GLOBAL VARIABLES & CORE THEME (ROYAL BLUE MODERN)
========================================================== */
:root {
    --bg-body: #0b132b;
    --card-bg: #ffffff;
    --input-bg: #f8fafc;
    --border-color: #cbd5e1;
    --border-dashed: #93c5fd;
    --text-main: #000000;
    --text-muted: #475569;
    --accent-blue: #0d6efd;
    --accent-blue-hover: #0b5ed7;
    --accent-blue-bg: #eff6ff;
    --shadow-soft: 0 10px 25px rgba(0, 0, 0, 0.25);
}

body {
    background-color: var(--bg-body) !important;
    color: var(--text-main);
    font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
}

/* ==========================================================
   2. KARTU & PANEL UTAMA (POS CARD)
========================================================== */
.pos-card-white,
.receipt-card {
    background-color: var(--card-bg) !important;
    border: 1px solid var(--border-color) !important;
    border-radius: 16px !important;
    box-shadow: var(--shadow-soft) !important;
    overflow: hidden;
}

/* Memaksa Teks di Dalam Kartu Putih Berwarna Hitam Pelek */
.pos-card-white,
.pos-card-white *,
.pos-card-white h1, .pos-card-white h2, .pos-card-white h3, 
.pos-card-white h4, .pos-card-white h5, .pos-card-white h6,
.pos-card-white p, .pos-card-white span, .pos-card-white td, 
.pos-card-white th, .pos-card-white label, .pos-card-white div {
    color: var(--text-main) !important;
}

/* ==========================================================
   3. BANNER HEADER & TOP ACTION BAR (ROYAL BLUE GRADIENT)
========================================================== */
.banner-dark-gradient,
.receipt-header-banner {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 60%, #1e40af 100%) !important;
    border: 1px solid #3b82f6 !important;
    color: #ffffff !important;
    padding: 1.75rem 2.25rem;
}

.banner-dark-gradient *,
.receipt-header-banner * {
    color: #ffffff !important;
}

.top-action-bar {
    background: #ffffff !important;
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 1rem 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* ==========================================================
   4. TOMBOL-TOMBOL UTAMA (ROYAL BLUE ACCENT)
========================================================== */
.btn-cyan,
.btn-print-custom {
    background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
    color: #ffffff !important;
    font-weight: 700 !important;
    border: none !important;
    border-radius: 10px;
    padding: 0.65rem 1.5rem;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    transition: all 0.2s ease;
}

.btn-cyan:hover,
.btn-print-custom:hover {
    background-color: var(--accent-blue-hover) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4);
    color: #ffffff !important;
}

.btn-back-soft {
    background-color: rgba(13, 110, 253, 0.1) !important;
    color: var(--accent-blue) !important;
    border: 1px solid rgba(13, 110, 253, 0.2) !important;
    font-weight: 700;
    padding: 0.6rem 1.25rem;
    border-radius: 10px;
    transition: all 0.2s ease;
}

.btn-back-soft:hover {
    background-color: var(--accent-blue) !important;
    color: #ffffff !important;
}

/* ==========================================================
   5. INPUT, SEARCH BOX & SELEKSI PRODUK
========================================================== */
.input-pos-light {
    background-color: var(--input-bg) !important;
    border: 1px solid #94a3b8 !important;
    color: #000000 !important;
    font-weight: 600 !important;
}

.input-pos-light:focus {
    border-color: var(--accent-blue) !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.2) !important;
}

.product-select-btn {
    background-color: #f1f5f9 !important;
    border: 1px solid var(--border-color) !important;
    transition: all 0.2s ease;
}

.product-select-btn:hover {
    border-color: var(--accent-blue) !important;
    background-color: var(--accent-blue-bg) !important;
}

/* ==========================================================
   6. TABEL INVOICE / RIWAYAT PENJUALAN
========================================================== */
.table-invoice-wrapper {
    border: 1px solid var(--border-color);
    border-radius: 14px;
    overflow: hidden;
    background-color: #ffffff;
}

.table-invoice thead {
    background-color: rgba(13, 110, 253, 0.08);
}

.table-invoice th {
    color: var(--accent-blue) !important;
    font-weight: 800;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.8px;
    border-bottom: 1px solid var(--border-color) !important;
    padding: 1rem 1.25rem;
}

.table-invoice td {
    border-bottom: 1px solid #f1f5f9 !important;
    color: var(--text-main) !important;
    font-weight: 600;
    padding: 1.1rem 1.25rem;
}

.item-qty-badge {
    background-color: rgba(13, 110, 253, 0.1) !important;
    color: var(--accent-blue) !important;
    font-weight: 800;
    font-size: 0.85rem;
    padding: 0.35rem 0.75rem;
    border-radius: 8px;
}

/* ==========================================================
   7. TOTAL BAYAR & RINGKASAN PEMBAYARAN
========================================================== */
.total-receipt-box-light,
.grand-total-box {
    background: var(--accent-blue-bg) !important;
    border: 2px dashed #60a5fa !important;
    border-radius: 14px;
    padding: 1.25rem;
}

.grand-total-label,
.pos-card-white .text-price {
    color: var(--accent-blue) !important;
    font-weight: 800 !important;
}

.grand-total-amount {
    color: #1e40af !important;
    font-weight: 900;
    font-size: 1.75rem;
    margin: 0;
}

/* ==========================================================
   8. MODE CETAK / PRINT (THERMAL & KERTAS)
========================================================== */
@media print {
    .no-print, nav, .navbar, .sidebar-custom, .top-action-bar {
        display: none !important;
    }
    body {
        background: #ffffff !important;
        color: #000000 !important;
    }
    .receipt-card {
        border: none !important;
        box-shadow: none !important;
    }
    .receipt-header-banner {
        background: none !important;
        color: #000000 !important;
        border-bottom: 2px solid #000000 !important;
    }
    .receipt-header-banner *, 
    .info-meta-label, .info-meta-value,
    .table-invoice th, .table-invoice td,
    .grand-total-label, .grand-total-amount {
        color: #000000 !important;
    }
}
</style>

<div class="container-fluid px-3 px-md-4 py-3">
    
    {{-- Top Action Navigation --}}
    <div class="top-action-bar d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4 no-print">
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('penjualan.index') }}" class="btn-back-soft">
                <i class="bi bi-arrow-left me-2"></i> Kembali ke Daftar
            </a>
            <div>
                <h5 class="fw-extrabold mb-0" style="color: var(--text-main);">Detail Penjualan</h5>
                <small class="text-muted fw-semibold">Rincian Lengkap Transaksi Pelanggan</small>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn-print-custom">
                <i class="bi bi-printer-fill me-2"></i> Cetak Struk / Invoice
            </button>
        </div>
    </div>

    {{-- Main Printable Receipt Card --}}
    <div class="receipt-card">
        
        {{-- Banner Header --}}
        <div class="receipt-header-banner d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <i class="bi bi-bag-check-fill fs-3"></i>
                    <h2>KUDE POS</h2>
                </div>
                <p class="small fw-medium">Sistem Kasir & Manajemen Penjualan Modern</p>
            </div>
            <div class="text-md-end">
                <div class="status-badge-paid mb-2">
                    <i class="bi bi-patch-check-fill me-1.5"></i> TRANSAKSI LUNAS
                </div>
                <p class="small fw-medium">
                    Waktu: {{ \Carbon\Carbon::parse($penjualan->created_at)->format('d M Y, H:i') }} WIB
                </p>
            </div>
        </div>

        <div class="p-4 p-md-5">
            
            {{-- Info Meta Boxes --}}
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-md-3">
                    <div class="info-meta-card">
                        <span class="info-meta-label">Kode Transaksi</span>
                        <p class="info-meta-value text-primary">#TRX-{{ str_pad($penjualan->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="info-meta-card">
                        <span class="info-meta-label">Kasir Bertugas</span>
                        <p class="info-meta-value">{{ $penjualan->user->name ?? 'Kasir Utama' }}</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="info-meta-card">
                        <span class="info-meta-label">Metode Pembayaran</span>
                        <p class="info-meta-value text-success">
                            <i class="bi bi-cash-stack me-1"></i> Tunai / Cash
                        </p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="info-meta-card">
                        <span class="info-meta-label">Total Item</span>
                        <p class="info-meta-value">
                            {{ optional($penjualan->itemPenjualan ?? $penjualan->detailPenjualan)->sum('jumlah') ?? 0 }} Barang
                        </p>
                    </div>
                </div>
            </div>

            {{-- Table List Products --}}
            <div class="table-invoice-wrapper mb-4">
                <div class="table-responsive">
                    <table class="table table-invoice align-middle">
                        <thead>
                            <tr>
                                <th style="width: 50px;" class="text-center">No</th>
                                <th>Nama Produk</th>
                                <th class="text-end" style="width: 180px;">Harga Satuan</th>
                                <th class="text-center" style="width: 120px;">Jumlah</th>
                                <th class="text-end" style="width: 200px;">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penjualan->itemPenjualan ?? $penjualan->detailPenjualan ?? [] as $index => $detail)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $index + 1 }}</td>
                                <td>
                                    <span class="fw-bold d-block text-dark">
                                        {{ $detail->produk->nama_produk ?? 'Item Dihapus' }}
                                    </span>
                                    @if(isset($detail->produk->kode_produk))
                                        <small class="text-muted">SKU: {{ $detail->produk->kode_produk }}</small>
                                    @endif
                                </td>
                                <td class="text-end">
                                    Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="item-qty-badge">
                                        {{ $detail->jumlah }}
                                    </span>
                                </td>
                                <td class="text-end fw-extrabold text-dark">
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted fw-semibold">
                                    <i class="bi bi-inbox fs-2 d-block mb-2 text-secondary"></i>
                                    Tidak ada rincian produk dalam transaksi ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Payment Summary Section --}}
            <div class="row justify-content-end">
                <div class="col-md-6 col-lg-5">
                    <div class="payment-summary-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted fw-bold">Subtotal Produk</span>
                            <span class="fw-bold text-dark">
                                Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted fw-bold">Pajak / Diskon</span>
                            <span class="fw-bold text-muted">Rp 0</span>
                        </div>
                        
                        {{-- Grand Total Box --}}
                        <div class="grand-total-box d-flex justify-content-between align-items-center">
                            <div>
                                <span class="grand-total-label d-block">Total Pembayaran</span>
                                <small class="text-success fw-semibold">Status: Lunas</small>
                            </div>
                            <h3 class="grand-total-amount">
                                Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Notes --}}
            <div class="receipt-footer-notes">
                <p class="fw-bold mb-1" style="color: var(--text-main);">~ Terima kasih telah berbelanja di KUDE POS ~</p>
                <p class="text-muted small mb-0">Struk ini sah sebagai bukti pembayaran yang dikeluarkankan oleh sistem resmi.</p>
            </div>

        </div>
    </div>
</div>

@endsection