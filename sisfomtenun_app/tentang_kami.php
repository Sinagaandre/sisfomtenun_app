<?php
session_start();
include 'header_fe.php';
?>

<!-- Header Page -->
<section class="py-5 bg-light border-bottom">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold mb-0">Tentang Kami</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- About Content -->
<section class="py-5">
    <div class="container py-5">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1544967082-d9d25d867d66?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 shadow-lg" alt="Penenun Tarutung">
                    <div class="position-absolute bottom-0 start-0 bg-primary text-white p-4 rounded-4 m-3 shadow-sm d-none d-md-block" style="max-width: 250px;">
                        <h4 class="fw-bold mb-0">100%</h4>
                        <p class="small mb-0">Produk Tenun Autentik dari Perajin Lokal Tarutung.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h6 class="text-primary fw-bold text-uppercase mb-3">Visi & Misi Kami</h6>
                <h2 class="fw-bold mb-4">Melestarikan Warisan Budaya Melalui Digitalisasi</h2>
                <p class="text-muted mb-4" style="text-align: justify;">
                    Sistem Informasi Pemasaran Produk Tenun (SISFOMTENUN) adalah sebuah inisiatif teknologi yang dirancang untuk mendukung ekosistem perajin Tenun Tarutung di Sumatera Utara. Kami percaya bahwa keindahan kain tradisional seperti Ulos, Tumtuman, dan Sarung harus dapat diakses dengan mudah oleh dunia tanpa kehilangan nilai autentiknya.
                </p>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                                <i class="fas fa-hand-holding-heart"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Pemberdayaan Perajin</h6>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                                <i class="fas fa-globe"></i>
                            </div>
                            <h6 class="fw-bold mb-0">Akses Pasar Luas</h6>
                        </div>
                    </div>
                </div>
                <p class="text-muted mb-5" style="text-align: justify;">
                    Proyek ini merupakan bagian dari Karya Tulis Ilmiah (Kapita Selekta) yang mengeksplorasi bagaimana integrasi sistem informasi dapat meningkatkan efisiensi rantai pasok dan memperkuat identitas brand lokal di era ekonomi digital.
                </p>
                <a href="produk_tenun.php" class="btn btn-primary btn-lg rounded-pill px-5">Jelajahi Koleksi</a>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row text-center mb-5">
            <div class="col-lg-12">
                <h2 class="fw-bold">Nilai-Nilai Kami</h2>
                <div class="mx-auto bg-primary mb-4" style="width: 80px; height: 3px;"></div>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="fs-1 text-primary mb-3"><i class="fas fa-certificate"></i></div>
                    <h5 class="fw-bold">Autentisitas</h5>
                    <p class="text-muted small">Kami menjamin keaslian setiap helai kain yang dipasarkan melalui sistem kami.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="fs-1 text-primary mb-3"><i class="fas fa-shield-alt"></i></div>
                    <h5 class="fw-bold">Transparansi</h5>
                    <p class="text-muted small">Informasi bahan baku, proses, dan harga disajikan secara jujur dan terbuka.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center p-4">
                    <div class="fs-1 text-primary mb-3"><i class="fas fa-users"></i></div>
                    <h5 class="fw-bold">Komunitas</h5>
                    <p class="text-muted small">Membangun hubungan yang kuat antara perajin, kolektor, dan pecinta budaya.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Team/Creator Section (Optional) -->
<section class="py-5">
    <div class="container py-5">
        <div class="row text-center mb-5">
            <div class="col-lg-12">
                <h2 class="fw-bold">Tentang Pengembang</h2>
                <div class="mx-auto bg-primary mb-4" style="width: 80px; height: 3px;"></div>
                <p class="text-muted">Dibalik sistem informasi pemasaran tenun ini.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-4 bg-primary d-flex align-items-center justify-content-center text-white p-5">
                            <i class="fas fa-user-graduate fa-5x"></i>
                        </div>
                        <div class="col-md-8 p-4 p-lg-5">
                            <h4 class="fw-bold mb-1">Pengembang Sistem</h4>
                            <h6 class="text-primary mb-3">Mahasiswa Sistem Informasi</h6>
                            <p class="text-muted" style="text-align: justify;">
                                Sistem ini dikembangkan sebagai bentuk dedikasi dalam menggabungkan ilmu teknologi informasi dengan pelestarian budaya lokal. Melalui penelitian "Kapita Selekta", kami berupaya memberikan solusi nyata bagi tantangan pemasaran yang dihadapi UMKM Tenun di Tarutung.
                            </p>
                            <div class="mt-4">
                                <h6 class="small fw-bold text-dark text-uppercase mb-2">Kontak Pengembang:</h6>
                                <p class="small text-muted mb-0"><i class="fas fa-envelope me-2"></i> dev@sisfomtenun.id</p>
                                <p class="small text-muted mb-0"><i class="fas fa-map-marker-alt me-2"></i> Universitas HKBP Nommensen, Tarutung</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer_fe.php'; ?>
