<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header">
        <h2 class="page-title">Dokumentasi API Sistem</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dokumentasi API</li>
            </ol>
        </nav>
    </div>

    <div class="alert alert-info shadow-sm border-0" style="border-radius: 15px;">
        <i class="fas fa-info-circle me-2"></i>
        <strong>Informasi Ilmiah:</strong> Dokumentasi API ini disediakan untuk mendukung integrasi sistem dengan platform eksternal (seperti Mobile App atau Third-party Analytics) sesuai dengan metodologi pengembangan sistem informasi modern.
    </div>

    <div class="row">
        <!-- API Get Products -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white d-flex align-items-center">
                    <span class="badge bg-success me-2">GET</span>
                    <h5 class="mb-0">Daftar Produk</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small">Endpoint ini digunakan untuk mengambil seluruh data katalog produk tenun dalam format JSON.</p>
                    <div class="bg-light p-3 rounded mb-3">
                        <code>/api/get_products.php</code>
                    </div>
                    <h6>Response Example:</h6>
                    <pre class="bg-dark text-light p-3 rounded small" style="max-height: 200px; overflow-y: auto;">
{
  "status": "success",
  "message": "Data produk berhasil ditemukan",
  "data": [
    {
      "id": 1,
      "nama": "Ulos Sadum",
      "jenis": "Ulos",
      "motif": "Sadum Tarutung",
      "harga": 500000,
      "stok": 15
    }
  ]
}</pre>
                </div>
            </div>
        </div>

        <!-- API Get Stats -->
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header bg-white d-flex align-items-center">
                    <span class="badge bg-success me-2">GET</span>
                    <h5 class="mb-0">Statistik Bisnis</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted small">Endpoint ini menyediakan data agregat untuk kebutuhan dashboard eksternal atau laporan manajemen.</p>
                    <div class="bg-light p-3 rounded mb-3">
                        <code>/api/get_stats.php</code>
                    </div>
                    <h6>Response Example:</h6>
                    <pre class="bg-dark text-light p-3 rounded small" style="max-height: 200px; overflow-y: auto;">
{
  "status": "success",
  "data": {
    "total_produk": 24,
    "total_pesanan": 150,
    "total_pendapatan": 75000000
  }
}</pre>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
