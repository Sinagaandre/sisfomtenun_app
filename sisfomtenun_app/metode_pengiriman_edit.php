<?php
include 'config.php';
include 'header.php';

if (!isset($_GET['id'])) {
    echo "<script>window.location='metode_pengiriman.php';</script>";
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM metode_pengiriman WHERE id_metode = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>window.location='metode_pengiriman.php';</script>";
    exit;
}

$row = $result->fetch_assoc();
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-lg" style="border-radius: 20px;">
            <div class="card-header bg-warning text-white p-4" style="border-radius: 20px 20px 0 0; background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white text-warning p-3 me-3 shadow-sm" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-edit fa-lg"></i>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-bold">Edit Ekspedisi</h4>
                        <p class="mb-0 small opacity-75 text-dark">Perbarui data jasa pengiriman</p>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="metode_pengiriman_proses.php" method="POST" class="needs-validation" novalidate>
                    <input type="hidden" name="aksi" value="edit">
                    <input type="hidden" name="id_metode" value="<?php echo $row['id_metode']; ?>">
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold text-secondary small text-uppercase">Nama Ekspedisi <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-shipping-fast"></i></span>
                            <input type="text" name="nama_metode" class="form-control border-start-0 py-2" value="<?php echo htmlspecialchars($row['nama_metode']); ?>" required>
                        </div>
                        <div class="invalid-feedback">Nama ekspedisi wajib diisi.</div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Biaya per KG (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-tag"></i></span>
                                <input type="number" name="biaya_per_kg" class="form-control border-start-0 py-2" value="<?php echo $row['biaya_per_kg']; ?>" required>
                            </div>
                            <div class="invalid-feedback">Biaya per KG wajib diisi.</div>
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label fw-bold text-secondary small text-uppercase">Estimasi (Hari) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted"><i class="fas fa-clock"></i></span>
                                <input type="text" name="estimasi_hari" class="form-control border-start-0 py-2" value="<?php echo $row['estimasi_hari']; ?>" required>
                            </div>
                            <div class="invalid-feedback">Estimasi hari wajib diisi.</div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-warning py-3 fw-bold shadow-sm text-white" style="border-radius: 12px;">
                            <i class="fas fa-sync-alt me-2"></i> Perbarui Ekspedisi
                        </button>
                        <a href="metode_pengiriman.php" class="btn btn-light py-3 fw-bold text-muted border-0">
                            Batal
                        </a>
                    </div>
                </form>
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
