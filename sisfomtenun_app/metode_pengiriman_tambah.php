<?php
include 'config.php';
include 'header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-header bg-primary text-white p-4" style="border-radius: 20px 20px 0 0; background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white text-primary p-3 me-3 shadow-sm" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-truck-loading fa-lg"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold">Tambah Ekspedisi</h4>
                        <p class="mb-0 small opacity-75">Daftarkan jasa pengiriman baru ke sistem</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="metode_pengiriman_proses.php" method="POST" class="needs-validation" novalidate>
                    <input type="hidden" name="aksi" value="tambah">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary small text-uppercase">Nama Ekspedisi <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-shipping-fast"></i></span>
                            <input type="text" name="nama_metode" class="form-control border-start-0 py-2" placeholder="Contoh: JNE Reguler, J&T Express" required>
                        </div>
                        <div class="invalid-feedback">Nama ekspedisi wajib diisi.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Biaya per KG (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-tag"></i></span>
                                <input type="number" name="biaya_per_kg" class="form-control border-start-0 py-2" placeholder="Nominal angka" required>
                            </div>
                            <div class="invalid-feedback">Biaya per KG wajib diisi.</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Estimasi (Hari) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-clock"></i></span>
                                <input type="text" name="estimasi_hari" class="form-control border-start-0 py-2" placeholder="Contoh: 2-3" required>
                            </div>
                            <div class="invalid-feedback">Estimasi hari wajib diisi.</div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary py-3 fw-bold shadow-sm" style="border-radius: 12px;">
                            <i class="fas fa-save me-2"></i> Simpan Ekspedisi
                        </button>
                        <a href="metode_pengiriman.php" class="btn btn-light py-3 fw-bold text-muted border-0">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
            
            <div class="card-footer bg-light p-4 text-center border-0" style="border-radius: 0 0 20px 20px;">
                <p class="text-muted small mb-0">
                    <i class="fas fa-info-circle me-1 text-primary"></i> Data ini akan tampil sebagai opsi pengiriman di halaman checkout.
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
