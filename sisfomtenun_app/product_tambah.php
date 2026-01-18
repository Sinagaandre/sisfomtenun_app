<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Produk Tenun</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="product.php">Produk Tenun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
        <a href="product.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="product_proses.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="aksi" value="tambah">
                
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_product" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Foto Produk</label>
                        <input type="file" class="form-control" name="gambar" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, WEBP (Maks. 2MB)</small>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kain</label>
                        <input type="text" class="form-control" name="jenis_kain" placeholder="Contoh: Katun, Sutra" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Motif</label>
                        <input type="text" class="form-control" name="motif" placeholder="Contoh: Ikat, Songket" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warna</label>
                        <input type="text" class="form-control" name="warna" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ukuran</label>
                        <input type="text" class="form-control" name="ukuran" placeholder="Contoh: 200x150 cm" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="harga" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" min="0" required>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
