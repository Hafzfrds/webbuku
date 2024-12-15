<?php
include 'config.php';

$id = $_GET['id'];

// Hapus user berdasarkan ID
$sql = "DELETE FROM users WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: crud_user.php"); // Kembali ke halaman utama
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
