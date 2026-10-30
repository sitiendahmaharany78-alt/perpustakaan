<?php
require 'koneksi.php';

$query = "SELECT * FROM anggota ORDER BY id_anggota DESC";
$result = $koneksi->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota | Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom { background-color: #afe33f; }
        .btn-purple { background-color: #9dc257; color: white; }
        .btn-purple:hover { background-color: #35a5b1; color: white; }
    </style>
</head>
<body class="bg-white">

    <nav class="navbar navbar-expand-lg navbar-custom px-4 py-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-dark" href="#">Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link text-dark" href="home.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="buku.php">Buku</a></li>
                     <li class="nav-item"><a class="nav-link text-dark" href="buku.php">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link text-dark active fw-semibold" href="anggota.php">Anggota</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="fw-bold mb-4">Data Anggota</h2>
        <a href="form_anggota.php" class="btn btn-purple mb-4 px-3 py-2 fw-semibold">+ Input Anggota</a>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <!-- Tabel langsung ditulis tanpa pembungkus table-responsive agar tidak ada scrollbar -->
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $row['nim']; ?></td>
                                    <td><?= $row['nama']; ?></td>
                                    <td><?= $row['email'] ?? '-'; ?></td>
                                    <td><?= $row['no_hp'] ?? '-'; ?></td>
                                    <td><?= $row['terdaftar'] ?? '-'; ?></td>
                                    <td>
                                        <a href="edit_anggota.php?id=<?= $row['id_anggota']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="hapus_anggota.php?id=<?= $row['id_anggota']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data anggota.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>