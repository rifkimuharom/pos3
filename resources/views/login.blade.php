@extends('layouts.guest')

@section('title', 'Login - POS System')

@section('content')

    <style>
        /* ==========================================
           BACKGROUND GRAFITI & OVERLAY
        ========================================== */
        body {
            margin: 0 !important;
            padding: 0 !important;
            font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;

            /* Menggunakan gambar grafiti (bisa ganti link online atau file lokal asset('images/grafiti.jpg')) */
            background: url('https://images.unsplash.com/photo-1541701494587-cb58502866ab?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed !important;
            background-size: cover !important;

            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Lapisan Gelap Transparan di atas Gambar Grafiti */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(10, 25, 47, 0.75);
            /* Ubah angka 0.75 untuk mengatur tingkat kegelapan overlay */
            z-index: 1;
        }

        /* ==========================================
           CARD LOGIN & ELEMENT STYLING
        ========================================== */
        .login-wrapper {
            position: relative;
            z-index: 2;
            /* Menempatkan form di atas overlay */
            width: 100%;
            max-width: 420px;
            padding: 1.5rem;
        }

        .login-card {
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.6);
            background: #ffffff;
            overflow: hidden;
            width: 100%;
        }

        .login-header {
            background: transparent;
            padding: 2.5rem 2rem 1rem 2rem;
            border-bottom: none;
        }

        .login-icon-wrapper {
            width: 65px;
            height: 65px;
            background: rgba(37, 99, 235, 0.1);
            color: #2563eb;
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
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
        }

        .btn-gradient-login {
            background: #2563eb;
            border: none;
            color: #ffffff;
            padding: 0.8rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            transition: all 0.25s ease;
        }

        .btn-gradient-login:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(37, 99, 235, 0.35);
            color: #ffffff;
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
        <div class="card login-card shadow-lg">

            {{-- HEADER CARD --}}
            <div class="login-header text-center">
                <div class="login-icon-wrapper shadow-sm">
                    <i class="bi bi-shop fs-2"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1">Masuk POS</h4>
                <p class="text-muted small mb-0">Silakan login untuk mengelola transaksi</p>
            </div>

            {{-- BODY CARD / FORM LOGIN --}}
            <div class="card-body px-4 pb-4">

                {{-- ALERT ERROR SESSION --}}
                @if (session('error'))
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
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" id="email"
                            placeholder="nama@email.com" required autofocus>
                        @error('email')
                            <div class="badge bg-danger-subtle text-danger border border-danger-subtle error-badge">
                                <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- PASSWORD INPUT --}}
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold text-secondary small">Kata Sandi</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="••••••••" required>
                        @error('password')
                            <div class="badge bg-danger-subtle text-danger border border-danger-subtle error-badge">
                                <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- SUBMIT BUTTON --}}
                    <div class="d-grid">
                        <button type="submit"
                            class="btn btn-gradient-login d-flex align-items-center justify-content-center gap-2">
                            <span>Masuk</span>
                            <i class="bi bi-box-arrow-in-right fs-5"></i>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
