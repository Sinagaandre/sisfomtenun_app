<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $id_pesanan = mysqli_real_escape_string($conn, $_POST['id_pesanan']);
        $nama_pengirim = mysqli_real_escape_string($conn, $_POST['nama_pengirim']);
        $bank_asal = mysqli_real_escape_string($conn, $_POST['bank_asal']);
        $jumlah_bayar = mysqli_real_escape_string($conn, $_POST['jumlah_bayar']);
        $tanggal_bayar = mysqli_real_escape_string($conn, $_POST['tanggal_bayar']);
        $catatan = mysqli_real_escape_string($conn, $_POST['catatan']);

        // Handle File Upload
        $bukti_bayar = "";
        if (isset($_FILES['bukti_bayar']) && $_FILES['bukti_bayar']['error'] == 0) {
            $target_dir = "assets/img/konfirmasi/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_extension = pathinfo($_FILES["bukti_bayar"]["name"], PATHINFO_EXTENSION);
            $new_filename = "konf_" . $id_pesanan . "_" . time() . "." . $file_extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES["bukti_bayar"]["tmp_name"], $target_file)) {
                $bukti_bayar = $new_filename;
            }
        }

        $sql = "INSERT INTO konfirmasi_pembayaran (id_pesanan, nama_pengirim, bank_asal, jumlah_bayar, tanggal_bayar, bukti_bayar, catatan) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issdsss", $id_pesanan, $nama_pengirim, $bank_asal, $jumlah_bayar, $tanggal_bayar, $bukti_bayar, $catatan);

        if ($stmt->execute()) {
            // Optional: Update order status to something like 'menunggu verifikasi'
            $conn->query("UPDATE pesanan_tenun SET status_pesanan = 'proses' WHERE id_pesanan = $id_pesanan");
            header("Location: konfirmasi_list.php?status=success_tambah");
        } else {
            header("Location: konfirmasi.php?status=error");
        }
        $stmt->close();
    } elseif ($_POST['aksi'] == 'update_status') {
        $id_konfirmasi = mysqli_real_escape_string($conn, $_POST['id_konfirmasi']);
        $id_pesanan = mysqli_real_escape_string($conn, $_POST['id_pesanan']);
        $status = mysqli_real_escape_string($conn, $_POST['status_konfirmasi']);

        $sql = "UPDATE konfirmasi_pembayaran SET status_konfirmasi = ? WHERE id_konfirmasi = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $status, $id_konfirmasi);

        if ($stmt->execute()) {
            if ($status == 'Valid') {
                $conn->query("UPDATE pesanan_tenun SET status_pesanan = 'selesai' WHERE id_pesanan = $id_pesanan");
            }
            header("Location: konfirmasi_list.php?status=success_update");
        } else {
            header("Location: konfirmasi_list.php?status=error");
        }
        $stmt->close();
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus' && isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Get filename to delete
    $res = $conn->query("SELECT bukti_bayar FROM konfirmasi_pembayaran WHERE id_konfirmasi = $id");
    if ($row = $res->fetch_assoc()) {
        if (!empty($row['bukti_bayar'])) {
            @unlink("assets/img/konfirmasi/" . $row['bukti_bayar']);
        }
    }

    $sql = "DELETE FROM konfirmasi_pembayaran WHERE id_konfirmasi = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: konfirmasi_list.php?status=success_hapus");
    } else {
        header("Location: konfirmasi_list.php?status=error");
    }
    $stmt->close();
} else {
    header("Location: konfirmasi_list.php");
}

$conn->close();
?>
