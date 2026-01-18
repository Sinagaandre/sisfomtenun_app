<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

include '../config.php';

$response = array();

// Query untuk mengambil semua data produk tenun
$sql = "SELECT * FROM product_tenun ORDER BY id_product DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $response['status'] = "success";
    $response['message'] = "Data produk berhasil ditemukan";
    $response['data'] = array();
    
    while($row = $result->fetch_assoc()) {
        $product = array(
            "id" => $row['id_product'],
            "nama" => $row['nama_product'],
            "jenis" => $row['jenis_kain'],
            "motif" => $row['motif'],
            "warna" => $row['warna'],
            "ukuran" => $row['ukuran'],
            "harga" => (int)$row['harga'],
            "stok" => (int)$row['stok'],
            "harga_format" => "Rp " . number_format($row['harga'], 0, ',', '.')
        );
        array_push($response['data'], $product);
    }
} else {
    $response['status'] = "error";
    $response['message'] = "Data produk tidak ditemukan";
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
