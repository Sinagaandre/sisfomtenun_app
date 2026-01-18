<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Tambah Data Penulis</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="penulis.php">Data Penulis</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
        <a href="penulis.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0" style="border-radius: 20px;">
        <div class="card-body p-4">
            <form action="penulis_proses.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="tambah">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">NIM</label>
                        <input type="text" class="form-control" name="nim" placeholder="Masukkan NIM" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Program Studi</label>
                        <input type="text" class="form-control" name="prodi" placeholder="Contoh: Teknik Informatika (D3)" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Universitas</label>
                        <input type="text" class="form-control" name="universitas" placeholder="Masukkan nama universitas" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Stambuk / Angkatan</label>
                        <input type="text" class="form-control" name="stambuk" placeholder="Contoh: 2022" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Foto Profil</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, WEBP (Maks. 2MB)</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Karya Tulis</label>
                    <input type="text" class="form-control" name="judul_karya" placeholder="Masukkan judul karya tulis ilmiah" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Moto Hidup</label>
                    <textarea class="form-control" name="moto" rows="3" placeholder="Masukkan moto hidup singkat..."></textarea>
                </div>

                <div class="text-end">
                    <button type="reset" class="btn btn-light px-4 me-2">Reset</button>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-save me-2"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
