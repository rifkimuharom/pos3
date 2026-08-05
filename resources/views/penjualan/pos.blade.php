@extends('layouts.app')

@section('title', 'Sistem Kasir (POS)')

@section('content')

@include('layouts.navbar')

<style>
    /* Base Background Gelap */
    body {
        background-color: #0b132b !important;
        font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, sans-serif !important;
    }

    /* Kartu Utama Putih */
    .pos-card-white {
        background-color: #ffffff !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3) !important;
    }

    /* PAKSA SEMUA TEKS DI DALAM KARTU BERWARNA HITAM PEKAT */
    .pos-card-white,
    .pos-card-white *,
    .pos-card-white h1,
    .pos-card-white h2,
    .pos-card-white h3,
    .pos-card-white h4,
    .pos-card-white h5,
    .pos-card-white h6,
    .pos-card-white p,
    .pos-card-white span,
    .pos-card-white td,
    .pos-card-white th,
    .pos-card-white label,
    .pos-card-white div {
        color: #000000 !important;
    }

    /* Warna Harga & Teks Pendukung */
    .pos-card-white .text-price {
        color: #059669 !important;
        font-weight: 700 !important;
    }

    .pos-card-white .text-muted-custom {
        color: #475569 !important;
    }

    /* Style Input & Search Box */
    .input-pos-light {
        background-color: #f8fafc !important;
        border: 1px solid #94a3b8 !important;
        color: #000000 !important;
        font-weight: 600 !important;
    }

    .input-pos-light:focus {
        border-color: #10b981 !important;
        background-color: #ffffff !important;
        box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.2) !important;
    }

    .input-pos-light::placeholder {
        color: #64748b !important;
    }

    /* Item Produk Box */
    .product-select-btn {
        background-color: #f1f5f9 !important;
        border: 1px solid #cbd5e1 !important;
        transition: all 0.2s ease;
    }

    .product-select-btn:hover {
        border-color: #10b981 !important;
        background-color: #ecfdf5 !important;
    }

    /* Box Total Belanja */
    .total-receipt-box-light {
        background: #ecfdf5 !important;
        border: 2px dashed #10b981 !important;
        border-radius: 12px;
    }

    /* Banner Header Atas */
    .banner-dark-gradient {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%) !important;
        border: 1px solid #334155 !important;
    }

    .banner-dark-gradient * {
        color: #ffffff !important;
    }

    /* Tombol Utama */
    .btn-cyan {
        background-color: #10b981 !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        border: none !important;
    }

    .btn-cyan:hover {
        background-color: #059669 !important;
        color: #ffffff !important;
    }
</style>

<div class="container py-4">

    {{-- ALERT PESAN SYSTEM --}}
    @if(session('errors'))
        <div class="alert alert-danger rounded-3 shadow-sm mb-4 border-0 border-start border-4 border-danger">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                <div>{{ session('errors') }}</div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success rounded-3 shadow-sm mb-4 border-0 border-start border-4 border-success">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
        </div>
    @endif

    {{-- HEADER BANNER GRADIENT --}}
    <div class="banner-dark-gradient p-4 p-md-5 rounded-4 mb-4 position-relative overflow-hidden shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative" style="z-index: 1;">
            <div>
                <h2 class="fw-bold mb-1 d-flex align-items-center gap-2">
                    <i class="bi bi-calculator-fill fs-2" style="color: #34d399 !important;"></i> Transaksi Kasir (POS)
                </h2>
                <p class="opacity-75 small mb-0">Pilih item barang di sebelah kiri dan kelola keranjang belanja di sebelah kanan.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('penjualan.index') }}" class="btn btn-outline-light rounded-pill px-4 shadow-sm fw-semibold d-inline-flex align-items-center gap-2">
                    <i class="bi bi-arrow-left"></i>
                    <span>Riwayat Transaksi</span>
                </a>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- KATALOG PRODUK --}}
        <div class="col-lg-6">
            <div class="pos-card-white p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                        <i class="bi bi-grid-fill" style="color: #10b981 !important;"></i> Katalog Produk
                    </h5>
                    <span class="badge bg-success text-white px-3 py-1 rounded-pill small" style="color: #ffffff !important;">
                        {{ count($products) }} Barang
                    </span>
                </div>

                {{-- Form Pencarian Produk --}}
                <form method="GET" action="{{ route('penjualan.create') }}" id="searchForm" class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text border-end-0 rounded-start-pill ps-3 bg-light" style="border: 1px solid #94a3b8; border-right: none;">
                            <i class="bi bi-search" style="color: #10b981 !important;"></i>
                        </span>
                        <input
                            type="text"
                            name="search"
                            id="searchInput"
                            value="{{ request('search') }}"
                            class="form-control border-start-0 rounded-end-pill ps-0 input-pos-light shadow-none"
                            placeholder="Cari nama produk..."
                            onkeyup="filterProducts()"
                        >
                    </div>
                </form>

                <div class="pe-1" style="max-height: 60vh; overflow-y: auto;">
                    <div class="d-flex flex-column gap-2" id="productList">
                        @forelse($products as $product)
                            <div class="product-item" data-name="{{ strtolower($product->nama) }}">
                                <form method="POST" action="{{ route('itempenjualan.store') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                    <div class="p-2.5 rounded-3 product-select-btn">
                                        <div class="row align-items-center g-2">
                                            <div class="col-7">
                                                <div class="d-flex align-items-center gap-3">
                                                    @if($product->foto)
                                                        <img src="{{ asset('storage/'.$product->foto) }}"
                                                             alt="{{ $product->nama }}"
                                                             class="rounded-3 shadow-sm border"
                                                             style="width:44px; height:44px; object-fit:cover;">
                                                    @else
                                                        <div class="rounded-3 shadow-sm d-flex align-items-center justify-content-center bg-light border fw-bold" style="width:44px; height:44px;">
                                                            <i class="bi bi-box-seam fs-5" style="color: #10b981 !important;"></i>
                                                        </div>
                                                    @endif
                                                    <div class="text-truncate">
                                                        <div class="fw-bold text-truncate small">{{ $product->nama }}</div>
                                                        <div class="text-price small">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3">
                                                <input type="number"
                                                       name="quantity"
                                                       value="1"
                                                       min="1"
                                                       class="form-control form-control-sm text-center input-pos-light rounded-pill shadow-none">
                                            </div>

                                            <div class="col-2 text-end">
                                                <button type="submit"
                                                        class="btn btn-sm btn-cyan rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm"
                                                        style="width: 34px; height: 34px;"
                                                        title="Tambah ke Keranjang">
                                                    <i class="bi bi-plus-lg fw-bold" style="color: #ffffff !important;"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-box-seam fs-1 d-block mb-2"></i>
                                <span>Produk tidak ditemukan.</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- KERANJANG BELANJA --}}
        <div class="col-lg-6">
            <div class="pos-card-white p-4 h-100 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                            <i class="bi bi-cart3" style="color: #10b981 !important;"></i> Keranjang
                            <span class="badge rounded-pill bg-danger fs-6 fw-normal px-2" style="font-size: 0.75rem !important; color: #ffffff !important;">
                                {{ $sale->itemPenjualan->sum('kuantitas') }} Item
                            </span>
                        </h5>
                        <span class="badge bg-success text-white px-3 py-1 rounded-pill fw-semibold" style="color: #ffffff !important;">
                            Transaksi #{{ $sale->id }}
                        </span>
                    </div>

                    {{-- Tabel Item Keranjang --}}
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr style="border-bottom: 2px solid #64748b;">
                                    <th class="ps-2">PRODUK</th>
                                    <th>HARGA</th>
                                    <th style="width: 20%;">QTY</th>
                                    <th>SUBTOTAL</th>
                                    <th class="pe-2 text-end" style="width: 10%;">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sale->itemPenjualan as $item)
                                <tr style="border-bottom: 1px solid #cbd5e1;">
                                    <td class="ps-2">
                                        <span class="fw-bold small d-block">{{ $item->produk->nama }}</span>
                                    </td>
                                    <td class="small text-muted-custom">
                                        Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item->kuantitas }}"
                                                   min="1"
                                                   onchange="this.form.submit()"
                                                   class="form-control form-control-sm text-center input-pos-light rounded-2 shadow-none">
                                        </form>
                                    </td>
                                    <td class="text-price small">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
<td class="pe-2 text-end">
    <form action="{{ route('itempenjualan.destroy', $item->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="btn btn-outline-danger btn-sm rounded-circle d-inline-flex align-items-center justify-content-center"
                style="width: 32px; height: 32px;"
                onclick="return confirm('Yakin ingin menghapus item ini dari keranjang?')">
            <i class="bi bi-trash-fill small"></i>
        </button>
    </form>
</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="bi bi-cart-x fs-1 d-block mb-2"></i>
                                        <span>Keranjang belanja masih kosong.</span>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- TOTAL & CHECKOUT --}}
                <div class="mt-4 pt-3 border-top" style="border-top-color: #cbd5e1 !important;">
                    <div class="total-receipt-box-light p-3 mb-3 text-center">
                        <span class="small text-uppercase fw-bold d-block mb-1 text-muted-custom">Total Pembayaran</span>
                        <h2 class="fw-bold mb-0 text-price" style="font-size: 2.2rem;">
                            Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                        </h2>
                    </div>

                    <form id="checkoutForm" method="POST" action="{{ route('penjualan.update', $sale->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <select id="paymentMethodSelect" name="payment_method" class="form-select input-pos-light rounded-pill px-3 shadow-none" required>
                                <option value="">-- Pilih Metode Pembayaran --</option>
                                <option value="CASH">Cash / Tunai</option>
                                <option value="QRIS">QRIS (Scan Barcode)</option>
                                <option value="TRANSFER">Transfer Bank</option>
                            </select>
                        </div>

                        <button type="button" onclick="handleCheckout()" class="btn btn-cyan w-100 rounded-pill py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-check-circle-fill" style="color: #ffffff !important;"></i>
                            <span style="color: #ffffff !important;">Selesaikan & Checkout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

{{-- MODAL SCAN QRIS --}}
<div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-3" style="border-radius: 16px; background-color: #ffffff;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark w-100" id="qrisModalLabel">Scan QRIS Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted small mb-2">Pindai kode QR di bawah ini menggunakan aplikasi e-Wallet / Mobile Banking Anda</p>

                {{-- Dynamic Barcode QRIS --}}
                <div class="p-3 bg-light rounded-3 d-inline-block border mb-3">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=POS_TRX_{{ $sale->id }}_RP_{{ $sale->total_pembayaran }}"
                         alt="QRIS Code"
                         class="img-fluid rounded">
                </div>

                <div class="total-receipt-box-light p-2 mb-3">
                    <span class="small text-uppercase fw-bold text-muted d-block">Total Bayar</span>
                    <h3 class="fw-bold text-success mb-0">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0 d-flex gap-2">
                <button type="button" class="btn btn-secondary rounded-pill w-50" data-bs-dismiss="modal">Batal</button>
                <button type="button" onclick="submitCheckoutForm()" class="btn btn-success rounded-pill w-50 fw-bold">Konfirmasi Lunas</button>
            </div>
        </div>
    </div>
</div>

<script>
    function filterProducts() {
        const input = document.getElementById('searchInput').value.toLowerCase();
        const items = document.querySelectorAll('.product-item');

        items.forEach(item => {
            const name = item.getAttribute('data-name');
            if (name.includes(input)) {
                item.style.display = "";
            } else {
                item.style.display = "none";
            }
        });
    }

    function handleCheckout() {
        const paymentMethod = document.getElementById('paymentMethodSelect').value;
        const totalAmount = {{ $sale->total_pembayaran }};

        if (!paymentMethod) {
            alert('Silakan pilih metode pembayaran terlebih dahulu.');
            return;
        }

        if (totalAmount <= 0) {
            alert('Keranjang belanja masih kosong!');
            return;
        }

        // Tampilkan Modal QRIS jika memilih metode QRIS
        if (paymentMethod === 'QRIS') {
            const qrisModal = new bootstrap.Modal(document.getElementById('qrisModal'));
            qrisModal.show();
        } else {
            if (confirm('Yakin ingin menyelesaikan transaksi ini?')) {
                submitCheckoutForm();
            }
        }
    }

    function submitCheckoutForm() {
        document.getElementById('checkoutForm').submit();
    }
</script>

@endsection
