<?php
include 'config.php';

// Check if column 'gambar' exists
$result = $conn->query("SHOW COLUMNS FROM product_tenun LIKE 'gambar'");
$exists = (mysqli_num_rows($result)) ? TRUE : FALSE;

if (!$exists) {
    $sql = "ALTER TABLE product_tenun ADD COLUMN gambar VARCHAR(255) DEFAULT NULL AFTER stok";
    if ($conn->query($sql)) {
        echo "Column 'gambar' added successfully.";
    } else {
        echo "Error adding column: " . $conn->error;
    }
} else {
    echo "Column 'gambar' already exists.";
}
?>
