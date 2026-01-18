<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Registrasi Customer Baru</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="customers.php">Customers</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Customer</li>
                </ol>
            </nav>
        </div>
        <a href="customers.php" class="btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0" style="border-radius: 20px; overflow: hidden;">
                <div class="card-header bg-primary text-white p-4 border-0" style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);">
                    <div class="d-flex align-items-center">
                        <div class="bg-white rounded-circle p-3 me-3 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                            <i class="fas fa-user-plus text-primary fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold text-white">Form Input Data Customer</h5>
                            <small class="opacity-75 text-white">Lengkapi informasi di bawah ini untuk menambahkan database customer baru.</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="customers_proses.php" method="POST">
                        <input type="hidden" name="aksi" value="tambah">
                        
                        <div class="section-title mb-4">
                            <h6 class="fw-bold text-primary text-uppercase" style="letter-spacing: 1px;">
                                <i class="fas fa-id-card me-2"></i> Identitas Personal
                            </h6>
                            <hr class="mt-2 mb-0 opacity-25">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Nama Lengkap Customer <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 ps-0" name="nama_customers" placeholder="Contoh: Budi Santoso" required>
                            </div>
                            <small class="text-muted">Masukkan nama lengkap sesuai dengan kartu identitas.</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Nomor WhatsApp/Telepon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fab fa-whatsapp text-muted"></i></span>
                                    <input type="text" class="form-control border-start-0 ps-0" name="no_telepon" placeholder="Contoh: 081234567890" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold">Alamat Email <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                    <input type="email" class="form-control border-start-0 ps-0" name="email" placeholder="Contoh: budi@gmail.com" required>
                                </div>
                            </div>
                        </div>

                        <div class="section-title mb-4 mt-2">
                            <h6 class="fw-bold text-primary text-uppercase" style="letter-spacing: 1px;">
                                <i class="fas fa-map-marker-alt me-2"></i> Lokasi Pengiriman
                            </h6>
                            <hr class="mt-2 mb-0 opacity-25">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-home text-muted"></i></span>
                                <textarea class="form-control border-start-0 ps-0" name="alamat" rows="4" placeholder="Jl. Sudirman No. 123, Kelurahan, Kecamatan, Kota, Kode Pos" required></textarea>
                            </div>
                            <small class="text-muted">Pastikan alamat detail untuk memudahkan kurir dalam pengiriman produk tenun.</small>
                        </div>

                        <div class="mt-5 p-4 bg-light rounded-3 border-start border-4 border-primary">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-info-circle text-primary fa-2x me-3"></i>
                                <p class="mb-0 small text-muted">
                                    Data customer yang Anda masukkan akan disimpan ke dalam sistem <strong>Sisfomtenun App</strong> untuk kebutuhan analisis pemasaran dan manajemen pesanan produk tenun.
                                </p>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="reset" class="btn btn-light px-4 me-2 border">
                                <i class="fas fa-undo me-2"></i> Reset Form
                            </button>
                            <button type="submit" class="btn btn-primary px-5 shadow">
                                <i class="fas fa-save me-2"></i> Simpan Data Customer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control:focus {
    box-shadow: none;
    border-color: #3498db;
}
.input-group-text {
    border-color: #dee2e6;
}
.input-group:focus-within .input-group-text {
    border-color: #3498db;
    color: #3498db !important;
}
.input-group:focus-within .input-group-text i {
    color: #3498db !important;
}
</style>

<?php include 'footer.php'; ?>
