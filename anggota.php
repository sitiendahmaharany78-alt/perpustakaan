<?php
// Mulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require 'koneksi.php';

// Set variabel halaman
$judul_halaman = "Data Anggota";
$menu_aktif    = "anggota";

// Ambil data anggota dari database
$query = "SELECT * FROM anggota";
$result = $koneksi->query($query);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $judul_halaman ?> | Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>

<!-- Navbar dengan gaya warna ungu #B39DDB dan menu Home ditambahkan -->
<nav class="navbar navbar-expand-lg" style="background-color: #B39DDB;">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="buku.php">Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Menu Home -->
                <li class="nav-item">
                    <a class="nav-link <?= ($menu_aktif == 'home') ? 'active fw-bold' : '' ?>" href="index.php">Home</a>
                </li>
                <!-- Menu Buku -->
                <li class="nav-item">
                    <a class="nav-link <?= ($menu_aktif == 'buku') ? 'active fw-bold' : '' ?>" href="buku.php">Buku</a>
                </li>
                <!-- Menu Anggota -->
                <li class="nav-item">
                    <a class="nav-link <?= ($menu_aktif == 'anggota') ? 'active fw-bold' : '' ?>" href="anggota.php">Anggota</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Konten Utama -->
<div class="container mt-4 mb-5">
    
    <!-- Alert Session Pesan (jika ada notifikasi sukses/gagal) -->
    <?php if (isset($_SESSION['pesan'])): ?>
        <div class="alert alert-<?= $_SESSION['pesan']['tipe'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['pesan']['teks'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['pesan']); ?>
    <?php endif; ?>

    <h2><?= $judul_halaman ?></h2>
    <hr>
    
    <!-- Tombol Input Anggota -->
    <a href="tambah_anggota.php" class="btn mb-3 fw-bold text-white" style="background-color: #7E57C2;">+ Input Anggota</a>

    <!-- Tabel Data Anggota -->
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-light">
            <tr>
                <th width="5%">No</th>
                <th>NIM</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Terdaftar</th>
                <th width="15%">Aksi</th>
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
                        <td><?= isset($row['tanggal_terdaftar']) ? date('d-m-Y', strtotime($row['tanggal_terdaftar'])) : '-'; ?></td>
                        <td>
                            <div class="d-flex gap-1">
                                <!-- Tombol Edit -->
                                <a href="edit_anggota.php?id=<?= $row['id_anggota']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                
                                <!-- Tombol Hapus -->
                                <a href="hapus_anggota.php?id=<?= $row['id_anggota']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data anggota.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>