<?php include 'header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-lg border-0" style="border-radius: 20px;">
            <div class="card-header bg-danger text-white p-4" style="border-radius: 20px 20px 0 0; background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white text-danger p-3 me-3 shadow-sm">
                        <i class="fas fa-exclamation-triangle fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="mb-0 fw-bold">Feedback & Keluhan Sistem</h3>
                        <p class="mb-0 small opacity-75">Sampaikan keluhan atau saran Anda untuk pengembangan sistem yang lebih baik.</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4">
                <?php if(isset($_GET['status'])): ?>
                    <?php if($_GET['status'] == 'success'): ?>
                        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="fas fa-check-circle me-2"></i> <strong>Berhasil!</strong> Feedback Anda telah terkirim dan akan segera kami tindak lanjuti.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php elseif($_GET['status'] == 'error'): ?>
                        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                            <i class="fas fa-times-circle me-2"></i> <strong>Gagal!</strong> Terjadi kesalahan saat mengirim feedback. Silakan coba lagi.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

                <form action="feedback_proses.php" method="POST" class="needs-validation" novalidate>
                    <input type="hidden" name="aksi" value="tambah">
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" name="nama_customer" class="form-control border-start-0" placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="invalid-feedback">Nama harus diisi.</div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" name="email" class="form-control border-start-0" placeholder="contoh@email.com" required>
                            </div>
                            <div class="invalid-feedback">Email tidak valid.</div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Kategori Feedback <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-tag text-muted"></i></span>
                            <select name="kategori" class="form-select border-start-0" required>
                                <option value="" selected disabled>Pilih Kategori...</option>
                                <option value="Keluhan Sistem">Keluhan Sistem</option>
                                <option value="Saran Produk">Saran Produk</option>
                                <option value="Pelayanan">Pelayanan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="invalid-feedback">Pilih salah satu kategori.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Detail Keluhan/Pesan <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="fas fa-comment-alt text-muted"></i></span>
                            <textarea name="pesan" class="form-control border-start-0" rows="5" placeholder="Tuliskan detail keluhan atau saran Anda di sini..." required></textarea>
                        </div>
                        <div class="invalid-feedback">Pesan tidak boleh kosong.</div>
                        <div class="form-text text-muted mt-2">
                            <i class="fas fa-info-circle me-1"></i> Informasi yang Anda berikan sangat berharga untuk perbaikan sistem pemasaran tenun ini.
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="reset" class="btn btn-light px-4">
                            <i class="fas fa-undo me-2"></i> Reset
                        </button>
                        <button type="submit" class="btn btn-danger px-5 shadow-sm" style="background: linear-gradient(135deg, #c0392b 0%, #e74c3c 100%);">
                            <i class="fas fa-paper-plane me-2"></i> Kirim Feedback
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="card-footer bg-light p-4 text-center" style="border-radius: 0 0 20px 20px;">
                <p class="text-muted small mb-0">
                    <i class="fas fa-book-open me-2"></i> Bagian dari Tugas Akhir/Kapita Selekta: 
                    <strong>"Sistem Informasi Pemasaran Produk Tenun Berbasis Web"</strong>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
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
