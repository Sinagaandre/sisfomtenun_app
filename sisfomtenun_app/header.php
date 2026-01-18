<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SISFOMTENUN</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="sidebar">
    <h4 class="text-center text-white mb-4 pt-3">SISFOMTENUN</h4>
    <a href="dashboard.php"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
    <a href="product.php"><i class="fas fa-box me-2"></i> Produk Tenun</a>
    <a href="budaya_tenun.php"><i class="fas fa-palette me-2"></i> Budaya & Penenun</a>
    <a href="customers.php"><i class="fas fa-users me-2"></i> Customers</a>
    <a href="pemasok.php"><i class="fas fa-handshake me-2"></i> Pemasok</a>
    <a href="bahan_baku.php"><i class="fas fa-layer-group me-2"></i> Bahan Baku</a>
    <a href="detail_produk_bahanbaku.php"><i class="fas fa-puzzle-piece me-2"></i> Detail Bahan Produk</a>
    <a href="metode_pengiriman.php"><i class="fas fa-truck-loading me-2"></i> Metode Kirim</a>
    <a href="pesanan.php"><i class="fas fa-shopping-cart me-2"></i> Pesanan</a>
    <a href="konfirmasi_list.php"><i class="fas fa-check-double me-2"></i> Konfirmasi Bayar</a>
    <a href="pengiriman.php"><i class="fas fa-truck me-2"></i> Pengiriman</a>
    <a href="laporan.php"><i class="fas fa-file-invoice me-2"></i> Laporan</a>
    <a href="analisis.php"><i class="fas fa-chart-pie me-2"></i> Analisis Data</a>
    <a href="feedback_list.php"><i class="fas fa-comment-dots me-2"></i> Feedback & Keluhan</a>
    <a href="api_doc.php"><i class="fas fa-code me-2"></i> API Documentation</a>
    <a href="penulis.php"><i class="fas fa-user-edit me-2"></i> Manajemen Penulis</a>
    <hr class="text-white">
    <a href="index.php" target="_blank"><i class="fas fa-external-link-alt me-2"></i> Lihat Website</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
</div>

<div class="content">
    <nav class="navbar navbar-light bg-light mb-4 shadow-sm rounded">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">
                <i class="fas fa-laptop-code me-2 text-primary"></i>
                Selamat Datang, <span class="fw-bold text-dark">sisfomtenun_app</span>
            </span>
        </div>
    </nav>
    
    <div class="container-fluid">
