<?php
include 'config.php';

$sql = "CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_customer VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    kategori ENUM('Keluhan Sistem', 'Saran Produk', 'Pelayanan', 'Lainnya') DEFAULT 'Keluhan Sistem',
    pesan TEXT NOT NULL,
    status ENUM('Pending', 'Diproses', 'Selesai') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel feedback berhasil dibuat atau sudah ada.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
