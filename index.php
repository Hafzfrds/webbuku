<?php
include 'config.php';
session_start();

if (isset($_SESSION['username'])) {
    // Arahkan berdasarkan role jika sudah login
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
    } else if ($_SESSION['role'] == 'user') {
        header("Location: user.php");
    } else if ($_SESSION['role'] == 'owner') {
        header("Location: owner.php");
    }
    exit();
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = hash('sha256', $_POST['password']); // Hash the input password using SHA-256

    // Cek di tabel users
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];

        // Arahkan berdasarkan role
        if ($row['role'] == 'admin') {
            header("Location: admin.php");
        } else if ($row['role'] == 'user') {
            header("Location: user.php");
        } else if ($row['role'] == 'owner') {
            header("Location: owner.php");
        } else {
            echo "<script>alert('Role tidak dikenali!')</script>";
        }
    } else {
        echo "<script>alert('Username atau password Anda salah. Silakan coba lagi!')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Selamat Datang di Website Perpustakaan Kami</p>
        </form>
    </div>
</body>
</html>
