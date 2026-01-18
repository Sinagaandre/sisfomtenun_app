<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Manajemen Data Penulis</h2>
            <p class="text-muted">Kelola informasi akademik pembuat karya tulis ilmiah.</p>
        </div>
        <a href="penulis_tambah.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Penulis
        </a>
    </div>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> Data berhasil diperbarui!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } elseif ($_GET['status'] == 'deleted') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-trash-alt me-2"></i> Data berhasil dihapus!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } elseif ($_GET['status'] == 'error') {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> Terjadi kesalahan!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }
    }
    ?>

    <div class="row">
        <?php
        $sql = "SELECT * FROM tentang_penulis ORDER BY id DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $foto_src = !empty($row['foto']) ? "assets/img/penulis/" . $row['foto'] : "assets/img/no-profile.png";
                if (!file_exists($foto_src) && !empty($row['foto'])) {
                    // Fallback to general assets if not in specific folder
                    if (file_exists("assets/img/" . $row['foto'])) {
                        $foto_src = "assets/img/" . $row['foto'];
                    }
                }
        ?>
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm border-0 h-100" style="border-radius: 20px; overflow: hidden; transition: transform 0.3s;">
                <div class="bg-primary p-4 text-center" style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);">
                    <div class="rounded-circle bg-white p-1 mx-auto shadow-sm" style="width: 120px; height: 120px; overflow: hidden;">
                        <img src="<?php echo $foto_src; ?>" class="rounded-circle w-100 h-100" style="object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($row['nama']); ?>&background=random'">
                    </div>
                </div>
                <div class="card-body">
                    <h5 class="fw-bold text-center mb-1"><?php echo htmlspecialchars($row['nama']); ?></h5>
                    <p class="text-muted text-center small mb-3">NIM: <?php echo htmlspecialchars($row['nim']); ?></p>
                    
                    <ul class="list-group list-group-flush small">
                        <li class="list-group-item d-flex align-items-center bg-transparent px-0">
                            <i class="fas fa-university text-primary me-3" style="width: 20px;"></i>
                            <span><?php echo htmlspecialchars($row['universitas']); ?></span>
                        </li>
                        <li class="list-group-item d-flex align-items-center bg-transparent px-0">
                            <i class="fas fa-graduation-cap text-success me-3" style="width: 20px;"></i>
                            <span><?php echo htmlspecialchars($row['prodi']); ?></span>
                        </li>
                        <li class="list-group-item d-flex align-items-center bg-transparent px-0">
                            <i class="fas fa-calendar-alt text-warning me-3" style="width: 20px;"></i>
                            <span>Stambuk <?php echo htmlspecialchars($row['stambuk']); ?></span>
                        </li>
                        <li class="list-group-item bg-transparent px-0 mt-2">
                            <small class="text-muted d-block mb-1">Judul Karya Tulis:</small>
                            <span class="fw-bold text-primary"><?php echo htmlspecialchars($row['judul_karya']); ?></span>
                        </li>
                    </ul>

                    <div class="d-flex gap-2 mt-4">
                        <a href="penulis_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm flex-fill">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>
                        <a href="penulis_proses.php?aksi=hapus&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm flex-fill" onclick="return confirm('Yakin ingin menghapus data penulis ini?')">
                            <i class="fas fa-trash me-1"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        } else {
            echo '<div class="col-12 text-center py-5">
                    <i class="fas fa-user-slash fa-4x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada data penulis.</p>
                  </div>';
        }
        ?>
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-5px);
}
</style>

<?php include 'footer.php'; ?>
