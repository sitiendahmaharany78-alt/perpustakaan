<?php
require 'koneksi.php';

// Ambil ID dari URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Proses jika tombol update ditekan
if (isset($_POST['update'])) {
    $id_buku      = (int) $_POST['id_buku'];
    $judul        = $_POST['judul'];
    $pengarang    = $_POST['pengarang'];
    $penerbit     = $_POST['penerbit'];
    $tahun_terbit = (int) $_POST['tahun_terbit'];
    $stok         = (int) $_POST['stok'];
    
    // Ambil nama sampul lama dari database terlebih dahulu
    $query_lama = $koneksi->prepare("SELECT sampul FROM buku WHERE id_buku = ?");
    $query_lama->bind_param("i", $id_buku);
    $query_lama->execute();
    $result_lama = $query_lama->get_result();
    $data_lama = $result_lama->fetch_assoc();
    $sampul_lama = $data_lama['sampul'];

    // Cek apakah user mengupload file sampul baru
    if (isset($_FILES['sampul']) && $_FILES['sampul']['error'] === UPLOAD_ERR_OK) {
        $nama_file = $_FILES['sampul']['name'];
        $tmp_file  = $_FILES['sampul']['tmp_name'];
        
        // Buat nama file unik agar tidak terjadi bentrok nama file
        $ekstensi  = pathinfo($nama_file, PATHINFO_EXTENSION);
        $nama_baru = uniqid('sampul_') . '.' . $ekstensi;
        $tujuan    = __DIR__ . '/Sampul/' . $nama_baru;

        // Validasi ekstensi file gambar yang diperbolehkan
        $ekstensi_boleh = ['jpg', 'jpeg', 'png', 'webp'];
        if (in_array(strtolower($ekstensi), $ekstensi_boleh)) {
            // Pindahkan file baru ke folder Sampul
            if (move_uploaded_file($tmp_file, $tujuan)) {
                // Hapus file sampul lama di folder jika ada
                if (!empty($sampul_lama) && file_exists(__DIR__ . '/Sampul/' . $sampul_lama)) {
                    unlink(__DIR__ . '/Sampul/' . $sampul_lama);
                }
                $sampul_baru = $nama_baru;
            } else {
                $error = "Gagal mengupload gambar sampul baru!";
            }
        } else {
            $error = "Ekstensi file tidak diizinkan! Gunakan format jpg, jpeg, png, atau webp.";
        }
    } else {
        // Jika user tidak memilih file baru, gunakan kembali sampul lama
        $sampul_baru = $sampul_lama;
    }

    // Jika tidak ada error pada proses file, lanjutkan update database
    if (!isset($error)) {
        $stmt_update = $koneksi->prepare("UPDATE buku SET judul = ?, pengarang = ?, penerbit = ?, tahun_terbit = ?, stok = ?, sampul = ? WHERE id_buku = ?");
        $stmt_update->bind_param("sssissi", $judul, $pengarang, $penerbit, $tahun_terbit, $stok, $sampul_baru, $id_buku);
        
        if ($stmt_update->execute()) {
            echo "<script>alert('Data buku berhasil diubah!'); window.location='buku.php';</script>";
            exit;
        } else {
            $error = "Gagal memperbarui data ke database!";
        }
    }
}

// Ambil data buku berdasarkan ID untuk ditampilkan kembali ke form
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

        <!-- Menampilkan pesan error jika validasi gagal -->
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $error; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="id_buku" value="<?= $row['id_buku'] ?>">
            
            <div class="mb-3">
                <label class="form-label">Kode Buku</label>
                <input type="text" class="form-control" name="kode_buku" value="<?= $row['kode_buku'] ?>" readonly>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control" name="judul" value="<?= htmlspecialchars($row['judul']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Pengarang</label>
                <input type="text" class="form-control" name="pengarang" value="<?= htmlspecialchars($row['pengarang']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Penerbit</label>
                <input type="text" class="form-control" name="penerbit" value="<?= htmlspecialchars($row['penerbit']) ?>" required>
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
                <div class="form-text">Biarkan kosong jika tidak ingin mengubah gambar sampul.</div>
            </div>
            
            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
            <a href="buku.php" class="btn btn-secondary">Kembali</a>
        </form>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>