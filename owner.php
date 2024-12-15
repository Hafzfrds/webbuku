<?php
session_start();
include 'config.php';

// Cek apakah pengguna login sebagai admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'owner') {
    header("Location: index.php");
    exit();
}

// Ambil data user dan buku
$users = $conn->query("SELECT * FROM users");
$buku = $conn->query("SELECT * FROM buku");

if (!$users || !$buku) {
    die("Query gagal: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4">Owner Panel</h1>
        <p class="text-end">Selamat datang, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong>!</p>

        <!-- Manajemen User -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h2>Manajemen User</h2>
            </div>
            <div class="card-body">
               
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $users->fetch_assoc()) { ?>
                            <tr>
                                <td><?= htmlspecialchars($user['id']); ?></td>
                                <td><?= htmlspecialchars($user['username']); ?></td>
                                <td><?= htmlspecialchars($user['email']); ?></td>
                                <td><?= htmlspecialchars($user['role']); ?></td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Manajemen Buku -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h2>Manajemen Buku</h2>
            </div>
            <div class="card-body">
             
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>Penerbit</th>
                            <th>Pengarang</th>
                            <th>Tahun</th>
                            <th>Cover</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($book = $buku->fetch_assoc()) { ?>
                            <tr>
                                <td><?= htmlspecialchars($book['id']); ?></td>
                                <td><?= htmlspecialchars($book['judul']); ?></td>
                                <td><?= htmlspecialchars($book['penerbit']); ?></td>
                                <td><?= htmlspecialchars($book['pengarang']); ?></td>
                                <td><?= htmlspecialchars($book['tahun']); ?></td>
                                <td>
                                    <?php if (!empty($book['cover'])) { ?>
                                        <img src="uploads/<?= htmlspecialchars($book['cover']); ?>" alt="Cover" class="img-thumbnail" width="50">
                                    <?php } else { ?>
                                        Tidak ada cover
                                    <?php } ?>
                                </td>
                               
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
