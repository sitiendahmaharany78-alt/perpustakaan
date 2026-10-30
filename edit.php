<?php
require 'koneksi.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Ambil data buku berdasarkan ID
$stmt = $koneksi->prepare("SELECT * FROM buku WHERE id_buku = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    header("Location: buku.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Perpustakaan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="buku.php">Buku</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="anggota.php">Anggota</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-4 mb-5">
        <h2>Edit Data Buku</h2>
        <hr>
        <!-- Pastikan action mengarah ke file pemroses update data Anda, misal: proses_buku.php atau halaman ini sendiri -->
        <form action="" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Kode Buku</label>
                <input type="text" class="form-control" name="kode_buku" value="<?= $row['kode_buku'] ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" value="<?= $row['judul'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input type="text" class="form-control" name="pengarang" value="<?= $row['pengarang'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" class="form-control" name="penerbit" value="<?= $row['penerbit'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" name="tahun_terbit" value="<?= $row['tahun_terbit'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" class="form-control" name="stok" value="<?= $row['stok'] ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Sampul Lama</label><br>
                <?php if (!empty($row['sampul']) && is_file(__DIR__ . '/Sampul/' . basename($row['sampul']))): ?>
                    <img src="Sampul/<?= rawurlencode(basename($row['sampul'])) ?>" width="100px" class="mb-2 border rounded"><br>
                <?php else: ?>
                    <span class="text-muted">Tidak ada sampul</span><br>
                <?php endif; ?>
                
                <label class="form-label mt-2">Ganti Sampul Baru (Opsional)</label>
                <input type="file" class="form-control" name="sampul">
            </div>
            
            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            <a href="buku.php" class="btn btn-secondary">Kembali</a>
        </form>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>