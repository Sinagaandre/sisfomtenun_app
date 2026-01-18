<?php
include 'config.php';
include 'header.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan');window.location='customers.php';</script>";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM customers WHERE id_customers = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Data tidak ditemukan');window.location='customers.php';</script>";
    exit;
}

$row = $result->fetch_assoc();
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Edit Customer</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="customers.php">Customers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <a href="customers.php" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="customers_proses.php" method="POST">
                <input type="hidden" name="aksi" value="edit">
                <input type="hidden" name="id_customers" value="<?php echo $row['id_customers']; ?>">
                
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_customers" value="<?php echo htmlspecialchars($row['nama_customers']); ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" rows="3" required><?php echo htmlspecialchars($row['alamat']); ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" class="form-control" name="no_telepon" value="<?php echo htmlspecialchars($row['no_telepon']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
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
