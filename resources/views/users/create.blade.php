@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

@include('layouts.navbar')

<style>
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

    /* Header Banner Cyberspace Style */
    .banner-green-gradient {
        background: linear-gradient(135deg, #020c1b 0%, var(--bg-slate-navy) 60%, var(--bg-light-navy) 100%) !important;
        color: var(--white) !important;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(2, 12, 27, 0.8);
        border: 1px solid var(--bg-light-navy);
        position: relative;
        overflow: hidden;
    }

    /* Form Container Card */
    .custom-card {
        background-color: var(--bg-slate-navy) !important;
        border: 1px solid var(--bg-light-navy) !important;
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER --}}
    <div class="banner-green-gradient p-4 p-md-5 rounded-4 mb-4 shadow-sm position-relative">
        <div class="position-relative" style="z-index: 1;">
            <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                <i class="bi bi-person-plus-fill fs-2" style="color: var(--cyan-accent);"></i> Tambah User Baru
            </h2>

            <p class="small mb-0" style="color: var(--text-slate);">
                Isi data akun baru untuk memberikan hak akses ke dalam sistem POS.
            </p>
        </div>

        <div class="position-absolute end-0 bottom-0 opacity-25 pe-4 pb-2 d-none d-md-block">
            <i class="bi bi-person-badge" style="font-size: 5rem; color: var(--cyan-accent);"></i>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card">

        <div class="card-body p-4 p-md-5">

            <form action="{{ route('admin.users.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @include('users._form')

            </form>

        </div>

    </div>

</div>

@endsection
