<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Laporan</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Laporan</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-file-alt me-2"></i> Cetak Laporan</h5>
                </div>
                <div class="card-body">
                    <form action="laporan_cetak.php" method="GET" target="_blank">
                        <div class="mb-3">
                            <label class="form-label">Jenis Laporan</label>
                            <select class="form-select" name="jenis" id="jenis_laporan" required>
                                <option value="">-- Pilih Jenis Laporan --</option>
                                <option value="pesanan">Laporan Pesanan</option>
                                <option value="stok">Laporan Stok Produk</option>
                                <option value="pengiriman">Laporan Pengiriman</option>
                                <option value="customers">Laporan Data Customer</option>
                            </select>
                        </div>

                        <div class="mb-3" id="date_range">
                            <label class="form-label">Periode Tanggal</label>
                            <div class="input-group">
                                <input type="date" class="form-control" name="tgl_awal" value="<?php echo date('Y-m-01'); ?>">
                                <span class="input-group-text">s/d</span>
                                <input type="date" class="form-control" name="tgl_akhir" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <small class="text-muted">* Tidak wajib untuk Laporan Stok & Customer</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-print me-2"></i> Cetak / Download PDF
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-info-circle me-2"></i> Informasi</h5>
                </div>
                <div class="card-body">
                    <p>Fitur ini digunakan untuk mencetak laporan dalam format yang siap cetak atau disimpan sebagai PDF.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> <strong>Laporan Pesanan:</strong> Menampilkan transaksi pesanan dalam periode tertentu.</li>
                        <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> <strong>Laporan Stok:</strong> Menampilkan sisa stok produk saat ini.</li>
                        <li class="list-group-item"><i class="fas fa-check text-success me-2"></i> <strong>Laporan Pengiriman:</strong> Menampilkan status pengiriman barang.</li>
                    </ul>
                    <div class="alert alert-warning mt-3 mb-0">
                        <i class="fas fa-lightbulb me-2"></i> <strong>Tips:</strong> Gunakan fitur "Save as PDF" pada jendela cetak browser untuk menyimpan laporan sebagai file PDF.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('jenis_laporan').addEventListener('change', function() {
    var jenis = this.value;
    var dateRange = document.getElementById('date_range');
    
    // Disable date range for reports that are typically snapshot-based
    if(jenis === 'stok' || jenis === 'customers') {
        dateRange.style.opacity = '0.5';
        dateRange.querySelectorAll('input').forEach(input => input.disabled = true);
    } else {
        dateRange.style.opacity = '1';
        dateRange.querySelectorAll('input').forEach(input => input.disabled = false);
    }
});
</script>

<?php include 'footer.php'; ?>
