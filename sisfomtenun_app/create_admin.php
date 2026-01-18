<?php
include 'config.php';

$username = 'admin';
$password = 'admin123';
$nama_lengkap = 'Administrator Utama';

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if username already exists
$check_sql = "SELECT id_admin FROM admin WHERE username = ?";
$stmt_check = $conn->prepare($check_sql);
$stmt_check->bind_param("s", $username);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows > 0) {
    // Update existing user
    $sql = "UPDATE admin SET password = ?, nama_lengkap = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $hashed_password, $nama_lengkap, $username);
    if ($stmt->execute()) {
        echo "User admin updated successfully.<br>";
    } else {
        echo "Error updating admin: " . $conn->error . "<br>";
    }
} else {
    // Insert new user
    $sql = "INSERT INTO admin (username, password, nama_lengkap) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $hashed_password, $nama_lengkap);
    if ($stmt->execute()) {
        echo "User admin created successfully.<br>";
    } else {
        echo "Error creating admin: " . $conn->error . "<br>";
    }
}

echo "<hr>";
echo "<strong>Login Credentials:</strong><br>";
echo "Username: <code>$username</code><br>";
echo "Password: <code>$password</code><br>";
echo "<br><a href='login.php'>Go to Login Page</a>";
?>
