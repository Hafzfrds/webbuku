<?php
include 'config.php'; // Koneksi database

$result = $conn->query("SELECT * FROM buku");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="buku.css">
    <title>Daftar Buku</title>
</head>
<body>
<a href="admin.php">Admin</a> 
    <h1>Daftar Lagu</h1>
    <a href="create_buku.php" >Tambah Lagu</a>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>ID</th>
                <th>Lagu</th>
                <th>Penyanyi</th>
                <th>Penulis</th>
                <th>Tanggal Rilis</th>
                <th>Cover</th>
                <th>Aksi</th>
               
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['judul'] ?></td>
                    <td><?= $row['penerbit'] ?></td>
                    <td><?= $row['pengarang'] ?></td>
                    <td><?= $row['tahun'] ?></td>
                    <td><img src="uploads/<?= $row['cover'] ?>" alt="Cover" width="100"></td>
                    <td>
                        <a href="edit_song.php?id=<?= $row['id'] ?>">Edit</a> |
                        <a href="delete_song.php?id=<?= $row['id'] ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                  
                </tr>
             
            <?php } ?>
        </tbody>
    </table>
    
</body>
</html>
