<?php
include 'config.php';
include 'header.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan');window.location='product.php';</script>";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM product_tenun WHERE id_product = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Data tidak ditemukan');window.location='product.php';</script>";
    exit;
}

$row = $result->fetch_assoc();
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Edit Produk Tenun</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="product.php">Produk Tenun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                <input type="hidden" name="aksi" value="edit">
                <input type="hidden" name="id_product" value="<?php echo $row['id_product']; ?>">
                
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_product" value="<?php echo htmlspecialchars($row['nama_product']); ?>" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Update Foto Produk</label>
                        <input type="file" class="form-control" name="gambar" accept="image/*">
                        <?php if ($row['gambar']): ?>
                            <div class="mt-2">
                                <small class="text-muted d-block mb-1">Foto saat ini:</small>
                                <img src="assets/img/produk/<?php echo $row['gambar']; ?>" class="img-thumbnail" style="height: 80px;">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jenis Kain</label>
                        <input type="text" class="form-control" name="jenis_kain" value="<?php echo htmlspecialchars($row['jenis_kain']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Motif</label>
                        <input type="text" class="form-control" name="motif" value="<?php echo htmlspecialchars($row['motif']); ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Warna</label>
                        <input type="text" class="form-control" name="warna" value="<?php echo htmlspecialchars($row['warna']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Ukuran</label>
                        <input type="text" class="form-control" name="ukuran" value="<?php echo htmlspecialchars($row['ukuran']); ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="harga" value="<?php echo $row['harga']; ?>" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok</label>
                        <input type="number" class="form-control" name="stok" value="<?php echo $row['stok']; ?>" min="0" required>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
