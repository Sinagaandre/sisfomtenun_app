<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Pengiriman</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="pengiriman.php">Pengiriman Tenun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                </ol>
            </nav>
        </div>
        <a href="pengiriman.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="pengiriman_proses.php" method="POST">
                <input type="hidden" name="aksi" value="tambah">
                
                <div class="mb-3">
                    <label class="form-label">Pilih Pesanan</label>
                    <select class="form-select" name="id_pesanan" required>
                        <option value="">-- Pilih Pesanan --</option>
                        <?php
                        // Only show orders that don't have shipping yet
                        $sql_p = "SELECT p.id_pesanan, c.nama_customers, p.tanggal_pesanan 
                                  FROM pesanan_tenun p 
                                  JOIN customers c ON p.id_customers = c.id_customers
                                  WHERE p.id_pesanan NOT IN (SELECT id_pesanan FROM pengiriman_tenun)
                                  ORDER BY p.id_pesanan DESC";
                        $res_p = $conn->query($sql_p);
                        while($p = $res_p->fetch_assoc()) {
                            echo "<option value='".$p['id_pesanan']."'>Order #".$p['id_pesanan']." - ".$p['nama_customers']." (".date('d/m/Y', strtotime($p['tanggal_pesanan'])).")</option>";
                        }
                        ?>
                    </select>
                    <div class="form-text">Hanya pesanan yang belum dikirim yang muncul di sini.</div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Metode Pengiriman</label>
                        <select class="form-select" name="id_metode" required>
                            <option value="">-- Pilih Metode --</option>
                            <?php
                            $sql_m = "SELECT * FROM metode_pengiriman ORDER BY nama_metode ASC";
                            $res_m = $conn->query($sql_m);
                            while($m = $res_m->fetch_assoc()) {
                                echo "<option value='".$m['id_metode']."'>".$m['nama_metode']." (Rp ".number_format($m['biaya_per_kg'],0,',','.')."/kg)</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Pengiriman</label>
                        <input type="date" class="form-control" name="tanggal_kirim" value="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">No. Resi</label>
                    <input type="text" class="form-control" name="no_resi" placeholder="Masukkan nomor resi pengiriman">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Pengiriman</label>
                    <select class="form-select" name="status_pengiriman" required>
                        <option value="Dikirim">Dikirim</option>
                        <option value="Dalam Perjalanan">Dalam Perjalanan</option>
                        <option value="Diterima">Diterima</option>
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
