<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Data Pemasok Tenun</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pemasok Tenun</li>
                </ol>
            </nav>
        </div>
        <a href="pemasok_tambah.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Pemasok
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
                            <th>Nama Pemasok</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Email</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM pemasok_tenun ORDER BY id_pemasok DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            $no = 1;
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td class='ps-4'>" . $no++ . "</td>";
                                echo "<td class='fw-bold'>" . htmlspecialchars($row['nama_pemasok_tenun']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['alamat_pemasok_tenun']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['kontak_pemasok_tenun']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email_pemasok_tenun']) . "</td>";
                                echo "<td class='text-center pe-4'>
                                        <div class='btn-group' role='group'>
                                            <a href='pemasok_edit.php?id=" . $row['id_pemasok'] . "' class='btn btn-sm btn-outline-warning' title='Edit'><i class='fas fa-edit'></i></a>
                                            <a href='pemasok_proses.php?aksi=hapus&id=" . $row['id_pemasok'] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' title='Hapus'><i class='fas fa-trash'></i></a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center py-4 text-muted'>Tidak ada data pemasok</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
