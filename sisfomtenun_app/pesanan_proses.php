<?php
include 'config.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $id_customers = $_POST['id_customers'];
        $tanggal = $_POST['tanggal_pesanan'];
        $status = $_POST['status_pesanan'];
        $total_harga = $_POST['total_harga'];
        $items = isset($_POST['items']) ? $_POST['items'] : [];

        if (empty($items)) {
            header("Location: pesanan_tambah.php?error=no_items");
            exit;
        }

        // Start transaction
        $conn->begin_transaction();

        try {
            // 1. Insert into pesanan_tenun
            $stmt = $conn->prepare("INSERT INTO pesanan_tenun (id_customers, tanggal_pesanan, total_harga, status_pesanan) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isds", $id_customers, $tanggal, $total_harga, $status);
            $stmt->execute();
            $id_pesanan = $conn->insert_id;

            // 2. Insert into detail_pesanan_tenun
            $stmt_detail = $conn->prepare("INSERT INTO detail_pesanan_tenun (id_pesanan, id_product, jumlah_produk, harga_satuan, subtotal) VALUES (?, ?, ?, ?, ?)");
            
            // 3. Update stock (optional, but good practice)
            $stmt_stock = $conn->prepare("UPDATE product_tenun SET stok = stok - ? WHERE id_product = ?");

            foreach ($items as $item) {
                $id_product = $item['id_product'];
                $qty = $item['jumlah_produk'];
                $harga = $item['harga_satuan'];
                $subtotal = $item['subtotal'];

                // Insert Detail
                $stmt_detail->bind_param("iiidd", $id_pesanan, $id_product, $qty, $harga, $subtotal);
                $stmt_detail->execute();

                // Update Stock
                $stmt_stock->bind_param("ii", $qty, $id_product);
                $stmt_stock->execute();
            }

            $conn->commit();
            header("Location: pesanan.php?status=success");

        } catch (Exception $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
            // header("Location: pesanan.php?status=error");
        }

    } elseif ($_POST['aksi'] == 'update_status') {
        $id = $_POST['id_pesanan'];
        $status = $_POST['status_pesanan'];

        $stmt = $conn->prepare("UPDATE pesanan_tenun SET status_pesanan = ? WHERE id_pesanan = ?");
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            header("Location: pesanan.php?status=updated");
        } else {
            header("Location: pesanan.php?status=error");
        }
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    // Because of ON DELETE CASCADE in schema, deleting order will delete details too
    $stmt = $conn->prepare("DELETE FROM pesanan_tenun WHERE id_pesanan = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: pesanan.php?status=deleted");
    } else {
        header("Location: pesanan.php?status=error");
    }
} else {
    header("Location: pesanan.php");
}
?>
