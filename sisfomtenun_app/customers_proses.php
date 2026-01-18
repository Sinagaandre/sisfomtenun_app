<?php
include 'config.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $nama = $_POST['nama_customers'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['no_telepon'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("INSERT INTO customers (nama_customers, alamat, no_telepon, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $alamat, $telepon, $email);

        if ($stmt->execute()) {
            header("Location: customers.php?status=success");
        } else {
            header("Location: customers.php?status=error");
        }
    } elseif ($_POST['aksi'] == 'edit') {
        $id = $_POST['id_customers'];
        $nama = $_POST['nama_customers'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['no_telepon'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE customers SET nama_customers=?, alamat=?, no_telepon=?, email=? WHERE id_customers=?");
        $stmt->bind_param("ssssi", $nama, $alamat, $telepon, $email, $id);

        if ($stmt->execute()) {
            header("Location: customers.php?status=success");
        } else {
            header("Location: customers.php?status=error");
        }
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM customers WHERE id_customers = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: customers.php?status=deleted");
    } else {
        header("Location: customers.php?status=error");
    }
} else {
    header("Location: customers.php");
}
?>
