<?php
include 'config.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $nama = $_POST['nama_pemasok_tenun'];
        $alamat = $_POST['alamat_pemasok_tenun'];
        $kontak = $_POST['kontak_pemasok_tenun'];
        $email = $_POST['email_pemasok_tenun'];

        $stmt = $conn->prepare("INSERT INTO pemasok_tenun (nama_pemasok_tenun, alamat_pemasok_tenun, kontak_pemasok_tenun, email_pemasok_tenun) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $alamat, $kontak, $email);

        if ($stmt->execute()) {
            header("Location: pemasok.php?status=success");
        } else {
            header("Location: pemasok.php?status=error");
        }
    } elseif ($_POST['aksi'] == 'edit') {
        $id = $_POST['id_pemasok'];
        $nama = $_POST['nama_pemasok_tenun'];
        $alamat = $_POST['alamat_pemasok_tenun'];
        $kontak = $_POST['kontak_pemasok_tenun'];
        $email = $_POST['email_pemasok_tenun'];

        $stmt = $conn->prepare("UPDATE pemasok_tenun SET nama_pemasok_tenun=?, alamat_pemasok_tenun=?, kontak_pemasok_tenun=?, email_pemasok_tenun=? WHERE id_pemasok=?");
        $stmt->bind_param("ssssi", $nama, $alamat, $kontak, $email, $id);

        if ($stmt->execute()) {
            header("Location: pemasok.php?status=success");
        } else {
            header("Location: pemasok.php?status=error");
        }
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM pemasok_tenun WHERE id_pemasok = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: pemasok.php?status=deleted");
    } else {
        header("Location: pemasok.php?status=error");
    }
} else {
    header("Location: pemasok.php");
}
?>
