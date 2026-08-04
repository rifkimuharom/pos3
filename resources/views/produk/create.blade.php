@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

@include('layouts.navbar')

<style>
    /* Styling tema Dark Navy Blue selaras dengan Dashboard & Users */
    .banner-dark-theme {
        background: linear-gradient(135deg, #0b1727 0%, #0f2a4a 100%) !important;
        border: 1px solid #1e3a5f;
    }

    .card-dark-theme {
        background-color: #0b1727 !important;
        border: 1px solid #1e3a5f !important;
        color: #f8fafc !important;
    }

    /* Style untuk form control agar teksnya terlihat jelas di mode dark */
    .card-dark-theme label {
        color: #94a3b8 !important; /* Warna abu terang untuk label */
        font-weight: 500;
    }

    .card-dark-theme .form-control,
    .card-dark-theme .form-select {
        background-color: #0f223d !important;
        border: 1px solid #1e3a5f !important;
        color: #ffffff !important; /* Teks putih jelas */
    }

    .card-dark-theme .form-control:focus,
    .card-dark-theme .form-select:focus {
        background-color: #132a4b !important;
        border-color: #38bdf8 !important;
        color: #ffffff !important;
        box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.25) !important;
    }

    .card-dark-theme .form-control::placeholder {
        color: #64748b !important;
    }

    /* Memastikan opsi dropdown pilihan jenis/kategori produk terlihat jelas */
    .card-dark-theme select option {
        background-color: #0f223d !important;
        color: #ffffff !important;
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-dark-theme p-4 rounded-4 mb-4 shadow-sm">
        <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
            <i class="bi bi-box-seam-fill fs-2 text-info"></i> Tambah Produk Baru
        </h2>
        <p class="text-slate-300 opacity-75 small mb-0" style="color: #94a3b8;">Isi formulir di bawah ini untuk menambahkan barang baru ke inventaris toko.</p>
    </div>

    {{-- FORM CARD --}}
    <div class="card card-dark-theme border-0 shadow-lg rounded-4 overflow-hidden mb-4">
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @include('produk._form')
            </form>
        </div>
    </div>

</div>

@endsection
