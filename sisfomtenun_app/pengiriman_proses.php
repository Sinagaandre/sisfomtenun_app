<?php
include 'config.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $id_pesanan = $_POST['id_pesanan'];
        $id_metode = $_POST['id_metode'];
        $tanggal = $_POST['tanggal_kirim'];
        $resi = $_POST['no_resi'];
        $status = $_POST['status_pengiriman'];

        $stmt = $conn->prepare("INSERT INTO pengiriman_tenun (id_pesanan, id_metode, tanggal_kirim, no_resi, status_pengiriman) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $id_pesanan, $id_metode, $tanggal, $resi, $status);

        if ($stmt->execute()) {
            header("Location: pengiriman.php?status=success");
        } else {
            header("Location: pengiriman.php?status=error");
        }
    } elseif ($_POST['aksi'] == 'edit') {
        $id = $_POST['id_pengiriman'];
        $id_metode = $_POST['id_metode'];
        $tanggal = $_POST['tanggal_kirim'];
        $resi = $_POST['no_resi'];
        $status = $_POST['status_pengiriman'];

        $stmt = $conn->prepare("UPDATE pengiriman_tenun SET id_metode=?, tanggal_kirim=?, no_resi=?, status_pengiriman=? WHERE id_pengiriman=?");
        $stmt->bind_param("isssi", $id_metode, $tanggal, $resi, $status, $id);

        if ($stmt->execute()) {
            header("Location: pengiriman.php?status=success");
        } else {
            header("Location: pengiriman.php?status=error");
        }
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM pengiriman_tenun WHERE id_pengiriman = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: pengiriman.php?status=deleted");
    } else {
        header("Location: pengiriman.php?status=error");
    }
} else {
    header("Location: pengiriman.php");
}
?>
