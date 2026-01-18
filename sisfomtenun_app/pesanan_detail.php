<?php
include 'config.php';
include 'header.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan');window.location='pesanan.php';</script>";
    exit;
}

$id = $_GET['id'];

// Get Order Info
$stmt = $conn->prepare("SELECT p.*, c.nama_customers, c.alamat, c.no_telp 
                        FROM pesanan_tenun p 
                        JOIN customers c ON p.id_customers = c.id_customers 
                        WHERE p.id_pesanan = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Data tidak ditemukan');window.location='pesanan.php';</script>";
    exit;
}

$order = $result->fetch_assoc();
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Detail Pesanan #<?php echo $order['id_pesanan']; ?></h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="pesanan.php">Pesanan Tenun</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
        <div class="btn-group">
            <a href="pesanan.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
            <button onclick="window.print()" class="btn btn-outline-secondary">
                <i class="fas fa-print me-2"></i> Cetak
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Informasi Pelanggan</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="100">Nama</th>
                            <td>: <?php echo htmlspecialchars($order['nama_customers']); ?></td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>: <?php echo htmlspecialchars($order['no_telp']); ?></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>: <?php echo nl2br(htmlspecialchars($order['alamat'])); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td>: <?php echo date('d-m-Y', strtotime($order['tanggal_pesanan'])); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>: 
                                <span class="badge <?php echo $order['status_pesanan'] == 'selesai' ? 'bg-success' : 'bg-warning text-dark'; ?>">
                                    <?php echo ucfirst($order['status_pesanan']); ?>
                                </span>
                            </td>
                        </tr>
                    </table>

                    <form action="pesanan_proses.php" method="POST" class="mt-3 no-print">
                        <input type="hidden" name="aksi" value="update_status">
                        <input type="hidden" name="id_pesanan" value="<?php echo $order['id_pesanan']; ?>">
                        <div class="input-group">
                            <select class="form-select" name="status_pesanan">
                                <option value="proses" <?php echo $order['status_pesanan'] == 'proses' ? 'selected' : ''; ?>>Proses</option>
                                <option value="selesai" <?php echo $order['status_pesanan'] == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                            </select>
                            <button class="btn btn-primary" type="submit">Update Status</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Item Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql_detail = "SELECT d.*, p.nama_product 
                                               FROM detail_pesanan_tenun d 
                                               JOIN product_tenun p ON d.id_product = p.id_product 
                                               WHERE d.id_pesanan = ?";
                                $stmt_d = $conn->prepare($sql_detail);
                                $stmt_d->bind_param("i", $id);
                                $stmt_d->execute();
                                $res_d = $stmt_d->get_result();
                                $no = 1;
                                $total_calculated = 0;
                                while($d = $res_d->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$no++."</td>";
                                    echo "<td>".htmlspecialchars($d['nama_product'])."</td>";
                                    echo "<td>Rp ".number_format($d['harga_satuan'],0,',','.')."</td>";
                                    echo "<td>".$d['jumlah']."</td>";
                                    echo "<td>Rp ".number_format($d['subtotal'],0,',','.')."</td>";
                                    echo "</tr>";
                                    $total_calculated += $d['subtotal'];
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" class="text-end">Total Harga</th>
                                    <th>Rp <?php echo number_format($order['total_harga'],0,',','.'); ?></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print, .sidebar, .page-header .btn-group, .footer {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
        width: 100% !important;
    }
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>

<?php include 'footer.php'; ?>
