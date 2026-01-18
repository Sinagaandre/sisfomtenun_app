<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Data Pesanan Tenun</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan Tenun</li>
                </ol>
            </nav>
        </div>
        <a href="pesanan_tambah.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Pesanan
        </a>
    </div>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'success') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> Data berhasil disimpan!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } elseif ($_GET['status'] == 'deleted') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-trash-alt me-2"></i> Data berhasil dihapus!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } elseif ($_GET['status'] == 'updated') {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i> Status pesanan berhasil diperbarui!
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

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">ID Pesanan</th>
                            <th>Tanggal</th>
                            <th>Customer</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT p.*, c.nama_customers 
                                FROM pesanan_tenun p 
                                JOIN customers c ON p.id_customers = c.id_customers 
                                ORDER BY p.id_pesanan DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $status_badge = $row['status_pesanan'] == 'selesai' ? 'bg-success' : 'bg-warning text-dark';
                                echo "<tr>";
                                echo "<td class='ps-4 fw-bold'>#" . $row['id_pesanan'] . "</td>";
                                echo "<td>" . date('d-m-Y', strtotime($row['tanggal_pesanan'])) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama_customers']) . "</td>";
                                echo "<td class='fw-bold text-primary'>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>";
                                echo "<td><span class='badge $status_badge rounded-pill'>" . ucfirst($row['status_pesanan']) . "</span></td>";
                                echo "<td class='text-center pe-4'>
                                        <div class='btn-group' role='group'>
                                            <a href='pesanan_detail.php?id=" . $row['id_pesanan'] . "' class='btn btn-sm btn-outline-info' title='Detail'><i class='fas fa-eye'></i></a>
                                            <a href='konfirmasi.php?id_pesanan=" . $row['id_pesanan'] . "' class='btn btn-sm btn-outline-success' title='Konfirmasi Bayar'><i class='fas fa-money-check-alt'></i></a>
                                            <a href='pesanan_proses.php?aksi=hapus&id=" . $row['id_pesanan'] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Yakin ingin menghapus pesanan ini?\")' title='Hapus'><i class='fas fa-trash'></i></a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4 text-muted'>Tidak ada data pesanan</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
