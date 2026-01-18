-- Database: sisfomtenun

CREATE DATABASE IF NOT EXISTS sisfomtenun;
USE sisfomtenun;

-- 8. Entitas Customers
CREATE TABLE IF NOT EXISTS customers (
    id_customers INT AUTO_INCREMENT PRIMARY KEY,
    nama_customers VARCHAR(255) NOT NULL,
    alamat TEXT NOT NULL,
    no_telepon VARCHAR(20) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL
);

-- 4. Entitas Pemasok Tenun
CREATE TABLE IF NOT EXISTS pemasok_tenun (
    id_pemasok INT AUTO_INCREMENT PRIMARY KEY,
    nama_pemasok_tenun VARCHAR(255) NOT NULL,
    alamat_pemasok_tenun TEXT NOT NULL,
    kontak_pemasok_tenun VARCHAR(20) NOT NULL,
    email_pemasok_tenun VARCHAR(255) NOT NULL
);

-- 5. Entitas Metode Pengiriman Pesanan Tenun
CREATE TABLE IF NOT EXISTS metode_pengiriman (
    id_metode INT AUTO_INCREMENT PRIMARY KEY,
    nama_metode VARCHAR(100) NOT NULL,
    biaya_per_kg DECIMAL(10, 2) NOT NULL,
    estimasi_hari INT NOT NULL
);

-- 1. Entitas Product Tenun
CREATE TABLE IF NOT EXISTS product_tenun (
    id_product INT AUTO_INCREMENT PRIMARY KEY,
    nama_product VARCHAR(255) NOT NULL,
    jenis_kain VARCHAR(100) NOT NULL,
    motif VARCHAR(100) NOT NULL,
    warna VARCHAR(50) NOT NULL,
    ukuran VARCHAR(50) NOT NULL,
    harga DECIMAL(10, 2) NOT NULL,
    stok INT NOT NULL
);

-- 9. Entitas Bahan Baku Tenun
CREATE TABLE IF NOT EXISTS bahan_baku_tenun (
    id_bahan_baku INT AUTO_INCREMENT PRIMARY KEY,
    nama_bahan_baku_tenun VARCHAR(255) NOT NULL,
    jenis_bahan_baku_tenun VARCHAR(100) NOT NULL,
    satuan VARCHAR(20) NOT NULL,
    harga_per_satuan DECIMAL(10, 2) NOT NULL,
    stok_bahan DECIMAL(10, 2) NOT NULL,
    id_pemasok INT,
    FOREIGN KEY (id_pemasok) REFERENCES pemasok_tenun(id_pemasok) ON DELETE SET NULL
);

-- 6. Entitas Detail Produk Bahan Baku Tenun
CREATE TABLE IF NOT EXISTS detail_produk_bahanbaku (
    id_detail_produk_bahanbaku INT AUTO_INCREMENT PRIMARY KEY,
    id_product INT,
    id_bahan_baku INT,
    jumlah_digunakan DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_product) REFERENCES product_tenun(id_product) ON DELETE CASCADE,
    FOREIGN KEY (id_bahan_baku) REFERENCES bahan_baku_tenun(id_bahan_baku) ON DELETE CASCADE
);

-- 2. Entitas Pesanan Tenun
CREATE TABLE IF NOT EXISTS pesanan_tenun (
    id_pesanan INT AUTO_INCREMENT PRIMARY KEY,
    id_customers INT,
    tanggal_pesanan DATE NOT NULL,
    total_harga DECIMAL(10, 2) NOT NULL,
    status_pesanan ENUM('proses', 'selesai') NOT NULL,
    FOREIGN KEY (id_customers) REFERENCES customers(id_customers) ON DELETE CASCADE
);

-- 7. Entitas Detail Pesanan Tenun
CREATE TABLE IF NOT EXISTS detail_pesanan_tenun (
    id_detail_pesanan INT AUTO_INCREMENT PRIMARY KEY,
    id_pesanan INT,
    id_product INT,
    jumlah_produk INT NOT NULL,
    harga_satuan DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (id_pesanan) REFERENCES pesanan_tenun(id_pesanan) ON DELETE CASCADE,
    FOREIGN KEY (id_product) REFERENCES product_tenun(id_product) ON DELETE CASCADE
);

-- 3. Entitas Pengiriman Tenun
CREATE TABLE IF NOT EXISTS pengiriman_tenun (
    id_pengiriman INT AUTO_INCREMENT PRIMARY KEY,
    id_pesanan INT,
    id_metode INT,
    no_resi VARCHAR(100) NOT NULL,
    status_pengiriman ENUM('Dikirim', 'Dalam Perjalanan', 'Diterima') NOT NULL,
    tanggal_kirim DATE NOT NULL,
    FOREIGN KEY (id_pesanan) REFERENCES pesanan_tenun(id_pesanan) ON DELETE CASCADE,
    FOREIGN KEY (id_metode) REFERENCES metode_pengiriman(id_metode) ON DELETE SET NULL
);

-- Table Admin for Login
CREATE TABLE IF NOT EXISTS admin (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- Will store hashed password
    nama_lengkap VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Default Admin (Password: admin123)
-- Using MD5 for simplicity in this D3 project context, but I will comment about BCrypt for production.
-- However, standard PHP now uses password_hash (BCrypt default). I will use password_hash.
-- The hash below is generated for 'admin123' using password_hash('admin123', PASSWORD_DEFAULT).
-- Since I can't generate it dynamically in SQL easily without a function, I'll insert a known hash or handle it in seeding.
-- For now, I'll insert a raw MD5 or just a placeholder and create a seeder script.
-- Actually, let's just use a simple seed php script later.
