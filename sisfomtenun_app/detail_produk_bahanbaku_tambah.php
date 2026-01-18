<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Detail Produk Bahan Baku</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="detail_produk_bahanbaku.php">Detail Produk Bahan Baku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
        <a href="detail_produk_bahanbaku.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="detail_produk_bahanbaku_proses.php" method="POST">
                <input type="hidden" name="aksi" value="tambah">
                
                <div class="mb-3">
                    <label class="form-label">Produk</label>
                    <select class="form-select" name="id_product" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php
                        $sql_p = "SELECT * FROM product_tenun ORDER BY nama_product ASC";
                        $res_p = $conn->query($sql_p);
                        while($p = $res_p->fetch_assoc()) {
                            echo "<option value='".$p['id_product']."'>".$p['nama_product']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bahan Baku</label>
                    <select class="form-select" name="id_bahan_baku" required>
                        <option value="">-- Pilih Bahan Baku --</option>
                        <?php
                        $sql_b = "SELECT * FROM bahan_baku_tenun ORDER BY nama_bahan_baku_tenun ASC";
                        $res_b = $conn->query($sql_b);
                        while($b = $res_b->fetch_assoc()) {
                            echo "<option value='".$b['id_bahan_baku']."'>".$b['nama_bahan_baku_tenun']." (".$b['satuan'].")</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Jumlah Digunakan</label>
                    <input type="number" step="0.01" class="form-control" name="jumlah_digunakan" min="0" required>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
