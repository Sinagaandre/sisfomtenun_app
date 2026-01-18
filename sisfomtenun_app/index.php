<?php
session_start();
include 'header_fe.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 hero-content">
                <h6 class="text-uppercase fw-bold mb-3" style="letter-spacing: 3px; color: var(--secondary-color);">Warisan Budaya Batak</h6>
                <h1>Keindahan Tenun Tarutung dalam Genggaman Anda</h1>
                <p class="lead mb-5 opacity-75">Platform digital terpadu untuk mengeksplorasi dan memiliki karya seni tekstil terbaik dari perajin Tarutung. Gabungan tradisi dan teknologi dalam satu sistem informasi.</p>
                <div class="d-flex gap-3">
                    <a href="beranda.php" class="btn btn-primary btn-lg">Sejarah Tenun <i class="fas fa-history ms-2"></i></a>
                    <a href="profil.php" class="btn btn-outline-light btn-lg">Profil Pemilik</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Koleksi Produk Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h6 class="text-primary fw-bold text-uppercase" style="letter-spacing: 2px;">Koleksi Produk</h6>
            <h2 class="display-6 fw-bold">Keindahan Tenun Tarutung</h2>
            <div class="mx-auto bg-primary" style="width: 80px; height: 3px;"></div>
        </div>

        <div class="row g-4">
            <?php
            // Mengambil data produk dari database (seperti di produk_tenun.php)
            $query = "SELECT * FROM product ORDER BY id_product DESC LIMIT 4";
            $result = $conn->query($query);
            
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $foto = !empty($row['foto_produk']) ? 'assets/img/produk/'.$row['foto_produk'] : 'https://via.placeholder.com/400x400?text=Tenun';
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card product-card h-100 border-0 shadow-sm">
                            <div class="position-relative">
                                <img src="<?php echo $foto; ?>" class="card-img-top product-img" alt="<?php echo $row['nama_produk']; ?>" style="height: 250px; object-fit: cover; border-radius: 15px 15px 0 0;">
                                <?php if(isset($row['stok_produk']) && $row['stok_produk'] <= 0): ?>
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Stok Habis</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body p-4">
                                <h6 class="text-muted small mb-1"><?php echo $row['bahan_baku'] ?? 'Tenun Tarutung'; ?></h6>
                                <h5 class="card-title fw-bold mb-2"><?php echo $row['nama_produk']; ?></h5>
                                <p class="text-primary fw-bold fs-5 mb-0">Rp <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></p>
                            </div>
                            <div class="card-footer bg-white border-0 pb-4 px-4">
                                <a href="produk_tenun.php" class="btn btn-outline-primary w-100 rounded-pill">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12 text-center text-muted">Belum ada produk yang tersedia.</div>';
            }
            ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="produk_tenun.php" class="btn btn-primary btn-lg rounded-pill px-5">Lihat Semua Produk <i class="fas fa-chevron-right ms-2"></i></a>
        </div>
    </div>
</section>

<?php include 'footer_fe.php'; ?>
