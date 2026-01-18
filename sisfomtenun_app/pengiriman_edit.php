<?php
include 'config.php';
include 'header.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan');window.location='pengiriman.php';</script>";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM pengiriman_tenun WHERE id_pengiriman = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Data tidak ditemukan');window.location='pengiriman.php';</script>";
    exit;
}

$row = $result->fetch_assoc();
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Edit Pengiriman</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="pengiriman.php">Pengiriman Tenun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                <input type="hidden" name="aksi" value="edit">
                <input type="hidden" name="id_pengiriman" value="<?php echo $row['id_pengiriman']; ?>">
                
                <div class="mb-3">
                    <label class="form-label">Pesanan ID</label>
                    <input type="text" class="form-control" value="#<?php echo $row['id_pesanan']; ?>" readonly disabled>
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
                                $selected = ($m['id_metode'] == $row['id_metode']) ? 'selected' : '';
                                echo "<option value='".$m['id_metode']."' $selected>".$m['nama_metode']." (Rp ".number_format($m['biaya_per_kg'],0,',','.')."/kg)</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Pengiriman</label>
                        <input type="date" class="form-control" name="tanggal_kirim" value="<?php echo $row['tanggal_kirim']; ?>" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">No. Resi</label>
                    <input type="text" class="form-control" name="no_resi" value="<?php echo htmlspecialchars($row['no_resi']); ?>" placeholder="Masukkan nomor resi pengiriman">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status Pengiriman</label>
                    <select class="form-select" name="status_pengiriman" required>
                        <option value="Dikirim" <?php echo ($row['status_pengiriman'] == 'Dikirim') ? 'selected' : ''; ?>>Dikirim</option>
                        <option value="Dalam Perjalanan" <?php echo ($row['status_pengiriman'] == 'Dalam Perjalanan') ? 'selected' : ''; ?>>Dalam Perjalanan</option>
                        <option value="Diterima" <?php echo ($row['status_pengiriman'] == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
