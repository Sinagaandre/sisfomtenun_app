<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prevent SQL Injection
    $stmt = $conn->prepare("SELECT id_admin, password, nama_lengkap FROM admin WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Password correct
            $_SESSION['id_admin'] = $row['id_admin'];
            $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
            $_SESSION['status'] = "login";
            
            header("Location: dashboard.php");
            exit();
        } else {
            // Password incorrect
            header("Location: login.php?error=1");
            exit();
        }
    } else {
        // Username not found
        header("Location: login.php?error=1");
        exit();
    }
} else {
    header("Location: login.php");
}
?>
