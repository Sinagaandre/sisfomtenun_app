<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Data Detail Bahan Baku Produk</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Bahan Baku</li>
                </ol>
            </nav>
        </div>
        <a href="detail_produk_bahanbaku_tambah.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Detail
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
                            <th>Produk</th>
                            <th>Bahan Baku</th>
                            <th>Jumlah Digunakan</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT d.*, p.nama_product, b.nama_bahan_baku_tenun, b.satuan
                                FROM detail_produk_bahanbaku d
                                LEFT JOIN product_tenun p ON d.id_product = p.id_product
                                LEFT JOIN bahan_baku_tenun b ON d.id_bahan_baku = b.id_bahan_baku
                                ORDER BY d.id_detail_produk_bahanbaku DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='ps-4'>" . $no++ . "</td>";
                                echo "<td class='fw-bold'>" . htmlspecialchars($row['nama_product']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama_bahan_baku_tenun']) . "</td>";
                                echo "<td>" . $row['jumlah_digunakan'] . " " . htmlspecialchars($row['satuan']) . "</td>";
                                echo "<td class='text-center pe-4'>
                                        <div class='btn-group' role='group'>
                                            <a href='detail_produk_bahanbaku_edit.php?id=" . $row['id_detail_produk_bahanbaku'] . "' class='btn btn-sm btn-outline-warning' title='Edit'><i class='fas fa-edit'></i></a>
                                            <a href='detail_produk_bahanbaku_proses.php?aksi=hapus&id=" . $row['id_detail_produk_bahanbaku'] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' title='Hapus'><i class='fas fa-trash'></i></a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center py-4 text-muted'>Tidak ada data detail</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
