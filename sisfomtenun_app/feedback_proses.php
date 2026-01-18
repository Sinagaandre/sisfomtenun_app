<?php
session_start();
include 'config.php';

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $nama_customer = mysqli_real_escape_string($conn, $_POST['nama_customer']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
        $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

        $sql = "INSERT INTO feedback (nama_customer, email, kategori, pesan) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nama_customer, $email, $kategori, $pesan);

        if ($stmt->execute()) {
            header("Location: feedback_list.php?status=success_tambah");
        } else {
            header("Location: feedback_list.php?status=error");
        }
        $stmt->close();
    } elseif ($_POST['aksi'] == 'update_status') {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $sql = "UPDATE feedback SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $id);

        if ($stmt->execute()) {
            header("Location: feedback_list.php?status=success_update");
        } else {
            header("Location: feedback_list.php?status=error");
        }
        $stmt->close();
    }
} 
// Handle GET requests (for delete)
elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "DELETE FROM feedback WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: feedback_list.php?status=success_hapus");
    } else {
        header("Location: feedback_list.php?status=error");
    }
    $stmt->close();
} else {
    header("Location: feedback_list.php");
}

$conn->close();
?>
