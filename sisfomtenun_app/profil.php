<?php
session_start();
include 'header_fe.php';
?>

<!-- Profil Pemilik Section -->
<section class="py-5" style="background-color: #fcfcfc; min-height: 80vh; display: flex; align-items: center;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-5 mb-lg-0">
                <div class="position-relative p-4">
                    <div class="rounded-4 position-absolute w-100 h-100" style="top: 0; left: 0; background: linear-gradient(135deg, var(--primary-color), var(--dark-color)); opacity: 0.1; transform: rotate(-3deg);"></div>
                    <div class="rounded-4 position-absolute w-100 h-100" style="top: 10px; left: 10px; border: 2px solid var(--secondary-color); opacity: 0.3; transform: rotate(2deg);"></div>
                    <img src="https://via.placeholder.com/500x600?text=Andre+Oktafianus+Sinaga" class="img-fluid rounded-4 shadow-lg position-relative w-100" style="z-index: 2; border: 5px solid white;" alt="Andre Oktafianus Sinaga">
                    
                    <!-- Decorative Badge -->
                    <div class="position-absolute bottom-0 end-0 bg-white p-3 rounded-3 shadow-lg m-4 d-none d-md-block" style="z-index: 3; border-left: 4px solid var(--secondary-color);">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary-subtle p-2 rounded-circle me-3" style="background-color: rgba(128, 0, 0, 0.1);">
                                <i class="fas fa-graduation-cap text-maroon" style="color: var(--primary-color);"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Mahasiswa TI</small>
                                <span class="fw-bold">Stambuk 2022</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 ps-lg-5">
                <div class="badge px-3 py-2 rounded-pill mb-3" style="background-color: rgba(128, 0, 0, 0.1); color: var(--primary-color); border: 1px solid rgba(128, 0, 0, 0.2);">
                    <i class="fas fa-user-edit me-2"></i>Profil Penulis
                </div>
                <h2 class="display-5 fw-bold mb-2" style="color: var(--dark-color);">Andre Oktafianus Sinaga</h2>
                <h5 class="text-muted mb-4 fw-normal">NIM: 22171038</h5>
                
                <div class="card border-0 shadow-sm rounded-4 mb-4" style="background: linear-gradient(to right, #ffffff, #fffdf5); border-left: 5px solid var(--primary-color) !important;">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-university me-3 fs-4 text-maroon" style="color: var(--primary-color);"></i>
                            <h5 class="mb-0 fw-bold">Universitas Mandiri Bina Prestasi Medan</h5>
                        </div>
                        <p class="text-muted mb-0">Program Studi Teknik Informatika - Stambuk 2022</p>
                    </div>
                </div>

                <div class="mb-5">
                    <h4 class="fw-bold mb-3 d-flex align-items-center">
                        <span style="width: 30px; height: 3px; background-color: var(--secondary-color); display: inline-block; margin-right: 15px;"></span>
                        Tentang Karya Tulis Ilmiah
                    </h4>
                    <p class="text-muted fs-5 mb-4" style="line-height: 1.8;">
                        Sistem ini dikembangkan sebagai bagian dari tugas akhir dalam bentuk <strong style="color: var(--primary-color);">Kapita Selekta</strong> yang berjudul: 
                        <br>
                        <span class="fs-4 fw-bold text-dark mt-2 d-block" style="font-family: 'Playfair Display', serif; border-left: 3px solid var(--secondary-color); padding-left: 15px; font-style: italic;">
                            "Sistem Informasi Pemasaran Produk Tenun Berbasis Web"
                        </span>
                    </p>
                    <p class="text-muted" style="line-height: 1.8;">
                        Karya ilmiah ini disusun oleh <strong>Andre Oktafianus Sinaga</strong> sebagai syarat pemenuhan tugas Kapita Selekta. Sistem ini dirancang untuk mendigitalisasi proses pemasaran produk Tenun Tarutung, memberikan solusi modern bagi pengrajin lokal untuk menjangkau pasar yang lebih luas melalui integrasi teknologi web yang interaktif dan informatif.
                    </p>
                </div>

                <div class="row g-3 mb-5">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 rounded-3 bg-white shadow-sm border">
                            <div class="rounded-circle p-3 me-3" style="background-color: var(--primary-color);">
                                <i class="fas fa-book-open text-white"></i>
                            </div>
                            <span class="fw-bold">Kapita Selekta</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center p-3 rounded-3 bg-white shadow-sm border">
                            <div class="rounded-circle p-3 me-3" style="background-color: var(--secondary-color);">
                                <i class="fas fa-laptop-code text-dark"></i>
                            </div>
                            <span class="fw-bold">Sistem Informasi</span>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <a href="index.php" class="btn btn-outline-primary btn-lg rounded-pill px-4 shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer_fe.php'; ?>
