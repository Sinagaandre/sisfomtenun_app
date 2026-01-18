<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Data Produk Tenun</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk Tenun</li>
                </ol>
            </nav>
        </div>
        <a href="product_tambah.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Produk
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
                            <th>Foto</th>
                            <th>Nama Produk</th>
                            <th>Jenis Kain</th>
                            <th>Motif</th>
                            <th>Warna</th>
                            <th>Ukuran</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM product_tenun ORDER BY id_product DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while($row = $result->fetch_assoc()) {
                                $img_html = !empty($row['gambar']) 
                                    ? "<img src='assets/img/produk/" . $row['gambar'] . "' class='rounded shadow-sm' style='width: 50px; height: 50px; object-fit: cover; border: 1px solid #dee2e6;'>" 
                                    : "<div class='rounded bg-light d-flex align-items-center justify-content-center border' style='width: 50px; height: 50px;'><i class='fas fa-image text-muted'></i></div>";
                                echo "<tr>";
                                echo "<td class='ps-4 align-middle'>" . $no++ . "</td>";
                                echo "<td class='align-middle'>$img_html</td>";
                                echo "<td class='fw-bold align-middle'>" . htmlspecialchars($row['nama_product']) . "</td>";
                                echo "<td class='align-middle'>" . htmlspecialchars($row['jenis_kain']) . "</td>";
                                echo "<td class='align-middle'>" . htmlspecialchars($row['motif']) . "</td>";
                                echo "<td class='align-middle'>" . htmlspecialchars($row['warna']) . "</td>";
                                echo "<td class='align-middle'>" . htmlspecialchars($row['ukuran']) . "</td>";
                                echo "<td class='align-middle'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>";
                                echo "<td class='align-middle'><span class='badge bg-info text-dark'>" . $row['stok'] . "</span></td>";
                                echo "<td class='text-center pe-4 align-middle'>
                                        <div class='btn-group' role='group'>
                                            <a href='product_edit.php?id=" . $row['id_product'] . "' class='btn btn-sm btn-outline-warning' title='Edit'><i class='fas fa-edit'></i></a>
                                            <a href='product_proses.php?aksi=hapus&id=" . $row['id_product'] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' title='Hapus'><i class='fas fa-trash'></i></a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='text-center py-4 text-muted'>Tidak ada data produk</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
