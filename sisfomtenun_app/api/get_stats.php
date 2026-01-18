<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

include '../config.php';

$response = array();

try {
    // Get counts
    $count_products = $conn->query("SELECT COUNT(*) as total FROM product_tenun")->fetch_assoc()['total'];
    $count_orders = $conn->query("SELECT COUNT(*) as total FROM pesanan_tenun")->fetch_assoc()['total'];
    $count_customers = $conn->query("SELECT COUNT(*) as total FROM customers")->fetch_assoc()['total'];
    
    // Get total revenue
    $total_revenue = $conn->query("SELECT SUM(total_harga) as total FROM pesanan_tenun")->fetch_assoc()['total'];

    $response['status'] = "success";
    $response['message'] = "Statistik sistem informasi tenun";
    $response['data'] = array(
        "total_produk" => (int)$count_products,
        "total_pesanan" => (int)$count_orders,
        "total_pelanggan" => (int)$count_customers,
        "total_pendapatan" => (int)$total_revenue,
        "pendapatan_format" => "Rp " . number_format($total_revenue, 0, ',', '.')
    );

} catch (Exception $e) {
    $response['status'] = "error";
    $response['message'] = "Gagal mengambil statistik: " . $e->getMessage();
}

echo json_encode($response, JSON_PRETTY_PRINT);
?>
