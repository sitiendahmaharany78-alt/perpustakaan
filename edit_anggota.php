<?php
require 'koneksi.php';

// Ambil data anggota dari database
$query = "SELECT * FROM anggota";
$result = $koneksi->query($query);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  </head>
  <body>
    <!-- Navbar dengan tema hijau dan tombol garis tiga di kanan -->
    <nav class="navbar navbar-expand-lg bg-success navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Perpustakaan</a>
        <!-- Tombol garis tiga (toggler) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Daftar menu yang akan tampil saat tombol garis tiga diklik -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="buku.php">Buku</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="anggota.php">Anggota</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Konten Utama -->
    <div class="container mt-4 mb-5">
        <h2>Data Anggota</h2>
        <hr>
        
        <!-- Tombol Input Anggota -->
        <a href="tambah_anggota.php" class="btn btn-success mb-3">+ Input Anggota</a>

        <!-- Tabel Data Anggota -->
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
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
                            <td>
                                <a href="edit_anggota.php?id=<?= $row['id_anggota']; ?>" class="btn btn-warning btn-sm text-dark fw-bold">Edit</a>
                                <a href="hapus_anggota.php?id=<?= $row['id_anggota']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted">Belum ada data anggota.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>