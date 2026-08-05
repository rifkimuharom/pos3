@extends('layouts.app')

@section('title', 'Detail Produk - ' . $produk->nama)

@section('content')

@include('layouts.navbar')

<style>
    /* TEMA DARK NAVY UNTUK DETAIL PRODUK */
    :root {
        --dark-card-bg: #0f223d;
        --dark-input-bg: #0b1727;
        --dark-border: #1e3a5f;
        --text-label: #cbd5e1;
        --text-main: #ffffff;
        --accent-green: #10b981;
    }

    /* BANNER HEADER */
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

    /* CARD Utama */
    .product-card {
        background-color: var(--dark-card-bg) !important;
        border-radius: 16px;
        border: 1px solid var(--dark-border) !important;
        overflow: hidden;
    }

    /* WAPPER FOTO PRODUK */
    .product-img-wrapper {
        background-color: var(--dark-input-bg);
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 250px;
        border: 1px solid var(--dark-border);
    }

    .product-img {
        max-height: 220px;
        width: auto;
        object-fit: contain;
        transition: transform 0.3s ease;
    }

    .product-img:hover {
        transform: scale(1.05);
    }

    /* QR CODE BOX */
    .qr-card-wrapper {
        background-color: var(--dark-input-bg);
        border-radius: 12px;
        padding: 16px;
        border: 2px dashed var(--dark-border);
        text-align: center;
    }

    /* LABELS & VALUES */
    .info-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-value {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--text-main);
    }

    /* PRICE BOXES */
    .price-box {
        background-color: var(--dark-input-bg);
        border-radius: 12px;
        padding: 16px;
        border: 1px solid var(--dark-border);
    }

    .price-box-sell {
        background-color: #064e3b !important;
        border-color: #059669 !important;
    }

    /* BUTTONS */
    .btn-gradient-green {
        background: linear-gradient(
            135deg,
            #059669 0%,
            #10b981 100%
        ) !important;
        border: none !important;
        color: white !important;
        padding: 0.6rem 1.5rem;
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

    a.btn-soft-secondary {
        background-color: #1e293b !important;
        color: #cbd5e1 !important;
        border: 1px solid var(--dark-border) !important;
        padding: 0.6rem 1.5rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    a.btn-soft-secondary:hover {
        background-color: #334155 !important;
        color: #ffffff !important;
    }

    /* CSS Khusus Mode Cetak / Print Label */
    @media print {
        .no-print, nav, .navbar {
            display: none !important;
        }
        body {
            background: #ffffff !important;
            color: #000000 !important;
        }
        .product-card {
            background: #ffffff !important;
            border: none !important;
            box-shadow: none !important;
        }
        .banner-navy-gradient {
            background: none !important;
            color: #000000 !important;
            padding: 0 !important;
            border-bottom: 2px solid #000;
            border-radius: 0 !important;
        }
        .banner-navy-gradient * {
            color: #000000 !important;
        }
        .info-label, .info-value, h2 {
            color: #000000 !important;
        }
        .price-box {
            background: #f8fafc !important;
            border: 1px solid #000 !important;
        }
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-navy-gradient p-4 rounded-4 mb-4 shadow-sm">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                    <i class="bi bi-box-seam-fill fs-2 text-info"></i> Detail Produk
                </h2>
                <p class="text-white opacity-75 small mb-0">Informasi lengkap spesifikasi, harga, stok, dan Barcode/QR produk.</p>
            </div>
            <div class="d-flex align-items-center gap-2 no-print">
                <button onclick="window.print()" class="btn btn-light rounded-pill px-3 fw-semibold text-dark shadow-sm d-flex align-items-center gap-1">
                    <i class="bi bi-printer-fill"></i> Cetak Label
                </button>
                <a href="{{ route('produk.index') }}" class="btn btn-outline-light rounded-pill px-4 fw-semibold shadow-sm d-flex align-items-center gap-1">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm product-card mb-4">
        <div class="card-body p-4 p-md-5">
            <div class="row g-4 align-items-start">

                {{-- FOTO PRODUK & QR CODE --}}
                <div class="col-md-5 col-lg-4">
                    {{-- FOTO PRODUK --}}
                    <div class="product-img-wrapper mb-3">
                        @if(!empty($produk->foto))
                            <img src="{{ asset('storage/' . $produk->foto) }}"
                                 alt="{{ $produk->nama }}"
                                 class="img-fluid product-img">
                        @else
                            <div class="text-center text-muted">
                                <i class="bi bi-image fs-1 d-block mb-2 style="color: #64748b;"></i>
                                <span style="color: #94a3b8;">Foto Tidak Tersedia</span>
                            </div>
                        @endif
                    </div>

                    {{-- QR CODE PRODUK --}}
                    <div class="qr-card-wrapper shadow-sm">
                        <div class="mb-2 p-2 bg-white d-inline-block rounded-3">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ urlencode(route('produk.show', $produk->id)) }}"
                                 alt="QR Code {{ $produk->nama }}"
                                 class="img-fluid"
                                 width="120" height="120">
                        </div>
                        <span class="d-block fw-bold text-white small">QR Code Produk</span>
                        <span class="d-block style-code small" style="color: #94a3b8;">ID: PRD-{{ sprintf('%04d', $produk->id) }}</span>
                    </div>
                </div>

                {{-- INFORMASI PRODUK --}}
                <div class="col-md-7 col-lg-8">
                    <div class="ps-md-3">

                        {{-- STATUS STOK BADGE --}}
                        <div class="mb-2">
                            @if(($produk->stok ?? 0) > 10)
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold">
                                    <i class="bi bi-check-circle-fill me-1"></i> Stok Tersedia ({{ $produk->stok }})
                                </span>
                            @elseif(($produk->stok ?? 0) > 0)
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2 rounded-pill fw-semibold">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Stok Menipis ({{ $produk->stok }})
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold">
                                    <i class="bi bi-x-circle-fill me-1"></i> Stok Habis
                                </span>
                            @endif
                        </div>

                        {{-- NAMA PRODUK --}}
                        <h2 class="fw-bold text-white mb-4">{{ $produk->nama }}</h2>

                        {{-- HARGA BELI & HARGA JUAL --}}
                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <div class="price-box">
                                    <span class="info-label d-block mb-1">Harga Beli</span>
                                    <span class="fs-5 fw-bold text-white">
                                        Rp {{ number_format($produk->harga_beli ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="price-box price-box-sell">
                                    <span class="info-label d-block mb-1" style="color: #a7f3d0;">Harga Jual</span>
                                    <span class="fs-4 fw-bold text-white">
                                        Rp {{ number_format($produk->harga_jual ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- RINCIAN TAMBAHAN --}}
                        <div class="row g-3 border-top pt-3 mb-4" style="border-color: var(--dark-border) !important;">
                            <div class="col-6 col-sm-4">
                                <span class="info-label d-block mb-1">Total Stok</span>
                                <span class="info-value">{{ $produk->stok ?? 0 }} {{ $produk->satuan ?? 'Unit' }}</span>
                            </div>
                            <div class="col-6 col-sm-4">
                                <span class="info-label d-block mb-1">Kategori</span>
                                <span class="info-value">{{ $produk->kategori->nama ?? '-' }}</span>
                            </div>
                            <div class="col-6 col-sm-4">
                                <span class="info-label d-block mb-1">Dibuat Pada</span>
                                <span class="info-value fs-6">{{ $produk->created_at ? $produk->created_at->format('d M Y') : '-' }}</span>
                            </div>
                        </div>

                        {{-- DESKRIPSI PRODUK --}}
                        @if(!empty($produk->deskripsi))
                            <div class="mb-4">
                                <span class="info-label d-block mb-1">Deskripsi</span>
                                <p class="text-white opacity-75 small mb-0">{{ $produk->deskripsi }}</p>
                            </div>
                        @endif

                        {{-- TOMBOL AKSI --}}
                        <div class="d-flex flex-wrap align-items-center gap-2 pt-2 no-print">
                            <a href="{{ route('produk.edit', $produk) }}" class="btn btn-gradient-green d-inline-flex align-items-center gap-2">
                                <i class="bi bi-pencil-square"></i>
                                <span>Edit Produk</span>
                            </a>
                            <a href="{{ route('produk.index') }}" class="btn btn-soft-secondary d-inline-flex align-items-center gap-2">
                                <i class="bi bi-arrow-left"></i>
                                <span>Kembali ke Daftar</span>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
