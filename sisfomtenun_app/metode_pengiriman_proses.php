<?php
include 'config.php';

if (isset($_POST['aksi'])) {
    $aksi = $_POST['aksi'];

    if ($aksi == 'tambah') {
        $nama_metode = $_POST['nama_metode'];
        $biaya_per_kg = $_POST['biaya_per_kg'];
        $estimasi_hari = $_POST['estimasi_hari'];

        $stmt = $conn->prepare("INSERT INTO metode_pengiriman (nama_metode, biaya_per_kg, estimasi_hari) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $nama_metode, $biaya_per_kg, $estimasi_hari);

        if ($stmt->execute()) {
            header("Location: metode_pengiriman.php?status=success");
        } else {
            header("Location: metode_pengiriman.php?status=error");
        }
        $stmt->close();

    } elseif ($aksi == 'edit') {
        $id_metode = $_POST['id_metode'];
        $nama_metode = $_POST['nama_metode'];
        $biaya_per_kg = $_POST['biaya_per_kg'];
        $estimasi_hari = $_POST['estimasi_hari'];

        $stmt = $conn->prepare("UPDATE metode_pengiriman SET nama_metode = ?, biaya_per_kg = ?, estimasi_hari = ? WHERE id_metode = ?");
        $stmt->bind_param("sdsi", $nama_metode, $biaya_per_kg, $estimasi_hari, $id_metode);

        if ($stmt->execute()) {
            header("Location: metode_pengiriman.php?status=updated");
        } else {
            header("Location: metode_pengiriman.php?status=error");
        }
        $stmt->close();
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_metode = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM metode_pengiriman WHERE id_metode = ?");
    $stmt->bind_param("i", $id_metode);

    if ($stmt->execute()) {
        header("Location: metode_pengiriman.php?status=deleted");
    } else {
        header("Location: metode_pengiriman.php?status=error");
    }
    $stmt->close();
} else {
    header("Location: metode_pengiriman.php");
}

$conn->close();
?>
