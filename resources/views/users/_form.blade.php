@csrf

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

    /* Form Text & Labels */
    .form-label-custom {
        font-weight: 600;
        color: var(--text-light-slate);
        font-size: 0.875rem;
        margin-bottom: 0.35rem;
    }

    /* Inputs & Selects Theme */
    .form-control-custom, .form-select-custom {
        background-color: var(--bg-slate-navy) !important;
        border: 1px solid var(--bg-light-navy) !important;
        color: var(--white) !important;
        border-radius: 12px;
        padding: 0.65rem 0.9rem;
        transition: all 0.3s ease;
    }

    .form-control-custom::placeholder {
        color: var(--text-slate) !important;
    }

    .form-control-custom:focus, .form-select-custom:focus {
        background-color: var(--bg-slate-navy) !important;
        border-color: var(--cyan-accent) !important;
        box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.15) !important;
        color: var(--white) !important;
    }

    /* Dropdown Options */
    .form-select-custom option {
        background-color: var(--bg-slate-navy);
        color: var(--white);
    }

    /* Input Icons Styling */
    .input-group-text-custom {
        background-color: var(--bg-light-navy) !important;
        border: 1px solid var(--bg-light-navy) !important;
        border-right: none !important;
        color: var(--cyan-accent) !important;
        border-top-left-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    /* Button Gradient Submit (Aksen Cyan #64FFDA) */
    button.btn-gradient-submit {
        background: var(--cyan-accent) !important;
        border: none !important;
        color: #0a192f !important;
        padding: 0.65rem 1.75rem;
        border-radius: 50px;
        font-weight: 700;
        box-shadow: 0 5px 20px rgba(100, 255, 218, 0.25);
        transition: all 0.3s ease;
    }

    .btn-gradient-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(100, 255, 218, 0.4);
        background: #52e0c4 !important;
    }

    /* Button Secondary Soft */
    a.btn-soft-secondary {
        background-color: var(--bg-light-navy) !important;
        color: var(--text-light-slate) !important;
        border: 1px solid rgba(100, 255, 218, 0.2) !important;
        padding: 0.65rem 1.75rem;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-soft-secondary:hover {
        background-color: rgba(100, 255, 218, 0.1) !important;
        color: var(--cyan-accent) !important;
        border-color: var(--cyan-accent) !important;
        transform: translateY(-2px);
    }

    /* Avatar Upload Preview Box */
    .avatar-upload-box {
        position: relative;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        overflow: hidden;
        border: 2px solid var(--cyan-accent);
        box-shadow: 0 0 20px rgba(100, 255, 218, 0.2);
        background-color: var(--bg-slate-navy);
    }

    .avatar-preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<div class="row g-3">
    {{-- UPLOAD FOTO PROFIL --}}
    <div class="col-12 mb-2">
        <label class="form-label-custom d-block">Foto Profil</label>
        <div class="d-flex align-items-center gap-3">
            <div class="avatar-upload-box flex-shrink-0">
                <img id="imagePreview"
                     src="{{ isset($user) && $user->photo ? asset('storage/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&background=112240&color=64ffda' }}"
                     alt="Preview Foto"
                     class="avatar-preview-img">
            </div>
            <div class="flex-grow-1">
                <input type="file"
                       name="photo"
                       id="photoInput"
                       class="form-control form-control-custom @error('photo') is-invalid @enderror"
                       accept="image/*"
                       onchange="previewPhoto(event)">
                <small style="color: var(--text-slate)" class="d-block mt-1">Format: JPG, JPEG, PNG, WEBP (Maksimal 2MB)</small>
                @error('photo')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    {{-- NAMA USER --}}
    <div class="col-12">
        <label class="form-label-custom">Nama Lengkap</label>
        <div class="input-group">
            <span class="input-group-text input-group-text-custom">
                <i class="bi bi-person-fill"></i>
            </span>
            <input type="text"
                   name="name"
                   class="form-control form-control-custom border-start-0 @error('name') is-invalid @enderror"
                   placeholder="Masukkan nama pengguna..."
                   value="{{ old('name', $user->name ?? '') }}">
        </div>
        @error('name')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- EMAIL --}}
    <div class="col-md-6">
        <label class="form-label-custom">Alamat Email</label>
        <div class="input-group">
            <span class="input-group-text input-group-text-custom">
                <i class="bi bi-envelope-fill"></i>
            </span>
            <input type="email"
                   name="email"
                   class="form-control form-control-custom border-start-0 @error('email') is-invalid @enderror"
                   placeholder="contoh@domain.com"
                   value="{{ old('email', $user->email ?? '') }}">
        </div>
        @error('email')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- PASSWORD --}}
    <div class="col-md-6">
        <label class="form-label-custom">Password</label>
        <div class="input-group">
            <span class="input-group-text input-group-text-custom">
                <i class="bi bi-key-fill"></i>
            </span>
            <input type="password"
                   name="password"
                   class="form-control form-control-custom border-start-0 @error('password') is-invalid @enderror"
                   placeholder="{{ isset($user) ? 'Kosongkan jika tidak diubah' : 'Masukkan password...' }}">
        </div>
        @if(isset($user))
            <small style="color: var(--text-slate)" class="d-block mt-1">Biarkan kosong jika tidak ingin mengganti password.</small>
        @endif
        @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>

    {{-- ROLE --}}
    <div class="col-12">
        <label class="form-label-custom">Role Access</label>
        <div class="input-group">
            <span class="input-group-text input-group-text-custom">
                <i class="bi bi-shield-lock-fill"></i>
            </span>
            <select name="role_id"
                    class="form-select form-select-custom border-start-0 @error('role_id') is-invalid @enderror">
                <option value="">-- Pilih Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        @error('role_id')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
</div>

{{-- TOMBOL AKSI --}}
<div class="d-flex align-items-center gap-2 mt-4 pt-3 border-top" style="border-color: var(--bg-light-navy) !important;">
    <button class="btn btn-gradient-submit d-inline-flex align-items-center gap-2" type="submit">
        <i class="bi bi-check-circle-fill"></i>
        <span>Simpan User</span>
    </button>
    <a href="{{ route('admin.users') }}" class="btn btn-soft-secondary d-inline-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i>
        <span>Kembali</span>
    </a>
</div>

{{-- SCRIPT PREVIEW FOTO --}}
<script>
    function previewPhoto(event) {
        const input = event.target;
        const preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
