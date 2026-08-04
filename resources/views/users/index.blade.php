@extends('layouts.app')

@section('title', 'Kelola Users')

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
        --danger: #ff6b6b;
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

    /* Stat Cards */
    .stat-card {
        border-radius: 16px;
        background-color: var(--bg-slate-navy) !important;
        border: 1px solid var(--bg-light-navy) !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4) !important;
        border-color: rgba(100, 255, 218, 0.3) !important;
    }

    /* Main Container Card */
    .custom-card {
        background-color: var(--bg-slate-navy) !important;
        border: 1px solid var(--bg-light-navy) !important;
    }

    /* Avatar Styling */
    .avatar-green {
        background: var(--bg-light-navy) !important;
        color: var(--cyan-accent) !important;
        border: 1px solid rgba(100, 255, 218, 0.3);
        font-weight: 700;
        font-size: 0.95rem;
    }

    .avatar-img-table {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--cyan-accent);
        box-shadow: 0 0 10px rgba(100, 255, 218, 0.2);
    }

    /* Badges Style */
    .badge-role-admin {
        background: rgba(56, 189, 248, 0.15) !important;
        color: #38bdf8 !important;
        border: 1px solid rgba(56, 189, 248, 0.3) !important;
    }

    .badge-role-kasir {
        background: rgba(100, 255, 218, 0.15) !important;
        color: var(--cyan-accent) !important;
        border: 1px solid rgba(100, 255, 218, 0.3) !important;
    }

    .badge-soft-emerald {
        background: rgba(100, 255, 218, 0.1) !important;
        color: var(--cyan-accent) !important;
        border: 1px solid rgba(100, 255, 218, 0.2) !important;
    }

    /* Table Styling */
    .bg-table-head {
        background-color: var(--bg-dark-navy) !important;
    }

    .table-head-text {
        color: var(--text-slate) !important;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .user-name-text {
        color: var(--white) !important;
        font-weight: 600;
        transition: color 0.15s ease;
    }

    .custom-table tbody tr {
        border-bottom: 1px solid var(--bg-light-navy) !important;
        transition: background-color 0.15s ease;
        animation: fadeInUp 0.35s ease-in-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .custom-table tbody tr:hover {
        background-color: var(--bg-light-navy) !important;
    }

    .custom-table tbody tr:hover .user-name-text {
        color: var(--cyan-accent) !important;
    }

    /* Search & Filters Box */
    .bg-search {
        background-color: var(--bg-dark-navy) !important;
        border-color: var(--bg-light-navy) !important;
        color: var(--white) !important;
        transition: all 0.2s ease;
    }

    .bg-search::placeholder {
        color: var(--text-slate) !important;
    }

    .search-box:focus-within .bg-search {
        background-color: var(--bg-dark-navy) !important;
        border-color: var(--cyan-accent) !important;
        box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.15) !important;
    }

    /* Action Buttons */
    .btn-cyan-accent {
        background: var(--cyan-accent) !important;
        color: #0a192f !important;
        font-weight: 700;
        border: none !important;
        box-shadow: 0 4px 15px rgba(100, 255, 218, 0.25);
        transition: all 0.2s ease;
    }

    .btn-cyan-accent:hover {
        background: #52e0c4 !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(100, 255, 218, 0.4);
    }

    .btn-edit-soft {
        background: rgba(100, 255, 218, 0.15) !important;
        color: var(--cyan-accent) !important;
        border: 1px solid rgba(100, 255, 218, 0.3) !important;
        transition: all .2s ease;
    }

    .btn-edit-soft:hover {
        background: var(--cyan-accent) !important;
        color: #0a192f !important;
        transform: scale(1.08);
    }

    .btn-delete-soft {
        background-color: rgba(255, 107, 107, 0.15) !important;
        color: var(--danger) !important;
        border: 1px solid rgba(255, 107, 107, 0.3) !important;
        transition: all 0.2s ease;
    }

    .btn-delete-soft:hover {
        background-color: var(--danger) !important;
        color: #ffffff !important;
        transform: scale(1.08);
    }

    /* Modal Dark Theme */
    .modal-content-dark {
        background-color: var(--bg-slate-navy) !important;
        border: 1px solid var(--bg-light-navy) !important;
        color: var(--white) !important;
    }
</style>

<div class="container py-4">

    {{-- HEADER BANNER GRADIENT --}}
    <div class="banner-green-gradient p-4 p-md-5 rounded-4 mb-4 position-relative overflow-hidden shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 position-relative" style="z-index: 1;">
            <div>
                <h2 class="fw-bold mb-1 text-white d-flex align-items-center gap-2">
                    <i class="bi bi-people-fill fs-2" style="color: var(--cyan-accent)"></i> Kelola Users
                </h2>
                <p class="small mb-0" style="color: var(--text-slate)">Atur hak akses, kredensial, dan kelola daftar pengguna sistem POS Anda.</p>
            </div>
            <div class="d-flex flex-wrap gap-2">
                <button onclick="window.print()" class="btn btn-outline-light rounded-pill px-3 shadow-sm fw-semibold d-inline-flex align-items-center gap-2" style="border-color: var(--bg-light-navy);">
                    <i class="bi bi-printer-fill" style="color: var(--cyan-accent)"></i>
                    <span>Cetak Data</span>
                </button>

                <a href="{{ route('admin.users.create') }}" class="btn btn-cyan-accent rounded-pill px-4 shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Tambah User</span>
                </a>
            </div>
        </div>
        <div class="position-absolute end-0 bottom-0 opacity-25 pe-4 pb-2 d-none d-md-block">
            <i class="bi bi-shield-check" style="font-size: 5rem; color: var(--cyan-accent)"></i>
        </div>
    </div>

    {{-- STATISTIK RINGKASAN USER --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: rgba(100, 255, 218, 0.1); color: var(--cyan-accent); width: 48px; height: 48px;">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block" style="color: var(--text-slate)">Total User</span>
                        <h5 class="fw-bold mb-0 text-white">{{ method_exists($users, 'total') ? $users->total() : count($users) }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: rgba(56, 189, 248, 0.1); color: #38bdf8; width: 48px; height: 48px;">
                        <i class="bi bi-shield-lock fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block" style="color: var(--text-slate)">Administrator</span>
                        <h5 class="fw-bold mb-0 text-white">{{ $users->filter(fn($u) => strtolower(is_object($u->role) ? $u->role->name : $u->role ?? '') == 'admin')->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: rgba(244, 114, 182, 0.1); color: #f472b6; width: 48px; height: 48px;">
                        <i class="bi bi-person-badge fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block" style="color: var(--text-slate)">Petugas Kasir</span>
                        <h5 class="fw-bold mb-0 text-white">{{ $users->filter(fn($u) => strtolower(is_object($u->role) ? $u->role->name : $u->role ?? '') != 'admin')->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-3 shadow-sm">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-3 d-flex align-items-center justify-content-center" style="background: rgba(100, 255, 218, 0.1); color: var(--cyan-accent); width: 48px; height: 48px;">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <div>
                        <span class="small d-block" style="color: var(--text-slate)">Status Sistem</span>
                        <h5 class="fw-bold mb-0" style="color: var(--cyan-accent); font-size: 0.95rem;">Aktif Normal</h5>
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
                            <span class="input-group-text border-end-0 rounded-start-pill ps-3 bg-search">
                                <i class="bi bi-search" style="color: var(--cyan-accent);"></i>
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
                            <a href="{{ route('admin.users') }}" class="btn btn-sm btn-outline-light rounded-pill px-3 border-0" style="color: var(--text-slate)">
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
                            <td class="ps-4 small fw-medium" style="color: var(--text-slate)">
                                {{ method_exists($users, 'firstItem') ? $users->firstItem() + $loop->index : $loop->iteration }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-green rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width:40px;height:40px;">
                                        @if(isset($user->photo) && $user->photo)
                                            <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="avatar-img-table">
                                        @else
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        @endif
                                    </div>
                                    <div>
                                        <span class="user-name-text d-block">{{ $user->name }}</span>
                                        <span class="small" style="color: var(--text-slate)">ID User: #{{ $user->id }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="small fw-medium" style="color: var(--text-light-slate)">
                                <div class="d-flex align-items-center gap-1">
                                    <i class="bi bi-envelope me-1" style="color: var(--text-slate)"></i>
                                    <span>{{ $user->email }}</span>
                                    <button type="button"
                                            class="btn btn-sm btn-link p-0 ms-1 border-0"
                                            style="color: var(--text-slate)"
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
                                    <i class="bi bi-dot"></i> Aktif
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
                            <td colspan="6" class="text-center py-5" style="color: var(--text-slate)">
                                <i class="bi bi-people fs-1 d-block mb-2"></i>
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
            <div class="card-footer border-0 px-4 py-3 border-top" style="background-color: transparent; border-color: var(--bg-light-navy) !important;">
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
                    <span class="small" style="color: var(--text-slate)">
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
        <div class="modal-content modal-content-dark border-0 shadow-lg rounded-4 overflow-hidden text-center p-3">
            <div class="modal-body p-3">
                <div class="rounded-circle bg-danger bg-opacity-10 text-danger mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                    <i class="bi bi-exclamation-triangle-fill fs-2"></i>
                </div>
                <h5 class="fw-bold mb-1 text-white">Hapus User?</h5>
                <p class="small mb-0" style="color: var(--text-slate)">Apakah Anda yakin ingin menghapus user <strong id="deleteUserNameText" class="text-white"></strong>? Data ini tidak bisa dikembalikan.</p>
            </div>
            <div class="d-flex gap-2 justify-content-center px-3 pb-2">
                <button type="button" class="btn btn-outline-light rounded-pill px-3 fw-semibold w-50" style="border-color: var(--bg-light-navy)" data-bs-dismiss="modal">Batal</button>
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
