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
                    <a href="produk_tenun.php" class="btn btn-primary btn-lg">Lihat Koleksi <i class="fas fa-arrow-right ms-2"></i></a>
                    <a href="tentang_kami.php" class="btn btn-outline-light btn-lg">Tentang Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row text-center mb-5">
            <div class="col-lg-12">
                <h2 class="fw-bold">Mengapa Memilih Tenun Tarutung?</h2>
                <div class="mx-auto bg-primary mb-4" style="width: 80px; height: 3px;"></div>
                <p class="text-muted">Kami menghadirkan kualitas terbaik dengan proses yang transparan dan digital.</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-4 mx-auto mb-4" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-gem fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Kualitas Premium</h5>
                    <p class="text-muted">Setiap produk ditenun secara manual dengan benang berkualitas tinggi dan motif autentik.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4">
                    <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-4 mx-auto mb-4" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-shipping-fast fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Pengiriman Cepat</h5>
                    <p class="text-muted">Bekerja sama dengan berbagai ekspedisi terpercaya untuk memastikan pesanan sampai tepat waktu.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm p-4 text-center rounded-4">
                    <div class="rounded-circle bg-info bg-opacity-10 text-info p-4 mx-auto mb-4" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-history fa-2x"></i>
                    </div>
                    <h5 class="fw-bold">Warisan Budaya</h5>
                    <p class="text-muted">Setiap motif menceritakan filosofi dan sejarah panjang masyarakat Batak Toba.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Products Preview -->
<section class="py-5">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="fw-bold">Koleksi Terbaru</h2>
                <div class="bg-primary" style="width: 60px; height: 3px;"></div>
            </div>
            <a href="produk_tenun.php" class="text-primary fw-bold text-decoration-none">Lihat Semua <i class="fas fa-chevron-right ms-1"></i></a>
        </div>
        
        <div class="row g-4">
            <?php
            $query = "SELECT * FROM product ORDER BY id_product DESC LIMIT 4";
            $result = $conn->query($query);
            
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $foto = !empty($row['foto_produk']) ? 'assets/img/produk/'.$row['foto_produk'] : 'https://via.placeholder.com/400x400?text=Tenun';
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card product-card h-100">
                            <img src="<?php echo $foto; ?>" class="card-img-top product-img" alt="<?php echo $row['nama_produk']; ?>">
                            <div class="card-body">
                                <h6 class="text-muted small mb-1"><?php echo $row['bahan_baku'] ?? 'Tenun Asli'; ?></h6>
                                <h5 class="card-title fw-bold mb-2"><?php echo $row['nama_produk']; ?></h5>
                                <p class="text-primary fw-bold fs-5 mb-0">Rp <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></p>
                            </div>
                            <div class="card-footer bg-white border-0 pb-4 px-3">
                                <a href="produk_tenun.php?id=<?php echo $row['id_product']; ?>" class="btn btn-outline-primary w-100 rounded-pill">Detail Produk</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12 text-center text-muted">Belum ada produk yang ditampilkan.</div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container py-4 text-center">
        <h2 class="fw-bold mb-4">Ingin Memesan Custom atau Tanya Stok?</h2>
        <p class="lead mb-5 opacity-75">Tim kami siap membantu Anda mendapatkan Tenun Tarutung impian.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="https://wa.me/6281234567890" class="btn btn-light btn-lg px-5 py-3 rounded-pill fw-bold text-primary">
                <i class="fab fa-whatsapp me-2"></i> Hubungi via WhatsApp
            </a>
        </div>
    </div>
</section>

<?php include 'footer_fe.php'; ?>
