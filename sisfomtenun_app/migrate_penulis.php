<?php
include 'config.php';

// Create table tentang_penulis
$sql = "CREATE TABLE IF NOT EXISTS tentang_penulis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    nim VARCHAR(50) NOT NULL,
    prodi VARCHAR(100) NOT NULL,
    universitas VARCHAR(255) NOT NULL,
    stambuk VARCHAR(10) NOT NULL,
    judul_karya VARCHAR(255) NOT NULL,
    foto VARCHAR(255) DEFAULT NULL,
    moto TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "Table 'tentang_penulis' created successfully.<br>";
    
    // Check if data already exists
    $check = $conn->query("SELECT * FROM tentang_penulis LIMIT 1");
    if ($check->num_rows == 0) {
        $insert = "INSERT INTO tentang_penulis (nama, nim, prodi, universitas, stambuk, judul_karya, moto) VALUES (
            'Andre Oktfianus Sinaga', 
            '22171038', 
            'Teknik Informatika (D3)', 
            'Universitas Mandiri Bina Prestasi Medan', 
            '2022', 
            'Sistem Informasi Pemasaran Produk Tenun Berbasis Web',
            'Membangun teknologi bukan hanya soal baris kode, tapi tentang bagaimana solusi digital dapat melestarikan budaya lokal dan memajukan ekonomi masyarakat.'
        )";
        if ($conn->query($insert)) {
            echo "Initial author data inserted successfully.";
        }
    }
} else {
    echo "Error creating table: " . $conn->error;
}
?>
