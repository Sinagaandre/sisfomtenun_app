<?php 
include 'header.php'; 
include 'config.php'; 

$id_pesanan = isset($_GET['id_pesanan']) ? $_GET['id_pesanan'] : '';
$total_harga = 0;

if (!empty($id_pesanan)) {
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
            <div class="card-header bg-success text-white p-4" style="border-radius: 20px 20px 0 0; background: linear-gradient(135deg, #1e7e34 0%, #28a745 100%);">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white text-success p-3 me-3 shadow-sm">
                        <i class="fas fa-check-double fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="mb-0 fw-bold">Konfirmasi Pembayaran</h3>
                        <p class="mb-0 small opacity-75">Silakan isi formulir di bawah ini untuk mengonfirmasi pembayaran pesanan Anda.</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="konfirmasi_proses.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                    <input type="hidden" name="aksi" value="tambah">
                    
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
                                <input type="text" name="nama_pengirim" class="form-control border-start-0" placeholder="Nama pemilik rekening" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Bank Asal <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-university text-muted"></i></span>
                                <input type="text" name="bank_asal" class="form-control border-start-0" placeholder="Contoh: BRI, BCA, Mandiri" required>
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
                                <input type="date" name="tanggal_bayar" class="form-control border-start-0" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Bukti Pembayaran <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-file-image text-muted"></i></span>
                                <input type="file" name="bukti_bayar" class="form-control border-start-0" accept="image/*" required>
                            </div>
                            <div class="form-text text-muted">Format: JPG, PNG, JPEG. Maks 2MB.</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Catatan Tambahan (Opsional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-sticky-note text-muted"></i></span>
                            <textarea name="catatan" class="form-control border-start-0" rows="3" placeholder="Tuliskan catatan jika ada..."></textarea>
                        </div>
                    </div>

                    <div class="alert alert-info border-0 shadow-sm mb-4" style="border-radius: 10px;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-info-circle fa-2x me-3 text-info"></i>
                            <div class="small">
                                Dengan menekan tombol <strong>Kirim Konfirmasi</strong>, Anda menyatakan bahwa data pembayaran yang Anda masukkan adalah benar dan valid.
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="pesanan.php" class="btn btn-light px-4">
                            <i class="fas fa-arrow-left me-2"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-success px-5 shadow-sm" style="background: linear-gradient(135deg, #1e7e34 0%, #28a745 100%);">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="card-footer bg-light p-4 text-center" style="border-radius: 0 0 20px 20px;">
                <p class="text-muted small mb-0">
                    <i class="fas fa-graduation-cap me-2"></i> Implementasi Modul Verifikasi Status: 
                    <strong>"Sistem Informasi Pemasaran Produk Tenun Berbasis Web"</strong>
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
