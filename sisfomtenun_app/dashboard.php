<?php
include 'config.php';
include 'header.php';

// Get counts for dashboard
$count_products = $conn->query("SELECT COUNT(*) as total FROM product_tenun")->fetch_assoc()['total'];
$count_orders = $conn->query("SELECT COUNT(*) as total FROM pesanan_tenun")->fetch_assoc()['total'];
$count_customers = $conn->query("SELECT COUNT(*) as total FROM customers")->fetch_assoc()['total'];
$count_suppliers = $conn->query("SELECT COUNT(*) as total FROM pemasok_tenun")->fetch_assoc()['total'];
$count_shipping = $conn->query("SELECT COUNT(*) as total FROM pengiriman_tenun WHERE status_pengiriman = 'Dikirim'")->fetch_assoc()['total'];
$count_materials = $conn->query("SELECT COUNT(*) as total FROM bahan_baku_tenun")->fetch_assoc()['total'];

// Data for Sales Chart (Last 6 Months)
$sales_data = $conn->query("SELECT DATE_FORMAT(tanggal_pesanan, '%b') as bulan, SUM(total_harga) as total 
                            FROM pesanan_tenun 
                            GROUP BY MONTH(tanggal_pesanan) 
                            ORDER BY tanggal_pesanan ASC LIMIT 6");
$labels_sales = [];
$values_sales = [];
while($row = $sales_data->fetch_assoc()) {
    $labels_sales[] = $row['bulan'];
    $values_sales[] = $row['total'];
}

// Data for Product Distribution (Jenis Kain)
$product_dist = $conn->query("SELECT jenis_kain, COUNT(*) as total FROM product_tenun GROUP BY jenis_kain");
$labels_dist = [];
$values_dist = [];
while($row = $product_dist->fetch_assoc()) {
    $labels_dist[] = $row['jenis_kain'];
    $values_dist[] = $row['total'];
}
?>

    <style>
        .card-box {
            border-radius: 10px;
            padding: 20px;
            color: white;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s;
        }
        .card-box:hover {
            transform: translateY(-5px);
        }
        .card-box h3 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .card-box p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }
        .card-box .icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 3rem;
            opacity: 0.3;
        }
        .bg-blue { background: linear-gradient(45deg, #0d6efd, #0a58ca); }
        .bg-green { background: linear-gradient(45deg, #198754, #146c43); }
        .bg-yellow { background: linear-gradient(45deg, #ffc107, #ffca2c); color: #000 !important; }
        .bg-red { background: linear-gradient(45deg, #dc3545, #b02a37); }
        .bg-info { background: linear-gradient(45deg, #0dcaf0, #0aa2c0); color: #000 !important; }
        .bg-purple { background: linear-gradient(45deg, #6f42c1, #59359a); }
        
        .chart-container {
            position: relative;
            margin: auto;
            height: 300px;
            width: 100%;
        }
    </style>

    <div class="row fade-in">
        <div class="col-md-4 col-lg-3">
            <div class="card-box bg-blue">
                <h3><?php echo $count_products; ?></h3>
                <p>Total Produk</p>
                <i class="fas fa-box icon"></i>
                <a href="product.php" class="stretched-link"></a>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card-box bg-green">
                <h3><?php echo $count_orders; ?></h3>
                <p>Total Pesanan</p>
                <i class="fas fa-shopping-cart icon"></i>
                <a href="pesanan.php" class="stretched-link"></a>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card-box bg-yellow">
                <h3><?php echo $count_customers; ?></h3>
                <p>Total Pelanggan</p>
                <i class="fas fa-users icon"></i>
                <a href="customers.php" class="stretched-link"></a>
            </div>
        </div>
        <div class="col-md-4 col-lg-3">
            <div class="card-box bg-red">
                <h3><?php echo $count_suppliers; ?></h3>
                <p>Total Pemasok</p>
                <i class="fas fa-handshake icon"></i>
                <a href="pemasok.php" class="stretched-link"></a>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4 fade-in" style="animation-delay: 0.2s;">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-bold">Grafik Perkembangan Penjualan</h5>
                    <span class="badge bg-primary">6 Bulan Terakhir</span>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 font-weight-bold">Distribusi Jenis Produk</h5>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="productChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4 fade-in" style="animation-delay: 0.4s;">
        <div class="card-header bg-white">
            <h5 class="mb-0 font-weight-bold">Data Produk Terbaru</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Jenis Kain</th>
                            <th>Motif</th>
                            <th>Warna</th>
                            <th>Harga</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_produk = "SELECT * FROM product_tenun ORDER BY id_product DESC LIMIT 5";
                        $result_produk = $conn->query($sql_produk);
                        
                        if ($result_produk->num_rows > 0) {
                            $no = 1;
                            while($row = $result_produk->fetch_assoc()) {
                                echo "<tr>
                                    <td>".$no++."</td>
                                    <td>".$row['nama_product']."</td>
                                    <td>".$row['jenis_kain']."</td>
                                    <td>".$row['motif']."</td>
                                    <td>".$row['warna']."</td>
                                    <td>Rp ".number_format($row['harga'], 0, ',', '.')."</td>
                                    <td>".$row['stok']."</td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Belum ada data produk</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Sales Trend Chart (Line)
    const ctxSales = document.getElementById('salesChart').getContext('2d');
    new Chart(ctxSales, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($labels_sales); ?>,
            datasets: [{
                label: 'Total Penjualan (Rp)',
                data: <?php echo json_encode($values_sales); ?>,
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointRadius: 5,
                pointBackgroundColor: '#3498db'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    // Product Distribution Chart (Doughnut)
    const ctxProduct = document.getElementById('productChart').getContext('2d');
    new Chart(ctxProduct, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($labels_dist); ?>,
            datasets: [{
                data: <?php echo json_encode($values_dist); ?>,
                backgroundColor: [
                    '#3498db', '#1abc9c', '#f1c40f', '#e74c3c', '#9b59b6', '#34495e'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 20 }
                }
            },
            cutout: '70%'
        }
    });
</script>

<?php include 'footer.php'; ?>
