<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Data Bahan Baku Tenun</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Bahan Baku Tenun</li>
                </ol>
            </nav>
        </div>
        <a href="bahan_baku_tambah.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Bahan Baku
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
                            <th class="ps-4">No</th>
                            <th>Nama Bahan</th>
                            <th>Jenis</th>
                            <th>Satuan</th>
                            <th>Harga/Satuan</th>
                            <th>Stok</th>
                            <th>Pemasok</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT b.*, p.nama_pemasok_tenun 
                                FROM bahan_baku_tenun b 
                                LEFT JOIN pemasok_tenun p ON b.id_pemasok = p.id_pemasok 
                                ORDER BY b.id_bahan_baku DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='ps-4'>" . $no++ . "</td>";
                                echo "<td class='fw-bold'>" . htmlspecialchars($row['nama_bahan_baku_tenun']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['jenis_bahan_baku_tenun']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['satuan']) . "</td>";
                                echo "<td>Rp " . number_format($row['harga_per_satuan'], 0, ',', '.') . "</td>";
                                echo "<td><span class='badge bg-info text-dark'>" . $row['stok_bahan'] . "</span></td>";
                                echo "<td>" . ($row['nama_pemasok_tenun'] ? htmlspecialchars($row['nama_pemasok_tenun']) : '-') . "</td>";
                                echo "<td class='text-center pe-4'>
                                        <div class='btn-group' role='group'>
                                            <a href='bahan_baku_edit.php?id=" . $row['id_bahan_baku'] . "' class='btn btn-sm btn-outline-warning' title='Edit'><i class='fas fa-edit'></i></a>
                                            <a href='bahan_baku_proses.php?aksi=hapus&id=" . $row['id_bahan_baku'] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' title='Hapus'><i class='fas fa-trash'></i></a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='text-center py-4 text-muted'>Tidak ada data bahan baku</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
