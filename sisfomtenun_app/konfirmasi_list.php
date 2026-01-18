<?php include 'header.php'; include 'config.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-dark"><i class="fas fa-check-circle text-success me-2"></i> Daftar Konfirmasi Pembayaran</h2>
    <a href="konfirmasi.php" class="btn btn-success shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Konfirmasi
    </a>
</div>

<?php if(isset($_GET['status'])): ?>
    <div class="alert alert-<?php echo strpos($_GET['status'], 'success') !== false ? 'success' : 'danger'; ?> alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
        <?php 
            if($_GET['status'] == 'success_tambah') echo '<i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> Konfirmasi pembayaran telah dikirim.';
            elseif($_GET['status'] == 'success_update') echo '<i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> Status konfirmasi telah diperbarui.';
            elseif($_GET['status'] == 'success_hapus') echo '<i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> Data konfirmasi telah dihapus.';
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
                        <th class="py-3">Order</th>
                        <th class="py-3">Pengirim</th>
                        <th class="py-3">Bank & Nominal</th>
                        <th class="py-3">Bukti</th>
                        <th class="py-3">Status</th>
                        <th class="py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT k.*, p.total_harga FROM konfirmasi_pembayaran k JOIN pesanan_tenun p ON k.id_pesanan = p.id_pesanan ORDER BY k.created_at DESC");
                    if ($result->num_rows > 0):
                        while($row = $result->fetch_assoc()):
                            $status_class = 'bg-secondary';
                            if($row['status_konfirmasi'] == 'Pending') $status_class = 'bg-warning text-dark';
                            elseif($row['status_konfirmasi'] == 'Valid') $status_class = 'bg-success text-white';
                            elseif($row['status_konfirmasi'] == 'Tidak Valid') $status_class = 'bg-danger text-white';
                    ?>
                    <tr>
                        <td class="px-4"><?php echo $row['id_konfirmasi']; ?></td>
                        <td>
                            <div class="fw-bold">Pesanan #<?php echo $row['id_pesanan']; ?></div>
                            <div class="small text-muted">Total: Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></div>
                        </td>
                        <td>
                            <div class="fw-bold"><?php echo htmlspecialchars($row['nama_pengirim']); ?></div>
                            <div class="small text-muted"><?php echo date('d/m/Y', strtotime($row['tanggal_bayar'])); ?></div>
                        </td>
                        <td>
                            <div class="fw-bold text-primary"><?php echo htmlspecialchars($row['bank_asal']); ?></div>
                            <div class="small text-success fw-bold">Rp <?php echo number_format($row['jumlah_bayar'], 0, ',', '.'); ?></div>
                        </td>
                        <td>
                            <?php if(!empty($row['bukti_bayar'])): ?>
                                <a href="assets/img/konfirmasi/<?php echo $row['bukti_bayar']; ?>" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-image me-1"></i> Lihat
                                </a>
                            <?php else: ?>
                                <span class="text-muted small">Tidak ada</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="badge <?php echo $status_class; ?> px-3 py-2">
                                <?php echo $row['status_konfirmasi']; ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group shadow-sm" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalVerifikasi<?php echo $row['id_konfirmasi']; ?>" title="Verifikasi">
                                    <i class="fas fa-user-check"></i>
                                </button>
                                <a href="konfirmasi_proses.php?aksi=hapus&id=<?php echo $row['id_konfirmasi']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin ingin menghapus data konfirmasi ini?')" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>

                            <!-- Modal Verifikasi -->
                            <div class="modal fade" id="modalVerifikasi<?php echo $row['id_konfirmasi']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow" style="border-radius: 15px;">
                                        <div class="modal-header bg-success text-white" style="border-radius: 15px 15px 0 0;">
                                            <h5 class="modal-title fw-bold"><i class="fas fa-check-double me-2"></i> Verifikasi Pembayaran</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="konfirmasi_proses.php" method="POST">
                                            <div class="modal-body p-4 text-start">
                                                <input type="hidden" name="aksi" value="update_status">
                                                <input type="hidden" name="id_konfirmasi" value="<?php echo $row['id_konfirmasi']; ?>">
                                                <input type="hidden" name="id_pesanan" value="<?php echo $row['id_pesanan']; ?>">
                                                
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Ubah Status Pembayaran:</label>
                                                    <select name="status_konfirmasi" class="form-select shadow-sm">
                                                        <option value="Pending" <?php if($row['status_konfirmasi'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                                        <option value="Valid" <?php if($row['status_konfirmasi'] == 'Valid') echo 'selected'; ?>>Valid (Pesanan Selesai)</option>
                                                        <option value="Tidak Valid" <?php if($row['status_konfirmasi'] == 'Tidak Valid') echo 'selected'; ?>>Tidak Valid (Ditolak)</option>
                                                    </select>
                                                </div>
                                                <div class="p-3 bg-light rounded small">
                                                    <p class="mb-1"><strong>Detail Pengiriman:</strong> <?php echo $row['nama_pengirim']; ?> (<?php echo $row['bank_asal']; ?>)</p>
                                                    <p class="mb-0"><strong>Nominal:</strong> Rp <?php echo number_format($row['jumlah_bayar'], 0, ',', '.'); ?></p>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light border-0 p-3" style="border-radius: 0 0 15px 15px;">
                                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success px-4 shadow-sm">Simpan Verifikasi</button>
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
                            <i class="fas fa-receipt fa-3x mb-3 d-block"></i>
                            Belum ada konfirmasi pembayaran yang masuk.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
