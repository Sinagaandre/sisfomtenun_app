<?php
include 'config.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $nama = $_POST['nama_bahan_baku_tenun'];
        $jenis = $_POST['jenis_bahan_baku_tenun'];
        $satuan = $_POST['satuan'];
        $harga = $_POST['harga_per_satuan'];
        $stok = $_POST['stok_bahan'];
        $id_pemasok = !empty($_POST['id_pemasok']) ? $_POST['id_pemasok'] : NULL;

        $stmt = $conn->prepare("INSERT INTO bahan_baku_tenun (nama_bahan_baku_tenun, jenis_bahan_baku_tenun, satuan, harga_per_satuan, stok_bahan, id_pemasok) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssdii", $nama, $jenis, $satuan, $harga, $stok, $id_pemasok);

        if ($stmt->execute()) {
            header("Location: bahan_baku.php?status=success");
        } else {
            echo $stmt->error; exit;
            header("Location: bahan_baku.php?status=error");
        }
    } elseif ($_POST['aksi'] == 'edit') {
        $id = $_POST['id_bahan_baku'];
        $nama = $_POST['nama_bahan_baku_tenun'];
        $jenis = $_POST['jenis_bahan_baku_tenun'];
        $satuan = $_POST['satuan'];
        $harga = $_POST['harga_per_satuan'];
        $stok = $_POST['stok_bahan'];
        $id_pemasok = !empty($_POST['id_pemasok']) ? $_POST['id_pemasok'] : NULL;

        $stmt = $conn->prepare("UPDATE bahan_baku_tenun SET nama_bahan_baku_tenun=?, jenis_bahan_baku_tenun=?, satuan=?, harga_per_satuan=?, stok_bahan=?, id_pemasok=? WHERE id_bahan_baku=?");
        $stmt->bind_param("sssdiii", $nama, $jenis, $satuan, $harga, $stok, $id_pemasok, $id);

        if ($stmt->execute()) {
            header("Location: bahan_baku.php?status=success");
        } else {
            header("Location: bahan_baku.php?status=error");
        }
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM bahan_baku_tenun WHERE id_bahan_baku = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: bahan_baku.php?status=deleted");
    } else {
        header("Location: bahan_baku.php?status=error");
    }
} else {
    header("Location: bahan_baku.php");
}
?>
