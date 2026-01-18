<?php
include 'config.php';
include 'header.php';

// 1. Analisis Penjualan Bulanan (6 Bulan Terakhir)
$sql_bulanan = "SELECT DATE_FORMAT(tanggal_pesanan, '%M %Y') as bulan, SUM(total_harga) as total 
                FROM pesanan_tenun 
                GROUP BY MONTH(tanggal_pesanan), YEAR(tanggal_pesanan) 
                ORDER BY tanggal_pesanan ASC LIMIT 6";
$res_bulanan = $conn->query($sql_bulanan);
$labels_bulanan = [];
$data_bulanan = [];
while($row = $res_bulanan->fetch_assoc()) {
    $labels_bulanan[] = $row['bulan'];
    $data_bulanan[] = $row['total'];
}

// 2. Top 5 Produk Terlaris (Berdasarkan Kuantitas)
$sql_top_produk = "SELECT p.nama_product, SUM(d.jumlah_produk) as total_qty 
                   FROM detail_pesanan_tenun d 
                   JOIN product_tenun p ON d.id_product = p.id_product 
                   GROUP BY d.id_product 
                   ORDER BY total_qty DESC LIMIT 5";
$res_top_produk = $conn->query($sql_top_produk);
$labels_produk = [];
$data_produk = [];
while($row = $res_top_produk->fetch_assoc()) {
    $labels_produk[] = $row['nama_product'];
    $data_produk[] = $row['total_qty'];
}

// 3. Kontribusi Pendapatan per Jenis Kain
$sql_jenis = "SELECT p.jenis_kain, SUM(d.subtotal) as total_revenue 
              FROM detail_pesanan_tenun d 
              JOIN product_tenun p ON d.id_product = p.id_product 
              GROUP BY p.jenis_kain 
              ORDER BY total_revenue DESC";
$res_jenis = $conn->query($sql_jenis);
$labels_jenis = [];
$data_jenis = [];
while($row = $res_jenis->fetch_assoc()) {
    $labels_jenis[] = $row['jenis_kain'];
    $data_jenis[] = $row['total_revenue'];
}

// 4. Analisis Status Pesanan
$sql_status = "SELECT status_pesanan, COUNT(*) as total FROM pesanan_tenun GROUP BY status_pesanan";
$res_status = $conn->query($sql_status);
$labels_status = [];
$data_status = [];
while($row = $res_status->fetch_assoc()) {
    $labels_status[] = ucfirst($row['status_pesanan']);
    $data_status[] = $row['total'];
}
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Analisis Data Strategis</h2>
            <p class="text-muted">Visualisasi data untuk pengambilan keputusan bisnis dan kebutuhan Karya Tulis Ilmiah.</p>
        </div>
        <button onclick="window.print()" class="btn btn-outline-primary">
            <i class="fas fa-print me-2"></i> Cetak Analisis
        </button>
    </div>

    <div class="row">
        <!-- Analisis Penjualan Bulanan -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-chart-line me-2"></i> Tren Pendapatan Bulanan</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartBulanan" height="300"></canvas>
                    <div class="mt-3 p-3 bg-light rounded">
                        <small class="text-muted"><strong>Interpretasi Ilmiah:</strong> Grafik di atas menunjukkan fluktuasi pendapatan. Tren positif mengindikasikan efektivitas strategi pemasaran digital pada produk tenun.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribusi Status -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-success"><i class="fas fa-tasks me-2"></i> Status Pesanan</h5>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <canvas id="chartStatus"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Top 5 Produk -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-warning"><i class="fas fa-crown me-2"></i> Top 5 Produk Terlaris</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartProduk" height="250"></canvas>
                </div>
            </div>
        </div>

        <!-- Revenue by Category -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100 shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0 fw-bold text-info"><i class="fas fa-pie-chart me-2"></i> Pendapatan per Jenis Kain</h5>
                </div>
                <div class="card-body">
                    <canvas id="chartJenis" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Format Rupiah function
    const formatRupiah = (value) => {
        return 'Rp ' + value.toLocaleString('id-ID');
    };

    // 1. Tren Bulanan
    new Chart(document.getElementById('chartBulanan'), {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels_bulanan); ?>,
            datasets: [{
                label: 'Total Pendapatan',
                data: <?php echo json_encode($data_bulanan); ?>,
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.1)',
                fill: true,
                tension: 0.3,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { callback: value => formatRupiah(value) }
                }
            }
        }
    });

    // 2. Status Pesanan (Pie)
    new Chart(document.getElementById('chartStatus'), {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($labels_status); ?>,
            datasets: [{
                data: <?php echo json_encode($data_status); ?>,
                backgroundColor: ['#f6c23e', '#1cc88a']
            }]
        }
    });

    // 3. Top Produk (Horizontal Bar)
    new Chart(document.getElementById('chartProduk'), {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($labels_produk); ?>,
            datasets: [{
                label: 'Jumlah Terjual',
                data: <?php echo json_encode($data_produk); ?>,
                backgroundColor: '#36b9cc'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // 4. Jenis Kain (Doughnut)
    new Chart(document.getElementById('chartJenis'), {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($labels_jenis); ?>,
            datasets: [{
                data: <?php echo json_encode($data_jenis); ?>,
                backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b']
            }]
        },
        options: {
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + formatRupiah(context.raw);
                        }
                    }
                }
            }
        }
    });
</script>

<?php include 'footer.php'; ?>
