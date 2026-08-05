@csrf
@if ($errors->any())
    <div class="alert alert-danger border-0 text-white bg-danger mb-4 rounded-3 shadow-sm">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<style>
/* ==========================================================
   1. GLOBAL VARIABLES & TEMA FORM PRODUK (ROYAL BLUE THEME)
========================================================== */
:root {
    --bg-body: #f0f5ff;             /* Latar belakang utama (Biru Soft Segar) */
    --light-card-bg: #ffffff;       /* Card Container (Putih Bersih) */
    --light-input-bg: #f8fafc;      /* Input Field & File Upload (Light Soft) */
    --light-border: #cce0ff;        /* Border Soft Biru */
    --text-label: #0a1c33;          /* Label Teks (Gelap Kontras) */
    --text-main: #0a1c33;           /* Teks Utama (Gelap Kontras) */
    --accent-blue: #0d6efd;         /* Biru Royal Utama */
    --accent-hover: #0b5ed7;        /* Biru Royal Hover */
    --danger: #dc3545;            /* Warna Batal */
}

body {
    background-color: var(--bg-body) !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    color: var(--text-main);
}

/* ==========================================================
   2. CARD CONTAINER & LABELS FORM
========================================================== */
.form-card-section,
.custom-card {
    background-color: var(--light-card-bg) !important;
    border-radius: 16px;
    border: 1px solid var(--light-border) !important;
    box-shadow: 0 8px 25px rgba(13, 110, 253, 0.06);
    overflow: hidden;
    padding: 1.5rem;
}

.form-label-custom,
.form-label,
label {
    font-weight: 700 !important;
    color: var(--text-label) !important;
    font-size: 0.9rem;
    margin-bottom: 0.4rem;
    display: inline-block;
}

/* ==========================================================
   3. INPUT GROUPS & FORM CONTROLS
========================================================== */
.input-group-custom .input-group-text,
.input-group-text {
    background-color: rgba(13, 110, 253, 0.08) !important;
    border-color: var(--light-border) !important;
    color: var(--accent-blue) !important;
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    font-weight: 700 !important;
}

.form-control-custom,
select.form-control-custom,
.form-control,
.form-select {
    background-color: #ffffff !important;
    border-radius: 10px;
    border: 1px solid var(--light-border) !important;
    padding: 0.65rem 0.9rem;
    font-size: 0.9rem;
    font-weight: 600 !important;
    color: var(--text-main) !important;
    transition: all 0.2s ease-in-out;
}

.input-group-custom .form-control-custom {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.form-control-custom:focus,
.form-control:focus,
.form-select:focus {
    background-color: #ffffff !important;
    border-color: var(--accent-blue) !important;
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15) !important;
    color: var(--text-main) !important;
}

/* ==========================================================
   4. UPLOAD FOTO PRODUK AREA
========================================================== */
.file-upload-box {
    border: 2px dashed var(--light-border);
    border-radius: 14px;
    padding: 1.5rem;
    text-align: center;
    background-color: var(--light-input-bg);
    cursor: pointer;
    transition: all 0.2s ease;
    position: relative;
}

.file-upload-box:hover {
    border-color: var(--accent-blue);
    background-color: rgba(13, 110, 253, 0.05);
}

.file-upload-box input[type="file"] {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

/* ==========================================================
   5. PERBAIKAN: KATEGORI / JENIS PRODUK CARD (KLIKABLE)
========================================================== */
.category-card {
    position: relative;
    display: block;
    width: 100%;
}

.category-card input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    pointer-events: none;
}

.category-content {
    position: relative;
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px;
    border: 2px solid var(--light-border);
    border-radius: 16px;
    background: #ffffff;
    transition: all .2s ease-in-out;
    cursor: pointer !important;
    user-select: none;
}

.category-content:hover {
    border-color: var(--accent-blue);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.12);
}

.category-image {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 12px;
    flex-shrink: 0;
}

.category-text {
    flex-grow: 1;
}

.category-text h5 {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: var(--text-main) !important;
}

.category-text small {
    color: #64748b !important;
    font-weight: 500;
    display: block;
}

.check-circle {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    border: 2px solid var(--light-border);
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: transparent;
    transition: all 0.2s ease;
    flex-shrink: 0;
}

/* Style Ketika Kategori Terpilih */
.category-card input[type="radio"]:checked + .category-content {
    border-color: var(--accent-blue) !important;
    background: rgba(13, 110, 253, 0.08) !important;
}

.category-card input[type="radio"]:checked + .category-content .check-circle {
    background: var(--accent-blue) !important;
    border-color: var(--accent-blue) !important;
    color: #ffffff !important;
}

/* ==========================================================
   6. BUTTONS
========================================================== */
button.btn-gradient-submit {
    background: var(--accent-blue) !important;
    border: none !important;
    color: #ffffff !important;
    padding: 0.7rem 1.8rem;
    border-radius: 50px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    transition: all 0.2s ease;
}

button.btn-gradient-submit:hover {
    background: var(--accent-hover) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4);
}

a.btn-soft-secondary {
    background: rgba(220, 53, 69, 0.1) !important;
    color: var(--danger) !important;
    border: 1px solid rgba(220, 53, 69, 0.25) !important;
    padding: 0.7rem 1.8rem;
    border-radius: 50px;
    font-weight: 700;
    transition: all 0.2s ease;
    text-decoration: none;
}

a.btn-soft-secondary:hover {
    background: var(--danger) !important;
    color: #ffffff !important;
}
</style>

<div class="row g-4">

    {{-- UPLOAD FOTO PRODUK --}}
    <div class="col-12">
        <div class="p-4 form-card-section">
            <label class="form-label-custom">Foto Produk</label>

            <div class="file-upload-box mb-2" id="dropArea">
                <input type="file"
                       name="foto"
                       id="fotoInput"
                       onchange="previewImage(this)"
                       accept="image/*">

                <div id="uploadPlaceholder">
                    <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>
                    <p class="mb-1 mt-2 fw-semibold text-dark">Klik atau geser foto ke sini untuk mengunggah</p>
                    <span class="small text-muted">Format: JPG, JPEG, PNG (Maks. 2MB)</span>
                </div>

                {{-- PREVIEW FOTO --}}
                <div id="previewContainer" class="mt-2" style="{{ isset($produk) && $produk->foto ? '' : 'display:none;' }}">
                    <div class="position-relative d-inline-block">
                        <img id="preview"
                             src="{{ isset($produk) && $produk->foto ? asset('storage/' . $produk->foto) : '#' }}"
                             class="rounded-3 shadow-sm border"
                             style="width: 120px; height: 120px; object-fit: cover;">
                        <span class="badge position-absolute bottom-0 start-50 translate-middle-x mb-1 px-2 py-1 bg-primary text-white"
                              style="font-size: 0.7rem;">
                                Preview
                        </span>
                    </div>
                </div>
            </div>

            @error('foto')
                <div class="text-danger small mt-1">
                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- NAMA PRODUK (Menggunakan name="name") --}}
    <div class="col-12">
        <div class="p-4 form-card-section">
            <label class="form-label-custom">
                Nama Produk <span class="text-danger">*</span>
            </label>
            <div class="input-group input-group-custom">
                <span class="input-group-text"><i class="bi bi-box-seam"></i></span>
                <input type="text"
                       name="name"
                       class="form-control form-control-custom @error('name') is-invalid @enderror"
                       placeholder="Contoh: Kopi Susu Gula Aren"
                       value="{{ old('name', $produk->nama ?? '') }}"
                       required>
            </div>
            @error('name')
                <div class="text-danger small mt-1">
                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- KATEGORI / JENIS PRODUK (Menggunakan name="category_id") --}}
    <div class="col-12">
        <div class="p-4 form-card-section">
            <label class="form-label-custom mb-3">
                Jenis Produk <span class="text-danger">*</span>
            </label>

            <div class="row g-3">
                @php
                    $categoriesList = isset($categories) && count($categories) > 0 ? $categories : collect([
                        (object)['id' => 1, 'nama' => 'Makanan', 'deskripsi' => 'Aneka Makanan'],
                        (object)['id' => 2, 'nama' => 'Minuman', 'deskripsi' => 'Aneka Minuman'],
                        (object)['id' => 3, 'nama' => 'Snack', 'deskripsi' => 'Cemilan & Ringan'],
                        (object)['id' => 4, 'nama' => 'Elektronik', 'deskripsi' => 'Perangkat & Aksesori']
                    ]);
                @endphp

                @foreach($categoriesList as $category)
                    @php
                        $slug = strtolower($category->nama);
                        $foto = match($slug) {
                            'makanan' => 'makanan.jpg',
                            'minuman' => 'minuman.jpg',
                            'snack' => 'snack.jpg',
                            'elektronik' => 'elektronik.jpg',
                            default => 'default.jpg',
                        };
                        $catId = 'cat_radio_' . $category->id;
                    @endphp

                    <div class="col-md-6 col-lg-3">
                        <div class="category-card">
                            <input
                                type="radio"
                                name="category_id"
                                id="{{ $catId }}"
                                value="{{ $category->id }}"
                                {{ old('category_id', $produk->category_id ?? '') == $category->id ? 'checked' : '' }}
                                required
                            >

                            <label for="{{ $catId }}" class="category-content w-100">
                                <img
                                    src="{{ asset('images/categories/'.$foto) }}"
                                    onerror="this.onerror=null; this.src='https://via.placeholder.com/60?text=POS';"
                                    class="category-image border"
                                >

                                <div class="category-text">
                                    <h5>{{ $category->nama }}</h5>
                                    <small>{{ $category->deskripsi ?? 'Kategori Produk' }}</small>
                                </div>

                                <span class="check-circle">
                                    <i class="bi bi-check-lg"></i>
                                </span>
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>

            @error('category_id')
                <div class="text-danger mt-2 small">
                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- HARGA BELI & HARGA JUAL (purchase_price & selling_price) --}}
    <div class="col-md-6">
        <div class="p-4 form-card-section h-100">
            <label class="form-label-custom">
                Harga Beli (Modal) <span class="text-danger">*</span>
            </label>
            <div class="input-group input-group-custom mb-2">
                <span class="input-group-text">Rp</span>
                <input type="number"
                       id="hargaBeli"
                       name="purchase_price"
                       class="form-control form-control-custom @error('purchase_price') is-invalid @enderror"
                       placeholder="0"
                       value="{{ old('purchase_price', $produk->harga_beli ?? '') }}"
                       oninput="hitungskalaku()"
                       required>
            </div>
            @error('purchase_price')
                <div class="text-danger small mt-1">
                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-md-6">
        <div class="p-4 form-card-section h-100">
            <label class="form-label-custom">
                Harga Jual <span class="text-danger">*</span>
            </label>
            <div class="input-group input-group-custom mb-2">
                <span class="input-group-text">Rp</span>
                <input type="number"
                       id="hargaJual"
                       name="selling_price"
                       class="form-control form-control-custom @error('selling_price') is-invalid @enderror"
                       placeholder="0"
                       value="{{ old('selling_price', $produk->harga_jual ?? '') }}"
                       oninput="hitungskalaku()"
                       required>
            </div>

            <div id="marginInfo" class="small fw-semibold mt-2 text-muted">
                Estimasi Profit: <span id="marginValue" class="text-success">Rp 0</span>
            </div>

            @error('selling_price')
                <div class="text-danger small mt-1">
                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- STOK (Menggunakan name="stock") --}}
    <div class="col-12">
        <div class="p-4 form-card-section">
            <label class="form-label-custom">
                Stok Awal / Gudang <span class="text-danger">*</span>
            </label>

            <div class="input-group input-group-custom">
                <span class="input-group-text"><i class="bi bi-stack"></i></span>

                <input type="number"
                       name="stock"
                       class="form-control form-control-custom @error('stock') is-invalid @enderror"
                       placeholder="0"
                       value="{{ old('stock', $produk->stok ?? '') }}"
                       required>

                <span class="input-group-text border-start-0" style="background-color: #f1f5f9 !important; color: #64748b !important;">
                    Unit
                </span>
            </div>
            @error('stock')
                <div class="text-danger small mt-1">
                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- SATUAN --}}
    <div class="col-md-6">
        <div class="p-4 form-card-section">
            <label class="form-label-custom">
                Satuan <span class="text-danger">*</span>
            </label>

            <select name="satuan" class="form-control form-control-custom @error('satuan') is-invalid @enderror" required>
                <option value="">Pilih Satuan</option>
                <option value="pcs" {{ old('satuan', $produk->satuan ?? '') == 'pcs' ? 'selected' : '' }}>PCS</option>
                <option value="kg" {{ old('satuan', $produk->satuan ?? '') == 'kg' ? 'selected' : '' }}>Kg</option>
                <option value="gram" {{ old('satuan', $produk->satuan ?? '') == 'gram' ? 'selected' : '' }}>Gram</option>
                <option value="liter" {{ old('satuan', $produk->satuan ?? '') == 'liter' ? 'selected' : '' }}>Liter</option>
                <option value="botol" {{ old('satuan', $produk->satuan ?? '') == 'botol' ? 'selected' : '' }}>Botol</option>
                <option value="pack" {{ old('satuan', $produk->satuan ?? '') == 'pack' ? 'selected' : '' }}>Pack</option>
            </select>
            @error('satuan')
                <div class="text-danger small mt-1">
                    <i class="bi bi-exclamation-circle me-1"></i> {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    {{-- MINIMUM STOK --}}
    <div class="col-md-6">
        <div class="p-4 form-card-section">
            <label class="form-label-custom">
                Minimum Stok
            </label>

            <input type="number"
                   name="minimum_stok"
                   class="form-control form-control-custom"
                   value="{{ old('minimum_stok', $produk->minimum_stok ?? 0) }}">
        </div>
    </div>

    {{-- DESKRIPSI --}}
    <div class="col-12">
        <div class="p-4 form-card-section">
            <label class="form-label-custom">
                Deskripsi
            </label>

            <textarea name="deskripsi"
                      rows="4"
                      class="form-control form-control-custom"
                      placeholder="Masukkan deskripsi produk...">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
        </div>
    </div>

</div>

{{-- TOMBOL AKSES --}}
<div class="d-flex align-items-center gap-3 mt-4">
    <button type="submit" class="btn btn-gradient-submit d-inline-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill"></i>
        <span>Simpan Produk</span>
    </button>

    <a href="{{ route('produk.index') }}" class="btn btn-soft-secondary d-inline-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i>
        <span>Batal</span>
    </a>
</div>

{{-- JAVASCRIPT --}}
<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const container = document.getElementById('previewContainer');
        const placeholder = document.getElementById('uploadPlaceholder');

        const file = input.files[0];

        if(file && preview && container && placeholder){
            preview.src = URL.createObjectURL(file);
            container.style.display = 'block';
            placeholder.style.display = 'none';
        }
    }

    function hitungskalaku() {
        const beli = parseFloat(document.getElementById('hargaBeli').value) || 0;
        const jual = parseFloat(document.getElementById('hargaJual').value) || 0;
        const profit = jual - beli;
        const marginElem = document.getElementById('marginValue');

        if (jual > 0) {
            if (profit >= 0) {
                marginElem.className = 'text-success fw-bold';
                marginElem.textContent = 'Rp ' + profit.toLocaleString('id-ID') + ' (Untung)';
            } else {
                marginElem.className = 'text-danger fw-bold';
                marginElem.textContent = 'Rp ' + profit.toLocaleString('id-ID') + ' (Rugi)';
            }
        } else {
            marginElem.className = 'text-muted';
            marginElem.textContent = 'Rp 0';
        }
    }

    document.addEventListener('DOMContentLoaded', hitungskalaku);
</script>