@extends('layouts.app')

@section('title', 'Login - POS System')

@section('content')

<style>
    /* Paksa body untuk mengisi layar penuh dan di-center */
    body {
        background: linear-gradient(135deg, #0a192f 0%, #112240 100%) !important;
        margin: 0 !important;
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
    }

    /* Wrapper utama penjamin posisi tengah presisi */
    .login-wrapper {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
    }

    .login-card {
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 20px 40px rgba(2, 12, 27, 0.7);
        background: #ffffff;
        overflow: hidden;
        width: 100%;
        max-width: 420px;
    }

    .login-header {
        background: transparent;
        padding: 2.5rem 2rem 1rem 2rem;
        border-bottom: none;
    }

    .login-icon-wrapper {
        width: 65px;
        height: 65px;
        background: rgba(100, 255, 218, 0.15);
        color: #0a192f;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem auto;
    }

    .form-control {
        border-radius: 12px;
        padding: 0.75rem 1rem;
        border: 1.5px solid #cbd5e1;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        color: #1e293b;
    }

    .form-control:focus {
        border-color: #64ffda;
        box-shadow: 0 0 0 4px rgba(100, 255, 218, 0.25);
    }

    .btn-gradient-login {
        background: #64ffda;
        border: none;
        color: #0a192f;
        padding: 0.8rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.25s ease;
    }

    .btn-gradient-login:hover {
        background: #4cd8b2;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(100, 255, 218, 0.3);
        color: #0a192f;
    }

    .error-badge {
        font-size: 0.8rem;
        border-radius: 8px;
        padding: 0.35rem 0.6rem;
        margin-top: 0.4rem;
        display: inline-block;
    }
</style>

{{-- Container Utama Flexbox --}}
<div class="login-wrapper">
    <div class="card login-card">

        {{-- HEADER CARD --}}
        <div class="login-header text-center">
            <div class="login-icon-wrapper shadow-sm">
                <i class="bi bi-shop fs-2 text-dark"></i>
            </div>
            <h4 class="fw-bold text-dark mb-1">Masuk POS</h4>
            <p class="text-muted small mb-0">Silakan login untuk mengelola transaksi</p>
        </div>

        {{-- BODY CARD / FORM LOGIN --}}
        <div class="card-body px-4 pb-4">

            {{-- ALERT ERROR SESSION --}}
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show rounded-3 small mb-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close small" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('auth') }}" method="POST">
                @csrf

                {{-- EMAIL INPUT --}}
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold text-secondary small">Alamat Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           placeholder="nama@email.com"
                           required
                           autofocus>
                    @error('email')
                        <div class="badge bg-danger-subtle text-danger border border-danger-subtle error-badge">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- PASSWORD INPUT --}}
                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold text-secondary small">Kata Sandi</label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           id="password"
                           placeholder="••••••••"
                           required>
                    @error('password')
                        <div class="badge bg-danger-subtle text-danger border border-danger-subtle error-badge">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- SUBMIT BUTTON --}}
                <div class="d-grid">
                    <button type="submit" class="btn btn-gradient-login d-flex align-items-center justify-content-center gap-2">
                        <span>Masuk</span>
                        <i class="bi bi-box-arrow-in-right fs-5"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@endsection 
