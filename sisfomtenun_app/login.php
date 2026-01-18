<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SISFOMTENUN Tarutung</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="login-body">

<div class="login-container">
    <!-- Left Side: Information & Branding -->
    <div class="login-info">
        <h2>Tenun Tarutung</h2>
        <p>Representasi Keunggulan Tekstil Tradisional Batak Toba dalam Perspektif Ekonomi Digital.</p>
        
        <div class="info-box">
            <h5>Analisis Budaya & Bisnis</h5>
            <p style="font-size: 0.9rem; margin-bottom: 0; text-align: justify;">
                Karya Tulis Ilmiah ini mengeksplorasi integrasi sistem informasi pada pemasaran Tenun Tarutung (seperti Tumtuman, Ulos, dan Sarung). Pendekatan ini bertujuan untuk meningkatkan daya saing perajin lokal di pasar global melalui digitalisasi rantai pasok dan manajemen hubungan pelanggan.
            </p>
        </div>

        <div class="mt-4">
            <small class="text-white-50"><i class="fas fa-university me-2"></i> Kapita Selekta - Sistem Informasi</small>
        </div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="login-form">
        <div class="text-center mb-4 d-md-none">
            <h2 class="text-primary fw-bold">SISFOMTENUN</h2>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3>Selamat Datang</h3>
            <a href="index.php" class="text-decoration-none small fw-bold text-primary"><i class="fas fa-home me-1"></i> Beranda</a>
        </div>
        <p>Silakan masuk untuk mengelola sistem informasi pemasaran tenun.</p>

        <?php 
        if(isset($_GET['error'])) {
            echo '<div class="alert alert-danger py-3 shadow-sm border-0 d-flex align-items-center" style="border-radius: 12px; background-color: #f8d7da; color: #842029;">
                    <i class="fas fa-exclamation-triangle fs-4 me-3"></i>
                    <div>
                        <strong class="d-block">Akses Ditolak</strong>
                        <span class="small">Username atau password tidak valid.</span>
                    </div>
                  </div>';
        }
        if(isset($_GET['logout'])) {
            echo '<div class="alert alert-success py-3 shadow-sm border-0 d-flex align-items-center" style="border-radius: 12px; background-color: #d1e7dd; color: #0f5132;">
                    <i class="fas fa-check-circle fs-4 me-3"></i> 
                    <div>
                        <strong class="d-block">Logout Berhasil</strong>
                        <span class="small">Sesi Anda telah berakhir dengan aman.</span>
                    </div>
                  </div>';
        }
        ?>

        <form action="login_process.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label small fw-bold">Username</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                        <i class="fas fa-user text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" id="username" name="username" placeholder="Masukkan username" required style="border-radius: 0 10px 10px 0;">
                </div>
            </div>
            
            <div class="mb-3">
                <label for="password" class="form-label small fw-bold">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0" style="border-radius: 10px 0 0 10px;">
                        <i class="fas fa-lock text-muted"></i>
                    </span>
                    <input type="password" class="form-control border-start-0" id="password" name="password" placeholder="Masukkan password" required style="border-radius: 0 10px 10px 0;">
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100">
                Masuk ke Sistem <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="footer-text">
            &copy; 2026 SISFOMTENUN Tarutung. All Rights Reserved.<br>
            Karya Tulis Ilmiah - Kapita Selekta
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
