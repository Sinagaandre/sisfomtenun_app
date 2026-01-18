<?php
include 'config.php';

$sql = "CREATE TABLE IF NOT EXISTS konfirmasi_pembayaran (
    id_konfirmasi INT AUTO_INCREMENT PRIMARY KEY,
    id_pesanan INT NOT NULL,
    nama_pengirim VARCHAR(255) NOT NULL,
    bank_asal VARCHAR(100) NOT NULL,
    jumlah_bayar DECIMAL(15,2) NOT NULL,
    tanggal_bayar DATE NOT NULL,
    bukti_bayar VARCHAR(255) DEFAULT NULL,
    status_konfirmasi ENUM('Pending', 'Valid', 'Tidak Valid') DEFAULT 'Pending',
    catatan TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_pesanan) REFERENCES pesanan_tenun(id_pesanan) ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel konfirmasi_pembayaran berhasil dibuat atau sudah ada.";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
