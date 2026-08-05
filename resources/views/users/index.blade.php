@extends('layouts.app')

@section('title', 'Kelola Users')

@section('content')

@include('layouts.navbar')

<style>
    /* ==========================================================
       1. GLOBAL VARIABLES & CORE THEME (KUDE POS ROYAL BLUE)
    ========================================================== */
    :root {
        --bg-body: #ebf3fe;            /* Latar belakang biru soft terang */
        --card-bg: #ffffff;            /* Kartu utama putih */
        --input-bg: #ffffff;           /* Form input putih */
        --border-color: #cbd5e1;        /* Border halus */
        --text-main: #0f172a;          /* Teks utama gelap pekat */
        --text-muted: #475569;         /* Teks label/keterangan */
        --blue-primary: #0d6efd;       /* Warna Royal Blue utama */
        --blue-hover: #0b5ed7;         /* Warna saat tombol di-hover */
        --danger: #ef4444;              /* Warna hapus/batal */
    }

    body {
        background-color: var(--bg-body) !important;
        font-family: 'Plus Jakarta Sans', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
        color: var(--text-main) !important;
    }

    /* ==========================================================
       2. HEADER BANNER (KELOLA USERS)
    ========================================================== */
    .banner-green-gradient {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
        color: #ffffff !important;
        border-radius: 16px !important;
        box-shadow: 0 10px 25px rgba(13, 110, 253, 0.15) !important;
        border: none !important;
        padding: 1.75rem 2.25rem !important;
    }

    /* ==========================================================
       3. CARDS & STATISTIK (FIXED TEXT VISIBILITY)
    ========================================================== */
    .stat-card {
        background-color: var(--card-bg) !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
    }

    .stat-card-title {
        color: #475569 !important;
        font-weight: 700 !important;
        font-size: 0.85rem !important;
    }

    .stat-card-number {
        color: #0f172a !important;
        font-weight: 800 !important;
        font-size: 1.6rem !important;
        line-height: 1.2;
    }

    /* ==========================================================
       4. TABEL & PERBAIKAN TEKS KASIR / PENGGUNA
    ========================================================== */
    .custom-card {
        background-color: var(--card-bg) !important;
        border: 1px solid var(--border-color) !important;
        border-radius: 16px !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03) !important;
    }

    .bg-table-head {
        background-color: #f8fafc !important;
    }

    .table-head-text,
    .table th {
        color: var(--blue-primary) !important;
        font-weight: 800 !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        font-size: 0.75rem !important;
    }

    .custom-table {
        background-color: #ffffff !important;
        color: var(--text-main) !important;
    }

    .custom-table td {
        color: #0f172a !important;
        font-weight: 600 !important;
        vertical-align: middle;
    }

    .user-name-text {
        color: #0f172a !important;
        font-weight: 700 !important;
    }

    .custom-table tbody tr {
        border-bottom: 1px solid #f1f5f9 !important;
        transition: background-color 0.15s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f1f7ff !important;
    }

    /* Badges */
    .badge-role-admin {
        background-color: #e0f2fe !important;
        color: #0284c7 !important;
        border: 1px solid #bae6fd !important;
    }

    .badge-role-kasir {
        background-color: #fce7f3 !important;
        color: #db2777 !important;
        border: 1px solid #fbcfe8 !important;
    }

    .badge-soft-emerald {
        background-color: #dcfce7 !important;
        color: #15803d !important;
        border: 1px solid #bbf7d0 !important;
    }

    /* Avatar Initial */
    .avatar-green {
        background-color: #e0f2fe !important;
        color: #0d6efd !important;
        font-weight: 700;
    }

    /* ==========================================================
       5. INPUT & SEARCH BOX
    ========================================================== */
    .bg-search {
        background-color: var(--input-bg) !important;
        border: 1px solid #cbd5e1 !important;
        color: var(--text-main) !important;
        font-weight: 600 !important;
    }

    .bg-search:focus {
        border-color: var(--blue-primary) !important;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
    }

    /* ==========================================================
       6. BUTTONS (TOMBOL UTAMA & AKSI)
    ========================================================== */
    .btn-cyan-accent {
        background: #0a192f !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        border: none !important;
        border-radius: 50rem !important;
        box-shadow: 0 4px 12px rgba(10, 25, 47, 0.2) !important;
        transition: all 0.2s ease !important;
    }

    .btn-cyan-accent:hover {
        background: #020c1b !important;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    .btn-edit-soft {
        background: rgba(13, 110, 253, 0.1) !important;
        color: var(--blue-primary) !important;
        border: 1px solid rgba(13, 110, 253, 0.2) !important;
        border-radius: 8px;
    }

    .btn-edit-soft:hover {
        background: var(--blue-primary) !important;
        color: #ffffff !important;
    }

    .btn-delete-soft {
        background-color: rgba(239, 68, 68, 0.1) !important;
        color: var(--danger) !important;
        border: 1px solid rgba(239, 68, 68, 0.2) !important;
        border-radius: 8px;
    }

    .btn-delete-soft:hover {
        background-color: var(--danger) !important;
        color: #ffffff !important;
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER GRADIENT --}}
    <div class="banner-green-gradient p-4 p-md-5 rounded-4 mb-4 position-relative overflow-hidden shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative" style="z-index: 1;">
            <div>
                <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                    <i class="bi bi-people-fill fs-2"></i> Kelola Users
                </h2>
                <p class="small mb-0 text-white opacity-90">Atur hak akses, kredensial, dan kelola daftar pengguna sistem POS Anda.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button onclick="window.print()" class="btn btn-light text-primary rounded-pill px-3 shadow-sm fw-bold border-0 d-inline-flex align-items-center gap-2">
                    <i class="bi bi-printer-fill"></i>
                    <span>Cetak Data</span>
                </button>

                <a href="{{ route('admin.users.create') }}" class="btn btn-cyan-accent px-4 shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Tambah User</span>
                </a>
            </div>
        </div>
        <div class="position-absolute end-0 bottom-0 opacity-25 pe-4 pb-2 d-none d-md-block">
            <i class="bi bi-shield-check text-white" style="font-size: 5rem;"></i>
        </div>
    </div>

    {{-- STATISTIK RINGKASAN USER --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: #e0f2fe; color: #0d6efd; width: 48px; height: 48px;">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <span class="stat-card-title d-block">Total User</span>
                        <h5 class="stat-card-number mb-0">{{ method_exists($users, 'total') ? $users->total() : count($users) }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: #e0f2fe; color: #0d6efd; width: 48px; height: 48px;">
                        <i class="bi bi-shield-lock fs-4"></i>
                    </div>
                    <div>
                        <span class="stat-card-title d-block">Administrator</span>
                        <h5 class="stat-card-number mb-0">{{ $users->filter(fn($u) => strtolower(is_object($u->role) ? $u->role->name : $u->role ?? '') == 'admin')->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: #fce7f3; color: #db2777; width: 48px; height: 48px;">
                        <i class="bi bi-person-badge fs-4"></i>
                    </div>
                    <div>
                        <span class="stat-card-title d-block">Petugas Kasir</span>
                        <h5 class="stat-card-number mb-0" style="color: #db2777 !important;">{{ $users->filter(fn($u) => strtolower(is_object($u->role) ? $u->role->name : $u->role ?? '') != 'admin')->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: #dcfce7; color: #16a34a; width: 48px; height: 48px;">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <div>
                        <span class="stat-card-title d-block">Status Sistem</span>
                        <h5 class="fw-bold mb-0" style="color: #16a34a !important; font-size: 1rem;">Aktif Normal</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MAIN CARD --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 custom-card">

        {{-- CARD HEADER / FILTER & SEARCH --}}
        <div class="card-header border-0 pt-4 px-4 pb-0" style="background-color: transparent;">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="row g-2 justify-content-between align-items-center">

                    <div class="col-md-5 col-lg-4">
                        <div class="input-group search-box">
                            <span class="input-group-text border-end-0 rounded-start-pill ps-3 bg-search text-muted">
                                <i class="bi bi-search"></i>
                            </span>
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control border-start-0 rounded-end-pill ps-0 bg-search shadow-none"
                                placeholder="Cari nama atau email..."
                                id="fastSearchInput"
                            >
                        </div>
                    </div>

                    <div class="col-md-7 col-lg-6 d-flex align-items-center justify-content-md-end gap-2">
                        <select name="role" class="form-select bg-search rounded-pill shadow-none w-auto" onchange="this.form.submit()">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kasir" {{ request('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                        </select>

                        @if(request('search') || request('role'))
                            <a href="{{ route('admin.users') }}" class="btn btn-sm btn-light border rounded-pill px-3 text-secondary">
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
                            <th>NAMA PENGGUNA</th>
                            <th>EMAIL</th>
                            <th>HAK AKSES / ROLE</th>
                            <th>STATUS</th>
                            <th class="pe-4 text-end" style="width: 15%;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($users as $user)
                        @php
                            $roleName = is_object($user->role) ? ($user->role->name ?? 'User') : ($user->role ?? 'User');
                        @endphp
                        <tr>
                            <td class="ps-4 small fw-semibold text-muted">
                                {{ method_exists($users, 'firstItem') ? $users->firstItem() + $loop->index : $loop->iteration }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-green rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:40px;height:40px;">
                                        @if(isset($user->photo) && $user->photo)
                                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="avatar-img-table rounded-circle" style="width:100%;height:100%;object-fit:cover;">
                                        @else
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <span class="user-name-text d-block">{{ $user->name }}</span>
                                        <span class="small text-muted">ID User: #{{ $user->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="small fw-semibold text-dark">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-envelope text-muted me-1"></i>
                                    <span>{{ $user->email }}</span>
                                    <button type="button"
                                            class="btn btn-sm btn-link p-0 ms-1 border-0 text-muted"
                                            onclick="copyToClipboard('{{ $user->email }}', this)"
                                            title="Salin Email">
                                        <i class="bi bi-clipboard fs-6"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                @if(strtolower($roleName) == 'admin')
                                    <span class="badge badge-role-admin px-3 py-1.5 rounded-pill fw-semibold">
                                        <i class="bi bi-shield-lock-fill me-1"></i> Admin
                                    </span>
                                @else
                                    <span class="badge badge-role-kasir px-3 py-1.5 rounded-pill fw-semibold">
                                        <i class="bi bi-person-badge me-1"></i> {{ ucfirst($roleName) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-soft-emerald px-2.5 py-1 rounded-pill fw-semibold small">
                                    • Aktif
                                </span>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-edit-soft rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Edit Akun">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>

                                    <button type="button"
                                            class="btn btn-delete-soft rounded-circle d-inline-flex align-items-center justify-content-center"
                                            style="width: 34px; height: 34px;"
                                            title="Hapus User"
                                            onclick="triggerDeleteModal('{{ $user->id }}', '{{ $user->name }}')">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-people fs-1 d-block mb-2 opacity-50"></i>
                                <span>Tidak ada data user yang ditemukan.</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION FOOTER --}}
        @if(method_exists($users, 'hasPages') && $users->hasPages())
            <div class="card-footer border-0 px-4 py-3 border-top" style="background-color: transparent;">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <span class="small text-muted">
                        Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} user
                    </span>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        @endif

    </div>

</div>

{{-- MODAL GLOBAL KONFIRMASI HAPUS --}}
<div class="modal fade" id="globalDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden text-center p-3" style="background-color: #ffffff;">
            <div class="modal-body p-3">
                <div class="rounded-circle bg-danger bg-opacity-10 text-danger mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="bi bi-exclamation-triangle-fill fs-2"></i>
                </div>
                <h5 class="fw-bold mb-1 text-dark">Hapus User?</h5>
                <p class="small text-muted mb-0">Apakah Anda yakin ingin menghapus user <strong id="deleteUserNameText" class="text-dark"></strong>? Data ini tidak bisa dikembalikan.</p>
            </div>
            <div class="d-flex gap-2 justify-content-center px-3 pb-2">
                <button type="button" class="btn btn-light border rounded-pill px-3 fw-semibold w-50" data-bs-dismiss="modal">Batal</button>
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
    function triggerDeleteModal(userId, userName) {
        document.getElementById('deleteUserNameText').innerText = `"${userName}"`;
        document.getElementById('globalDeleteForm').action = `/admin/users/destroy/${userId}`;

        var myModal = new bootstrap.Modal(document.getElementById('globalDeleteModal'));
        myModal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('fastSearchInput');
        const tableRows = document.querySelectorAll('.custom-table tbody tr');

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

    function copyToClipboard(text, btnElement) {
        navigator.clipboard.writeText(text).then(() => {
            const icon = btnElement.querySelector('i');
            icon.className = 'bi bi-check2 text-success fs-6';
            setTimeout(() => {
                icon.className = 'bi bi-clipboard fs-6';
            }, 1500);
        });
    }
</script>

@endsection