<?php
include 'config.php';

$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : '';
$tgl_awal = isset($_GET['tgl_awal']) ? $_GET['tgl_awal'] : date('Y-m-01');
$tgl_akhir = isset($_GET['tgl_akhir']) ? $_GET['tgl_akhir'] : date('Y-m-d');

// Judul Laporan
$judul = "";
$periode = "";

switch ($jenis) {
    case 'pesanan':
        $judul = "Laporan Transaksi Pesanan";
        $periode = "Periode: " . date('d-m-Y', strtotime($tgl_awal)) . " s/d " . date('d-m-Y', strtotime($tgl_akhir));
        break;
    case 'stok':
        $judul = "Laporan Stok Produk Tenun";
        $periode = "Per Tanggal: " . date('d-m-Y');
        break;
    case 'pengiriman':
        $judul = "Laporan Pengiriman Barang";
        $periode = "Periode: " . date('d-m-Y', strtotime($tgl_awal)) . " s/d " . date('d-m-Y', strtotime($tgl_akhir));
        break;
    case 'customers':
        $judul = "Laporan Data Pelanggan";
        $periode = "Per Tanggal: " . date('d-m-Y');
        break;
    default:
        $judul = "Laporan";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $judul; ?></title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; font-size: 11pt; margin: 0; padding: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px double #000; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; font-size: 16pt; }
        .header p { margin: 5px 0; font-size: 10pt; }
        .info { margin-bottom: 20px; }
        .info h3 { margin: 0; text-transform: uppercase; font-size: 14pt; border-bottom: 1px solid #eee; display: inline-block; padding-bottom: 5px; }
        .info p { margin: 10px 0; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; font-weight: bold; text-transform: uppercase; font-size: 10pt; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .footer { margin-top: 50px; text-align: right; padding-right: 50px; }
        .footer p { margin: 0; }
        .signature-space { height: 80px; }
        
        @media print {
            .no-print { display: none; }
            @page { margin: 1.5cm; }
            body { padding: 0; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 20px; background: #f8f9fa; padding: 15px; border-radius: 8px; border: 1px solid #ddd; display: flex; justify-content: space-between; align-items: center;">
        <div>
            <strong>Mode Pratinjau Cetak:</strong> Gunakan tombol di samping atau tekan <code>Ctrl + P</code> untuk menyimpan sebagai PDF.
        </div>
        <div>
            <button onclick="window.print()" style="padding: 8px 16px; cursor: pointer; background: #007bff; color: white; border: none; border-radius: 4px; font-weight: bold;">
                <i class="fas fa-print"></i> Cetak / Simpan PDF
            </button>
            <button onclick="window.close()" style="padding: 8px 16px; cursor: pointer; background: #6c757d; color: white; border: none; border-radius: 4px; margin-left: 5px;">Tutup</button>
        </div>
    </div>

    <div class="header">
        <h2>Sistem Informasi Pemasaran Produk Tenun</h2>
        <p>Sentra Kerajinan Tenun Tradisional Indonesia</p>
        <p>Jalan Utama Tenun No. 123, Kawasan Industri Kreatif, Indonesia</p>
        <p>Telp: (021) 1234-5678 | Website: www.sisfomtenun.com | Email: info@tenun.com</p>
    </div>

    <div class="info">
        <h3><?php echo $judul; ?></h3>
        <p><?php echo $periode; ?></p>
    </div>

    <table>
        <thead>
            <?php if ($jenis == 'pesanan'): ?>
                <tr>
                    <th width="5%">No</th>
                    <th>ID Pesanan</th>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                </tr>
            <?php elseif ($jenis == 'stok'): ?>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Produk</th>
                    <th>Jenis Kain</th>
                    <th>Motif</th>
                    <th>Warna</th>
                    <th width="15%">Harga Satuan</th>
                    <th width="10%">Stok</th>
                </tr>
            <?php elseif ($jenis == 'pengiriman'): ?>
                <tr>
                    <th width="5%">No</th>
                    <th>Tanggal Kirim</th>
                    <th>ID Pesanan</th>
                    <th>Metode</th>
                    <th>No Resi</th>
                    <th>Status</th>
                </tr>
            <?php elseif ($jenis == 'customers'): ?>
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Lengkap</th>
                    <th>Alamat</th>
                    <th>No Telepon</th>
                    <th>Email</th>
                </tr>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if ($jenis == 'pesanan') {
                $sql = "SELECT p.*, c.nama_customers 
                        FROM pesanan_tenun p 
                        LEFT JOIN customers c ON p.id_customers = c.id_customers 
                        WHERE p.tanggal_pesanan BETWEEN '$tgl_awal' AND '$tgl_akhir' 
                        ORDER BY p.tanggal_pesanan DESC";
                $result = $conn->query($sql);
                $total_pendapatan = 0;
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $total_pendapatan += $row['total_harga'];
                        echo "<tr>
                                <td class='text-center'>$no</td>
                                <td class='text-center'>#" . $row['id_pesanan'] . "</td>
                                <td class='text-center'>" . date('d/m/Y', strtotime($row['tanggal_pesanan'])) . "</td>
                                <td>" . htmlspecialchars($row['nama_customers']) . "</td>
                                <td class='text-center'>" . ucfirst($row['status_pesanan']) . "</td>
                                <td class='text-right'>Rp " . number_format($row['total_harga'], 0, ',', '.') . "</td>
                              </tr>";
                        $no++;
                    }
                    echo "<tr>
                            <td colspan='5' class='text-right'><strong>TOTAL PENDAPATAN</strong></td>
                            <td class='text-right'><strong>Rp " . number_format($total_pendapatan, 0, ',', '.') . "</strong></td>
                          </tr>";
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data pada periode ini</td></tr>";
                }

            } elseif ($jenis == 'stok') {
                $sql = "SELECT * FROM product_tenun ORDER BY stok ASC, nama_product ASC";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $stok_alert = ($row['stok'] <= 5) ? "color: red; font-weight: bold;" : "";
                        echo "<tr>
                                <td class='text-center'>$no</td>
                                <td>" . htmlspecialchars($row['nama_product']) . "</td>
                                <td>" . htmlspecialchars($row['jenis_kain']) . "</td>
                                <td>" . htmlspecialchars($row['motif']) . "</td>
                                <td>" . htmlspecialchars($row['warna']) . "</td>
                                <td class='text-right'>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                                <td class='text-center' style='$stok_alert'>" . $row['stok'] . "</td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Data produk kosong</td></tr>";
                }

            } elseif ($jenis == 'pengiriman') {
                $sql = "SELECT pg.*, m.nama_metode 
                        FROM pengiriman_tenun pg
                        LEFT JOIN metode_pengiriman m ON pg.id_metode = m.id_metode
                        WHERE pg.tanggal_kirim BETWEEN '$tgl_awal' AND '$tgl_akhir'
                        ORDER BY pg.tanggal_kirim DESC";
                
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='text-center'>$no</td>
                                <td class='text-center'>" . date('d/m/Y', strtotime($row['tanggal_kirim'])) . "</td>
                                <td class='text-center'>#" . $row['id_pesanan'] . "</td>
                                <td>" . htmlspecialchars($row['nama_metode'] ?? '-') . "</td>
                                <td class='text-center'>" . htmlspecialchars($row['no_resi']) . "</td>
                                <td class='text-center'>" . $row['status_pengiriman'] . "</td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data pengiriman pada periode ini</td></tr>";
                }

            } elseif ($jenis == 'customers') {
                $sql = "SELECT * FROM customers ORDER BY nama_customers ASC";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td class='text-center'>$no</td>
                                <td>" . htmlspecialchars($row['nama_customers']) . "</td>
                                <td>" . htmlspecialchars($row['alamat']) . "</td>
                                <td class='text-center'>" . htmlspecialchars($row['no_telepon']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Data pelanggan kosong</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: <?php echo date('d/m/Y H:i:s'); ?></p>
        <p>Kota Tenun, <?php echo date('d F Y'); ?></p>
        <p>Mengetahui,</p>
        <div class="signature-space"></div>
        <p><strong>( Andre Sinaga )</strong></p>
        <p>Administrator Sistem</p>
    </div>

</body>
</html>
