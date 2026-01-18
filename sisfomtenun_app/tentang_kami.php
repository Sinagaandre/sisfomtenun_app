<?php
session_start();
include 'header_fe.php';
?>

<!-- Header Page -->
<section class="py-5 bg-light border-bottom">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold mb-0" style="color: var(--primary-color);">Tentang Kami</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Beranda</a></li>
                        <li class="breadcrumb-item active text-primary" aria-current="page">Tentang Kami</li>
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
                <div class="position-relative p-4">
                    <div class="rounded-4 position-absolute w-100 h-100" style="top: 0; left: 0; background: linear-gradient(135deg, var(--primary-color), var(--dark-color)); opacity: 0.1; transform: rotate(-3deg);"></div>
                    <img src="https://images.unsplash.com/photo-1544967082-d9d25d867d66?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="img-fluid rounded-4 shadow-lg position-relative" alt="Penenun Tarutung" style="border: 5px solid white;">
                </div>
            </div>
            <div class="col-lg-6">
                <h6 class="text-primary fw-bold text-uppercase mb-3" style="letter-spacing: 2px;">Visi & Misi Penulis</h6>
                <h2 class="fw-bold mb-4">Mengembangkan Masa Depan Tenun Melalui Teknologi</h2>
                <div class="mb-4">
                    <h5 class="fw-bold text-dark"><i class="fas fa-eye me-2 text-primary"></i> Visi</h5>
                    <p class="text-muted" style="text-align: justify;">
                        Menjadi pionir dalam digitalisasi warisan budaya Tenun Tarutung, menciptakan platform yang tidak hanya sebagai tempat pemasaran, tetapi juga sebagai pusat edukasi dan pelestarian motif tradisional untuk generasi mendatang.
                    </p>
                </div>
                <div class="mb-4">
                    <h5 class="fw-bold text-dark"><i class="fas fa-bullseye me-2 text-primary"></i> Misi</h5>
                    <ul class="text-muted ps-3" style="text-align: justify; list-style-type: none;">
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Mengembangkan sistem informasi yang user-friendly dan efisien untuk UMKM Tenun.</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Mengintegrasikan fitur pemesanan modern untuk meningkatkan jangkauan pasar hingga ke tingkat internasional.</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-primary me-2"></i> Melestarikan nilai-nilai autentik Tenun Tumtuman melalui dokumentasi digital yang lengkap.</li>
                        <li><i class="fas fa-check-circle text-primary me-2"></i> Terus mengembangkan fitur sistem agar relevan dengan perkembangan industri 4.0.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Developer Section -->
<section class="py-5 bg-light">
    <div class="container py-5">
        <div class="row text-center mb-5">
            <div class="col-lg-12">
                <h2 class="fw-bold">Tentang Pengembang</h2>
                <div class="mx-auto bg-primary mb-4" style="width: 80px; height: 3px;"></div>
                <p class="text-muted">Profil Mahasiswa di balik pengembangan sistem ini.</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 bg-primary d-flex flex-column align-items-center justify-content-center text-white p-5 text-center">
                            <div class="rounded-circle bg-white p-2 mb-4 shadow-sm">
                                <img src="https://via.placeholder.com/200x200?text=Andre+Oktafianus+Sinaga" class="rounded-circle img-fluid" style="width: 150px; height: 150px; object-fit: cover;" alt="Andre Oktafianus Sinaga">
                            </div>
                            <h4 class="fw-bold mb-1">Andre Oktafianus Sinaga</h4>
                            <p class="mb-0 opacity-75">Mahasiswa Teknik Informatika D3</p>
                        </div>
                        <div class="col-md-7 p-4 p-lg-5 bg-white">
                            <div class="mb-4">
                                <h6 class="text-uppercase text-primary fw-bold mb-3 small" style="letter-spacing: 1px;">Akademik</h6>
                                <p class="mb-2"><strong>Universitas:</strong> Universitas Mandiri Bina Prestasi Medan</p>
                                <p class="mb-2"><strong>Stambuk:</strong> 2022</p>
                                <p class="mb-0"><strong>Program Studi:</strong> Teknik Informatika (D3)</p>
                            </div>
                            <hr class="my-4 opacity-10">
                            <div class="mb-4">
                                <h6 class="text-uppercase text-primary fw-bold mb-3 small" style="letter-spacing: 1px;">Kontak Pengembang</h6>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="rounded-circle bg-primary-subtle p-2 me-3" style="background-color: rgba(128, 0, 0, 0.1);">
                                        <i class="fab fa-whatsapp text-maroon" style="color: var(--primary-color);"></i>
                                    </div>
                                    <a href="https://wa.me/6283182770374" target="_blank" class="text-decoration-none text-muted">0831-8277-0374</a>
                                </div>
                                <div class="d-flex align-items-center mb-0">
                                    <div class="rounded-circle bg-primary-subtle p-2 me-3" style="background-color: rgba(128, 0, 0, 0.1);">
                                        <i class="fas fa-envelope text-maroon" style="color: var(--primary-color);"></i>
                                    </div>
                                    <a href="mailto:sinagaandre057@gmail.com" class="text-decoration-none text-muted">sinagaandre057@gmail.com</a>
                                </div>
                            </div>
                            
                            <div class="pt-3">
                                <a href="index.php" class="btn btn-outline-primary rounded-pill px-4">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer_fe.php'; ?>
