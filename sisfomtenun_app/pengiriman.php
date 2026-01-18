<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Data Pengiriman Tenun</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengiriman Tenun</li>
                </ol>
            </nav>
        </div>
        <a href="pengiriman_tambah.php" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Tambah Pengiriman
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
                    <i class="fas fa-check-circle me-2"></i> Status pengiriman berhasil diperbarui!
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
                            <th class="ps-4">ID</th>
                            <th>No Resi</th>
                            <th>Pesanan ID</th>
                            <th>Tanggal Kirim</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT p.*, pe.id_pesanan, m.nama_metode 
                                FROM pengiriman_tenun p 
                                JOIN pesanan_tenun pe ON p.id_pesanan = pe.id_pesanan 
                                JOIN metode_pengiriman m ON p.id_metode = m.id_metode 
                                ORDER BY p.id_pengiriman DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                $status_badge = 'bg-secondary';
                                if ($row['status_pengiriman'] == 'dikirim') $status_badge = 'bg-info text-dark';
                                if ($row['status_pengiriman'] == 'diterima') $status_badge = 'bg-success';
                                
                                echo "<tr>";
                                echo "<td class='ps-4'>#" . $row['id_pengiriman'] . "</td>";
                                echo "<td class='fw-bold'>" . htmlspecialchars($row['no_resi']) . "</td>";
                                echo "<td><a href='pesanan_detail.php?id=" . $row['id_pesanan'] . "' class='text-decoration-none'>#" . $row['id_pesanan'] . "</a></td>";
                                echo "<td>" . date('d-m-Y', strtotime($row['tanggal_kirim'])) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama_metode']) . "</td>";
                                echo "<td><span class='badge $status_badge rounded-pill'>" . ucfirst($row['status_pengiriman']) . "</span></td>";
                                echo "<td class='text-center pe-4'>
                                        <div class='btn-group' role='group'>
                                            <a href='pengiriman_edit.php?id=" . $row['id_pengiriman'] . "' class='btn btn-sm btn-outline-warning' title='Edit'><i class='fas fa-edit'></i></a>
                                            <a href='pengiriman_proses.php?aksi=hapus&id=" . $row['id_pengiriman'] . "' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"Yakin ingin menghapus data ini?\")' title='Hapus'><i class='fas fa-trash'></i></a>
                                        </div>
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center py-4 text-muted'>Tidak ada data pengiriman</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
