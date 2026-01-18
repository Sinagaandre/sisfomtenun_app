<?php
include 'config.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $id_product = $_POST['id_product'];
        $id_bahan = $_POST['id_bahan_baku'];
        $jumlah = $_POST['jumlah_digunakan'];

        $stmt = $conn->prepare("INSERT INTO detail_produk_bahanbaku (id_product, id_bahan_baku, jumlah_digunakan) VALUES (?, ?, ?)");
        $stmt->bind_param("iid", $id_product, $id_bahan, $jumlah);

        if ($stmt->execute()) {
            header("Location: detail_produk_bahanbaku.php?status=success");
        } else {
            header("Location: detail_produk_bahanbaku.php?status=error");
        }
    } elseif ($_POST['aksi'] == 'edit') {
        $id = $_POST['id_detail_produk_bahanbaku'];
        $id_product = $_POST['id_product'];
        $id_bahan = $_POST['id_bahan_baku'];
        $jumlah = $_POST['jumlah_digunakan'];

        $stmt = $conn->prepare("UPDATE detail_produk_bahanbaku SET id_product=?, id_bahan_baku=?, jumlah_digunakan=? WHERE id_detail_produk_bahanbaku=?");
        $stmt->bind_param("iidi", $id_product, $id_bahan, $jumlah, $id);

        if ($stmt->execute()) {
            header("Location: detail_produk_bahanbaku.php?status=success");
        } else {
            header("Location: detail_produk_bahanbaku.php?status=error");
        }
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM detail_produk_bahanbaku WHERE id_detail_produk_bahanbaku = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: detail_produk_bahanbaku.php?status=deleted");
    } else {
        header("Location: detail_produk_bahanbaku.php?status=error");
    }
} else {
    header("Location: detail_produk_bahanbaku.php");
}
?>
