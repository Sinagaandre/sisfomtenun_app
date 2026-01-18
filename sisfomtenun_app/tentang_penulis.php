<?php
include 'config.php';
include 'header.php';
?>

<div class="fade-in">
    <div class="page-header d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="page-title">Profil Penulis & Pengembang</h2>
            <p class="text-muted">Informasi akademik pengembang Sistem Informasi Pemasaran Produk Tenun.</p>
        </div>
        <div class="badge bg-primary p-2">
            <i class="fas fa-user-graduate me-2"></i> Mahasiswa Aktif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0" style="border-radius: 25px; overflow: hidden;">
                <div class="row g-0">
                    <!-- Bagian Foto -->
                    <div class="col-md-5 bg-primary d-flex align-items-center justify-content-center p-5" style="background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);">
                        <div class="text-center text-white">
                            <div class="position-relative mb-4">
                                <div class="rounded-circle bg-white p-2 shadow-lg mx-auto" style="width: 220px; height: 220px; overflow: hidden;">
                                    <?php 
                                    $foto_path = "assets/img/andre_sinaga.jpg"; // Path foto Anda
                                    if (file_exists($foto_path)) {
                                        echo '<img src="'.$foto_path.'" class="rounded-circle img-fluid" style="width: 100%; height: 100%; object-fit: cover;">';
                                    } else {
                                        echo '<div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-primary rounded-circle">';
                                        echo '<i class="fas fa-user-tie fa-7x"></i>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                                <div class="position-absolute bottom-0 end-0 bg-success border border-white rounded-circle p-2" style="width: 50px; height: 50px;">
                                    <i class="fas fa-check text-white"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-1">Andre Oktfianus Sinaga</h3>
                            <p class="mb-0 opacity-75">NIM: 22171038</p>
                            <hr class="w-25 mx-auto border-2 opacity-100">
                        </div>
                    </div>

                    <!-- Bagian Detail -->
                    <div class="col-md-7">
                        <div class="card-body p-5">
                            <h4 class="fw-bold mb-4 text-primary border-bottom pb-2">Informasi Akademik</h4>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-light p-3 rounded-3 me-3">
                                            <i class="fas fa-university text-primary fa-lg"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Perguruan Tinggi</small>
                                            <span class="fw-bold">Universitas Mandiri Bina Prestasi Medan</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-light p-3 rounded-3 me-3">
                                            <i class="fas fa-graduation-cap text-success fa-lg"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Program Studi</small>
                                            <span class="fw-bold">Teknik Informatika (D3)</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-light p-3 rounded-3 me-3">
                                            <i class="fas fa-calendar-alt text-warning fa-lg"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Stambuk / Angkatan</small>
                                            <span class="fw-bold">2022</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <div class="bg-light p-3 rounded-3 me-3">
                                            <i class="fas fa-book text-danger fa-lg"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Judul Karya Tulis</small>
                                            <span class="fw-bold" style="font-size: 0.85rem;">Sistem Informasi Pemasaran Produk Tenun Berbasis Web</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-5">
                                <h5 class="fw-bold mb-3"><i class="fas fa-quote-left me-2 text-primary"></i> Moto Hidup</h5>
                                <div class="p-3 bg-light rounded-3 border-start border-4 border-primary italic">
                                    <p class="mb-0 text-muted" style="font-style: italic;">
                                        "Membangun teknologi bukan hanya soal baris kode, tapi tentang bagaimana solusi digital dapat melestarikan budaya lokal dan memajukan ekonomi masyarakat."
                                    </p>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 d-flex gap-2">
                                <a href="#" class="btn btn-outline-primary btn-sm rounded-pill px-3"><i class="fab fa-instagram me-1"></i> Instagram</a>
                                <a href="#" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="fab fa-github me-1"></i> GitHub</a>
                                <a href="#" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="fab fa-linkedin me-1"></i> LinkedIn</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
