<?php
$host = 'localhost';
$user = 'root';
$pass = '';

// Connect without database first
$conn = new mysqli($host, $user, $pass);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create DB if not exists
$sql = "CREATE DATABASE IF NOT EXISTS sisfomtenun";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists.<br>";
} else {
    die("Error creating database: " . $conn->error);
}

// Select DB
$conn->select_db('sisfomtenun');

// Read SQL file
$sqlFile = file_get_contents('database.sql');
if ($sqlFile === false) {
    die("Error reading database.sql");
}

// Execute multi query
// Remove "CREATE DATABASE" lines from the sql file content for safety if we are running it here,
// but database.sql has "USE sisfomtenun", so it should be fine.
// However, mysqli::multi_query can be tricky with comments and specific formatting.
// Let's try to split by semicolon.

$queries = explode(';', $sqlFile);
foreach ($queries as $query) {
    $query = trim($query);
    if (!empty($query)) {
        if (!$conn->query($query)) {
            // Ignore "Database exists" or "Table exists" errors for robustness
            echo "Error executing query: " . $conn->error . "<br>Query: " . substr($query, 0, 50) . "...<br>";
        }
    }
}

// Create default admin user
$username = 'admin';
$password = 'admin123';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$nama = 'Administrator';

// Check if admin exists
$check = $conn->query("SELECT * FROM admin WHERE username = '$username'");
if ($check->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO admin (username, password, nama_lengkap) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $nama);
    if ($stmt->execute()) {
        echo "Default admin user created.<br>";
        echo "Username: admin<br>";
        echo "Password: admin123<br>";
    } else {
        echo "Error creating admin: " . $stmt->error . "<br>";
    }
} else {
    echo "Admin user already exists.<br>";
}

echo "Installation complete. <a href='login.php'>Go to Login</a>";
?>
