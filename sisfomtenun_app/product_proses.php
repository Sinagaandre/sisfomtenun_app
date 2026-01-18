<?php
include 'config.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $nama_product = $_POST['nama_product'];
        $jenis_kain = $_POST['jenis_kain'];
        $motif = $_POST['motif'];
        $warna = $_POST['warna'];
        $ukuran = $_POST['ukuran'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // Handle File Upload
        $gambar = "";
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $target_dir = "assets/img/produk/";
            $file_extension = pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION);
            $new_filename = time() . '_' . uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                $gambar = $new_filename;
            }
        }

        $stmt = $conn->prepare("INSERT INTO product_tenun (nama_product, jenis_kain, motif, warna, ukuran, harga, stok, gambar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssdis", $nama_product, $jenis_kain, $motif, $warna, $ukuran, $harga, $stok, $gambar);

        if ($stmt->execute()) {
            header("Location: product.php?status=success");
        } else {
            header("Location: product.php?status=error");
        }
    } elseif ($_POST['aksi'] == 'edit') {
        $id_product = $_POST['id_product'];
        $nama_product = $_POST['nama_product'];
        $jenis_kain = $_POST['jenis_kain'];
        $motif = $_POST['motif'];
        $warna = $_POST['warna'];
        $ukuran = $_POST['ukuran'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // Get current image
        $stmt_get = $conn->prepare("SELECT gambar FROM product_tenun WHERE id_product = ?");
        $stmt_get->bind_param("i", $id_product);
        $stmt_get->execute();
        $res_get = $stmt_get->get_result();
        $row_get = $res_get->fetch_assoc();
        $gambar = $row_get['gambar'];

        // Handle New File Upload
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $target_dir = "assets/img/produk/";
            $file_extension = pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION);
            $new_filename = time() . '_' . uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                // Delete old image if exists
                if ($gambar && file_exists($target_dir . $gambar)) {
                    unlink($target_dir . $gambar);
                }
                $gambar = $new_filename;
            }
        }

        $stmt = $conn->prepare("UPDATE product_tenun SET nama_product=?, jenis_kain=?, motif=?, warna=?, ukuran=?, harga=?, stok=?, gambar=? WHERE id_product=?");
        $stmt->bind_param("sssssdiss", $nama_product, $jenis_kain, $motif, $warna, $ukuran, $harga, $stok, $gambar, $id_product);

        if ($stmt->execute()) {
            header("Location: product.php?status=success");
        } else {
            header("Location: product.php?status=error");
        }
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    
    // Delete image file first
    $stmt_get = $conn->prepare("SELECT gambar FROM product_tenun WHERE id_product = ?");
    $stmt_get->bind_param("i", $id);
    $stmt_get->execute();
    $res_get = $stmt_get->get_result();
    $row_get = $res_get->fetch_assoc();
    if ($row_get['gambar']) {
        $img_path = "assets/img/produk/" . $row_get['gambar'];
        if (file_exists($img_path)) {
            unlink($img_path);
        }
    }

    $stmt = $conn->prepare("DELETE FROM product_tenun WHERE id_product = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: product.php?status=deleted");
    } else {
        header("Location: product.php?status=error");
    }
} else {
    header("Location: product.php");
}
?>
