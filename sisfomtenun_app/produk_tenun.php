<?php
session_start();
include 'header_fe.php';

// Filter logic
$search = isset($_GET['search']) ? $_GET['search'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';

$query = "SELECT * FROM product WHERE 1=1";
if (!empty($search)) {
    $query .= " AND (nama_produk LIKE '%$search%' OR deskripsi_produk LIKE '%$search%')";
}
$query .= " ORDER BY id_product DESC";

$result = $conn->query($query);
?>

<!-- Header Page -->
<section class="py-5 bg-light border-bottom">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold mb-0">Koleksi Produk</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produk Tenun</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-6 mt-4 mt-lg-0">
                <form action="" method="GET" class="d-flex gap-2">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Cari produk tenun..." value="<?php echo htmlspecialchars($search); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Cari</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Product List -->
<section class="py-5">
    <div class="container py-4">
        <div class="row g-4">
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $foto = !empty($row['foto_produk']) ? 'assets/img/produk/'.$row['foto_produk'] : 'https://via.placeholder.com/400x400?text=Tenun';
                    ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="card product-card h-100">
                            <div class="position-relative">
                                <img src="<?php echo $foto; ?>" class="card-img-top product-img" alt="<?php echo $row['nama_produk']; ?>">
                                <?php if($row['stok_produk'] <= 0): ?>
                                    <div class="position-absolute top-0 end-0 m-3">
                                        <span class="badge bg-danger px-3 py-2 rounded-pill">Stok Habis</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <h6 class="text-muted small mb-1"><?php echo $row['bahan_baku'] ?? 'Tenun Tarutung'; ?></h6>
                                <h5 class="card-title fw-bold mb-2"><?php echo $row['nama_produk']; ?></h5>
                                <p class="text-primary fw-bold fs-5 mb-3">Rp <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></p>
                                <p class="card-text text-muted small text-truncate-2 mb-0">
                                    <?php echo substr(strip_tags($row['deskripsi_produk']), 0, 100); ?>...
                                </p>
                            </div>
                            <div class="card-footer bg-white border-0 pb-4 px-3">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-outline-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#modalDetail<?php echo $row['id_product']; ?>">
                                        <i class="fas fa-eye me-2"></i> Detail
                                    </button>
                                    <a href="https://wa.me/6281234567890?text=Halo, saya ingin memesan produk: <?php echo $row['nama_produk']; ?>" class="btn btn-primary rounded-pill">
                                        <i class="fab fa-whatsapp me-2"></i> Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="modalDetail<?php echo $row['id_product']; ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 shadow" style="border-radius: 20px;">
                                <div class="modal-body p-0">
                                    <div class="row g-0">
                                        <div class="col-md-6">
                                            <img src="<?php echo $foto; ?>" class="img-fluid h-100 object-fit-cover" style="border-radius: 20px 0 0 20px;" alt="<?php echo $row['nama_produk']; ?>">
                                        </div>
                                        <div class="col-md-6 p-4 p-lg-5">
                                            <button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <h6 class="text-primary fw-bold text-uppercase mb-2"><?php echo $row['bahan_baku'] ?? 'Produk Tenun'; ?></h6>
                                            <h2 class="fw-bold mb-3"><?php echo $row['nama_produk']; ?></h2>
                                            <h3 class="text-primary fw-bold mb-4">Rp <?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></h3>
                                            
                                            <div class="mb-4">
                                                <h6 class="fw-bold text-dark">Deskripsi Produk:</h6>
                                                <p class="text-muted small mb-0"><?php echo nl2br($row['deskripsi_produk']); ?></p>
                                            </div>

                                            <div class="row g-3 mb-4">
                                                <div class="col-6">
                                                    <div class="p-3 bg-light rounded-3 text-center">
                                                        <small class="text-muted d-block">Tersedia</small>
                                                        <span class="fw-bold"><?php echo $row['stok_produk']; ?> Pcs</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="p-3 bg-light rounded-3 text-center">
                                                        <small class="text-muted d-block">Kondisi</small>
                                                        <span class="fw-bold">Baru (Manual)</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-grid">
                                                <a href="https://wa.me/6281234567890?text=Halo, saya ingin bertanya tentang produk: <?php echo $row['nama_produk']; ?>" class="btn btn-primary btn-lg rounded-pill py-3">
                                                    <i class="fab fa-whatsapp me-2"></i> Hubungi Penjual
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="col-12 text-center py-5">
                    <img src="https://illustrations.popsy.co/amber/no-results.svg" alt="No Result" style="width: 200px;" class="mb-4">
                    <h4 class="fw-bold">Produk Tidak Ditemukan</h4>
                    <p class="text-muted">Maaf, produk yang Anda cari tidak tersedia saat ini.</p>
                    <a href="produk_tenun.php" class="btn btn-primary rounded-pill px-4">Lihat Semua Produk</a>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<?php include 'footer_fe.php'; ?>
