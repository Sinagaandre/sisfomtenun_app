<?php
include 'config.php';
include 'header.php';

if (!isset($_GET['id'])) {
    header("Location: penulis.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM tentang_penulis WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: penulis.php");
    exit;
}

$row = $result->fetch_assoc();
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Edit Data Penulis</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="penulis.php">Data Penulis</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                <input type="hidden" name="aksi" value="edit">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">NIM</label>
                        <input type="text" class="form-control" name="nim" value="<?php echo htmlspecialchars($row['nim']); ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Program Studi</label>
                        <input type="text" class="form-control" name="prodi" value="<?php echo htmlspecialchars($row['prodi']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Universitas</label>
                        <input type="text" class="form-control" name="universitas" value="<?php echo htmlspecialchars($row['universitas']); ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Stambuk / Angkatan</label>
                        <input type="text" class="form-control" name="stambuk" value="<?php echo htmlspecialchars($row['stambuk']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Update Foto Profil</label>
                        <input type="file" class="form-control" name="foto" accept="image/*">
                        <?php if ($row['foto']): ?>
                            <div class="mt-2">
                                <small class="text-muted d-block mb-1">Foto saat ini:</small>
                                <img src="assets/img/penulis/<?php echo $row['foto']; ?>" class="img-thumbnail" style="height: 80px;">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Judul Karya Tulis</label>
                    <input type="text" class="form-control" name="judul_karya" value="<?php echo htmlspecialchars($row['judul_karya']); ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Moto Hidup</label>
                    <textarea class="form-control" name="moto" rows="3"><?php echo htmlspecialchars($row['moto']); ?></textarea>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="fas fa-save me-2"></i> Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
