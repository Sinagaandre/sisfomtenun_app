<?php include 'header.php'; include 'config.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark"><i class="fas fa-comments text-danger me-2"></i> Daftar Keluhan & Feedback</h2>
    <a href="feedback.php" class="btn btn-danger shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Feedback
    </a>
</div>

<?php if(isset($_GET['status'])): ?>
    <div class="alert alert-<?php echo strpos($_GET['status'], 'success') !== false ? 'success' : 'danger'; ?> alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <?php 
            if($_GET['status'] == 'success_tambah') echo '<i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> Feedback baru telah ditambahkan.';
            elseif($_GET['status'] == 'success_update') echo '<i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> Status feedback telah diperbarui.';
            elseif($_GET['status'] == 'success_hapus') echo '<i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> Feedback telah dihapus.';
            else echo '<i class="fas fa-times-circle me-2"></i> <strong>Gagal!</strong> Terjadi kesalahan sistem.';
        ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0" style="border-radius: 15px;">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="py-3">Customer</th>
                        <th class="py-3">Kategori</th>
                        <th class="py-3">Pesan</th>
                        <th class="py-3">Tanggal</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
                    if ($result->num_rows > 0):
                        while($row = $result->fetch_assoc()):
                            $status_class = 'bg-secondary';
                            if($row['status'] == 'Pending') $status_class = 'bg-warning text-dark';
                            elseif($row['status'] == 'Diproses') $status_class = 'bg-info text-white';
                            elseif($row['status'] == 'Selesai') $status_class = 'bg-success text-white';
                    ?>
                    <tr>
                        <td class="px-4"><?php echo $row['id']; ?></td>
                        <td>
                            <div class="fw-bold"><?php echo htmlspecialchars($row['nama_customer']); ?></div>
                            <div class="small text-muted"><?php echo htmlspecialchars($row['email']); ?></div>
                        </td>
                        <td>
                            <span class="badge rounded-pill bg-light text-dark border">
                                <?php echo htmlspecialchars($row['kategori']); ?>
                            </span>
                        </td>
                        <td>
                            <div class="text-truncate" style="max-width: 200px;" title="<?php echo htmlspecialchars($row['pesan']); ?>">
                                <?php echo htmlspecialchars($row['pesan']); ?>
                            </div>
                        </td>
                        <td><?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?></td>
                        <td>
                            <span class="badge <?php echo $status_class; ?> px-3 py-2">
                                <?php echo $row['status']; ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalStatus<?php echo $row['id']; ?>" title="Update Status">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                                <a href="feedback_proses.php?aksi=hapus&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus feedback ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>

                            <!-- Modal Update Status -->
                            <div class="modal fade" id="modalStatus<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow" style="border-radius: 15px;">
                                        <div class="modal-header bg-primary text-white" style="border-radius: 15px 15px 0 0;">
                                            <h5 class="modal-title fw-bold"><i class="fas fa-edit me-2"></i> Update Status Feedback</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="feedback_proses.php" method="POST">
                                            <div class="modal-body p-4 text-start">
                                                <input type="hidden" name="aksi" value="update_status">
                                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                                
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Pilih Status Baru:</label>
                                                    <select name="status" class="form-select shadow-sm">
                                                        <option value="Pending" <?php if($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                                        <option value="Diproses" <?php if($row['status'] == 'Diproses') echo 'selected'; ?>>Diproses</option>
                                                        <option value="Selesai" <?php if($row['status'] == 'Selesai') echo 'selected'; ?>>Selesai</option>
                                                    </select>
                                                </div>
                                                <p class="small text-muted mb-0">ID Feedback: #<?php echo $row['id']; ?> - <?php echo $row['nama_customer']; ?></p>
                                            </div>
                                            <div class="modal-footer bg-light border-0 p-3" style="border-radius: 0 0 15px 15px;">
                                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary px-4 shadow-sm">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                            Belum ada feedback atau keluhan yang masuk.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
