<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Bahan Baku</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="bahan_baku.php">Bahan Baku</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
        <a href="bahan_baku.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="bahan_baku_proses.php" method="POST">
                <input type="hidden" name="aksi" value="tambah">
                
                <div class="mb-3">
                    <label class="form-label">Nama Bahan Baku</label>
                    <input type="text" class="form-control" name="nama_bahan_baku_tenun" required>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Bahan</label>
                        <input type="text" class="form-control" name="jenis_bahan_baku_tenun" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" class="form-control" name="satuan" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga Per Satuan (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="harga_per_satuan" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok Bahan</label>
                        <input type="number" step="0.01" class="form-control" name="stok_bahan" min="0" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pemasok</label>
                    <select class="form-select" name="id_pemasok">
                        <option value="">-- Pilih Pemasok --</option>
                        <?php
                        $sql_pemasok = "SELECT * FROM pemasok_tenun ORDER BY nama_pemasok_tenun ASC";
                        $result_pemasok = $conn->query($sql_pemasok);
                        while($p = $result_pemasok->fetch_assoc()) {
                            echo "<option value='".$p['id_pemasok']."'>".$p['nama_pemasok_tenun']."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
