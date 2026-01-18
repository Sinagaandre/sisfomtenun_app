<?php
include 'config.php';
include 'header.php';
?>

<style>
    .ship-card {
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        overflow: hidden;
    }
    .ship-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        border-color: #007bff;
    }
    .ship-icon-wrapper {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.5rem;
    }
    .price-tag {
        font-size: 1.1rem;
        font-weight: 700;
        color: #ee4d2d; /* Shopee Orange */
    }
    .marketplace-badge {
        font-size: 0.75rem;
        padding: 4px 10px;
        border-radius: 20px;
        font-weight: 600;
    }
</style>

<div class="fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">Metode Pengiriman</h2>
            <p class="text-muted small">Kelola opsi ekspedisi pengiriman produk tenun Anda</p>
        </div>
        <a href="metode_pengiriman_tambah.php" class="btn btn-primary px-4 shadow-sm" style="border-radius: 10px;">
            <i class="fas fa-plus me-2"></i> Tambah Ekspedisi
        </a>
    </div>

    <?php if (isset($_GET['status'])): ?>
        <div class="alert alert-<?php echo ($_GET['status'] == 'error') ? 'danger' : 'success'; ?> alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 10px;">
            <div class="d-flex align-items-center">
                <i class="fas <?php 
                    if($_GET['status'] == 'success') echo 'fa-check-circle';
                    elseif($_GET['status'] == 'deleted') echo 'fa-trash-alt';
                    elseif($_GET['status'] == 'updated') echo 'fa-sync-alt';
                    else echo 'fa-exclamation-circle';
                ?> me-2 fs-5"></i>
                <div>
                    <?php 
                        if($_GET['status'] == 'success') echo 'Ekspedisi baru berhasil ditambahkan!';
                        elseif($_GET['status'] == 'deleted') echo 'Ekspedisi telah berhasil dihapus.';
                        elseif($_GET['status'] == 'updated') echo 'Data ekspedisi berhasil diperbarui.';
                        else echo 'Terjadi kesalahan sistem.';
                    ?>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <?php
        $sql = "SELECT * FROM metode_pengiriman ORDER BY id_metode ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $icon = 'fa-truck';
                $bg_color = 'bg-primary';
                $label = 'Reguler';
                
                if(stripos($row['nama_metode'], 'JNE') !== false) {
                    $icon = 'fa-shipping-fast';
                    $bg_color = 'bg-danger';
                } elseif(stripos($row['nama_metode'], 'Pos') !== false) {
                    $icon = 'fa-mail-bulk';
                    $bg_color = 'bg-warning';
                } elseif(stripos($row['nama_metode'], 'Express') !== false || stripos($row['nama_metode'], 'Kilat') !== false) {
                    $icon = 'fa-bolt';
                    $bg_color = 'bg-info';
                    $label = 'Express';
                }
        ?>
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 ship-card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div class="ship-icon-wrapper <?php echo $bg_color; ?> bg-opacity-10 text-<?php echo str_replace('bg-', '', $bg_color); ?>">
                            <i class="fas <?php echo $icon; ?>"></i>
                        </div>
                        <span class="marketplace-badge <?php echo $bg_color; ?> bg-opacity-10 text-<?php echo str_replace('bg-', '', $bg_color); ?>">
                            <?php echo $label; ?>
                        </span>
                    </div>
                    
                    <h5 class="fw-bold mb-1 text-dark"><?php echo htmlspecialchars($row['nama_metode']); ?></h5>
                    <p class="text-muted small mb-3"><i class="far fa-clock me-1"></i> Estimasi: <?php echo $row['estimasi_hari']; ?> Hari Kerja</p>
                    
                    <div class="d-flex align-items-center justify-content-between pt-3 border-top">
                        <div>
                            <span class="text-muted small d-block">Biaya per KG</span>
                            <span class="price-tag">Rp <?php echo number_format($row['biaya_per_kg'], 0, ',', '.'); ?></span>
                        </div>
                        <div class="btn-group">
                            <a href="metode_pengiriman_edit.php?id=<?php echo $row['id_metode']; ?>" class="btn btn-sm btn-light border shadow-sm" style="border-radius: 8px 0 0 8px;">
                                <i class="fas fa-edit text-warning"></i>
                            </a>
                            <a href="metode_pengiriman_proses.php?aksi=hapus&id=<?php echo $row['id_metode']; ?>" class="btn btn-sm btn-light border shadow-sm" onclick="return confirm('Hapus ekspedisi ini?')" style="border-radius: 0 8px 8px 0;">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
        ?>
        <div class="col-12 text-center py-5">
            <div class="bg-light d-inline-block p-4 rounded-circle mb-3">
                <i class="fas fa-truck-loading fa-3x text-muted"></i>
            </div>
            <h5 class="text-muted">Belum ada metode pengiriman</h5>
            <p class="text-muted small">Klik tombol "Tambah Ekspedisi" untuk memulai.</p>
        </div>
        <?php } ?>
    </div>
</div>

<?php include 'footer.php'; ?>
