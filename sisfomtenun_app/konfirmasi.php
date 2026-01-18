<?php 
include 'header.php'; 
include 'config.php'; 

$id_konfirmasi = isset($_GET['id']) ? $_GET['id'] : '';
$id_pesanan = isset($_GET['id_pesanan']) ? $_GET['id_pesanan'] : '';
$nama_pengirim = '';
$bank_asal = '';
$total_harga = 0;
$tanggal_bayar = date('Y-m-d');
$catatan = '';
$bukti_bayar = '';
$aksi = 'tambah';
$judul = 'Tambah Konfirmasi';
$subjudul = 'Silakan isi formulir di bawah ini untuk mengonfirmasi pembayaran pesanan Anda.';

if (!empty($id_konfirmasi)) {
    $stmt = $conn->prepare("SELECT * FROM konfirmasi_pembayaran WHERE id_konfirmasi = ?");
    $stmt->bind_param("i", $id_konfirmasi);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $id_pesanan = $row['id_pesanan'];
        $nama_pengirim = $row['nama_pengirim'];
        $bank_asal = $row['bank_asal'];
        $total_harga = $row['jumlah_bayar'];
        $tanggal_bayar = $row['tanggal_bayar'];
        $catatan = $row['catatan'];
        $bukti_bayar = $row['bukti_bayar'];
        $aksi = 'edit';
        $judul = 'Edit Konfirmasi';
        $subjudul = 'Perbarui data konfirmasi pembayaran untuk pesanan #' . $id_pesanan;
    }
} elseif (!empty($id_pesanan)) {
    $stmt = $conn->prepare("SELECT total_harga FROM pesanan_tenun WHERE id_pesanan = ?");
    $stmt->bind_param("i", $id_pesanan);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $total_harga = $row['total_harga'];
    }
}
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0" style="border-radius: 20px;">
            <div class="card-header text-white p-4" style="border-radius: 20px 20px 0 0; background: <?php echo ($aksi == 'edit') ? 'linear-gradient(135deg, #e0a800 0%, #ffc107 100%)' : 'linear-gradient(135deg, #1e7e34 0%, #28a745 100%)'; ?>;">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white p-3 me-3 shadow-sm text-<?php echo ($aksi == 'edit') ? 'warning' : 'success'; ?>">
                        <i class="fas <?php echo ($aksi == 'edit') ? 'fa-edit' : 'fa-check-double'; ?> fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="mb-0 fw-bold"><?php echo $judul; ?></h3>
                        <p class="mb-0 small opacity-75"><?php echo $subjudul; ?></p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4">
                <?php if (isset($_GET['status'])): ?>
                    <?php if ($_GET['status'] == 'error'): ?>
                        <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i> <strong>Gagal!</strong> Terjadi kesalahan saat memproses data. Silakan coba lagi.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif ($_GET['status'] == 'error_file_type'): ?>
                        <div class="alert alert-warning alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
                            <i class="fas fa-file-excel me-2"></i> <strong>Format File Salah!</strong> Hanya file JPG, JPEG, PNG, dan PDF yang diperbolehkan.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif ($_GET['status'] == 'error_upload'): ?>
                        <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
                            <i class="fas fa-upload me-2"></i> <strong>Gagal Upload!</strong> Terjadi kesalahan saat mengunggah bukti pembayaran.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <form action="konfirmasi_proses.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <input type="hidden" name="aksi" value="<?php echo $aksi; ?>">
                    <?php if ($aksi == 'edit'): ?>
                        <input type="hidden" name="id_konfirmasi" value="<?php echo $id_konfirmasi; ?>">
                    <?php endif; ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">ID Pesanan <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-hashtag text-muted"></i></span>
                                <input type="number" name="id_pesanan" class="form-control border-start-0" placeholder="Contoh: 123" value="<?php echo $id_pesanan; ?>" required>
                            </div>
                            <div class="form-text">Masukkan nomor ID Pesanan Anda yang tertera pada nota.</div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Nama Pengirim <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" name="nama_pengirim" class="form-control border-start-0" placeholder="Nama pemilik rekening" value="<?php echo $nama_pengirim; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Bank Asal <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-university text-muted"></i></span>
                                <input type="text" name="bank_asal" class="form-control border-start-0" placeholder="Contoh: BRI, BCA, Mandiri" value="<?php echo $bank_asal; ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Jumlah Bayar (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-money-bill-wave text-muted"></i></span>
                                <input type="number" name="jumlah_bayar" class="form-control border-start-0" placeholder="Masukkan nominal" value="<?php echo $total_harga; ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Tanggal Bayar <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-calendar-alt text-muted"></i></span>
                                <input type="date" name="tanggal_bayar" class="form-control border-start-0" value="<?php echo $tanggal_bayar; ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Bukti Pembayaran <?php echo ($aksi == 'tambah') ? '<span class="text-danger">*</span>' : '(Kosongkan jika tidak diubah)'; ?></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-file-image text-muted"></i></span>
                                <input type="file" name="bukti_bayar" class="form-control border-start-0" accept="image/*" <?php echo ($aksi == 'tambah') ? 'required' : ''; ?>>
                            </div>
                            <div class="form-text text-muted">Format: JPG, PNG, JPEG. Maks 2MB.</div>
                            <?php if ($aksi == 'edit' && !empty($bukti_bayar)): ?>
                                <div class="mt-2">
                                    <small class="text-muted d-block">Bukti saat ini:</small>
                                    <a href="assets/img/konfirmasi/<?php echo $bukti_bayar; ?>" target="_blank" class="btn btn-sm btn-link p-0 text-success fw-bold text-decoration-none">
                                        <i class="fas fa-image me-1"></i> Lihat Bukti Lama
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Catatan Tambahan (Opsional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-sticky-note text-muted"></i></span>
                            <textarea name="catatan" class="form-control border-start-0" rows="3" placeholder="Tuliskan catatan jika ada..."><?php echo $catatan; ?></textarea>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-<?php echo ($aksi == 'edit') ? 'warning' : 'success'; ?> py-3 fw-bold shadow-sm text-white" style="border-radius: 12px;">
                            <i class="fas <?php echo ($aksi == 'edit') ? 'fa-sync-alt' : 'fa-paper-plane'; ?> me-2"></i> 
                            <?php echo ($aksi == 'edit') ? 'Perbarui Konfirmasi' : 'Kirim Konfirmasi'; ?>
                        </button>
                        <a href="konfirmasi_list.php" class="btn btn-light py-3 fw-bold text-muted border-0">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
            
            <div class="card-footer bg-light p-4 text-center border-0" style="border-radius: 0 0 20px 20px;">
                <p class="text-muted small mb-0">
                    <i class="fas fa-info-circle me-1 text-success"></i> Konfirmasi Anda akan diverifikasi oleh tim kami dalam waktu maksimal 1x24 jam.
                </p>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
  'use strict'
  var forms = document.querySelectorAll('.needs-validation')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
})()
</script>

<?php include 'footer.php'; ?>
