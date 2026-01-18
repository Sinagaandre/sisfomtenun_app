<?php
include 'config.php';
include 'header.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan');window.location='pemasok.php';</script>";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM pemasok_tenun WHERE id_pemasok = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Data tidak ditemukan');window.location='pemasok.php';</script>";
    exit;
}

$row = $result->fetch_assoc();
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Edit Pemasok</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="pemasok.php">Pemasok Tenun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <a href="pemasok.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="pemasok_proses.php" method="POST">
                <input type="hidden" name="aksi" value="edit">
                <input type="hidden" name="id_pemasok" value="<?php echo $row['id_pemasok']; ?>">
                
                <div class="mb-3">
                    <label class="form-label">Nama Pemasok</label>
                    <input type="text" class="form-control" name="nama_pemasok_tenun" value="<?php echo htmlspecialchars($row['nama_pemasok_tenun']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat_pemasok_tenun" rows="3" required><?php echo htmlspecialchars($row['alamat_pemasok_tenun']); ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Kontak (HP/Telp)</label>
                        <input type="text" class="form-control" name="kontak_pemasok_tenun" value="<?php echo htmlspecialchars($row['kontak_pemasok_tenun']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email_pemasok_tenun" value="<?php echo htmlspecialchars($row['email_pemasok_tenun']); ?>" required>
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
