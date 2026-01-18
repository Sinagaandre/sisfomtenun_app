<?php
include 'config.php';

if (isset($_POST['aksi'])) {
    if ($_POST['aksi'] == 'tambah') {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];
        $universitas = $_POST['universitas'];
        $stambuk = $_POST['stambuk'];
        $judul_karya = $_POST['judul_karya'];
        $moto = $_POST['moto'];

        // Handle Photo Upload
        $foto = "";
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $target_dir = "assets/img/penulis/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
            $new_filename = time() . '_' . uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $foto = $new_filename;
            }
        }

        $stmt = $conn->prepare("INSERT INTO tentang_penulis (nama, nim, prodi, universitas, stambuk, judul_karya, moto, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $nama, $nim, $prodi, $universitas, $stambuk, $judul_karya, $moto, $foto);

        if ($stmt->execute()) {
            header("Location: penulis.php?status=success");
        } else {
            header("Location: penulis.php?status=error");
        }
    } elseif ($_POST['aksi'] == 'edit') {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];
        $universitas = $_POST['universitas'];
        $stambuk = $_POST['stambuk'];
        $judul_karya = $_POST['judul_karya'];
        $moto = $_POST['moto'];

        // Get current photo
        $stmt_get = $conn->prepare("SELECT foto FROM tentang_penulis WHERE id = ?");
        $stmt_get->bind_param("i", $id);
        $stmt_get->execute();
        $res_get = $stmt_get->get_result();
        $row_get = $res_get->fetch_assoc();
        $foto = $row_get['foto'];

        // Handle New Photo Upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
            $target_dir = "assets/img/penulis/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_extension = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
            $new_filename = time() . '_' . uniqid() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                // Delete old photo if exists
                if ($foto && file_exists($target_dir . $foto)) {
                    unlink($target_dir . $foto);
                }
                $foto = $new_filename;
            }
        }

        $stmt = $conn->prepare("UPDATE tentang_penulis SET nama=?, nim=?, prodi=?, universitas=?, stambuk=?, judul_karya=?, moto=?, foto=? WHERE id=?");
        $stmt->bind_param("ssssssssi", $nama, $nim, $prodi, $universitas, $stambuk, $judul_karya, $moto, $foto, $id);

        if ($stmt->execute()) {
            header("Location: penulis.php?status=success");
        } else {
            header("Location: penulis.php?status=error");
        }
    }
} elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id = $_GET['id'];
    
    // Delete photo file first
    $stmt_get = $conn->prepare("SELECT foto FROM tentang_penulis WHERE id = ?");
    $stmt_get->bind_param("i", $id);
    $stmt_get->execute();
    $res_get = $stmt_get->get_result();
    $row_get = $res_get->fetch_assoc();
    if ($row_get['foto']) {
        $img_path = "assets/img/penulis/" . $row_get['foto'];
        if (file_exists($img_path)) {
            unlink($img_path);
        }
    }

    $stmt = $conn->prepare("DELETE FROM tentang_penulis WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: penulis.php?status=deleted");
    } else {
        header("Location: penulis.php?status=error");
    }
} else {
    header("Location: penulis.php");
}
?>
