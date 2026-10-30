<?php
require 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'] ?? '';

if (!$id) {
    header("Location: anggota.php");
    exit;
}

// Ambil data anggota berdasarkan ID
$query = "SELECT * FROM anggota WHERE id_anggota = $id";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();

if (!$row) {
    echo "Data tidak ditemukan!";
    exit;
}

// Jika tombol update ditekan
if (isset($_POST['submit'])) {
    $nim = htmlspecialchars($_POST['nim']);
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);

    $update_query = "UPDATE anggota SET nim = '$nim', nama = '$nama', email = '$email' WHERE id_anggota = $id";
    
    if ($koneksi->query($update_query) === TRUE) {
        header("Location: anggota.php?pesan=sukses_edit");
        exit;
    } else {
        $error = "Gagal mengubah data: " . $koneksi->error;
    }
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Edit Data Anggota</h4>
                    </div>
                    <div class="card-body">
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>

                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?= $row['nim']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $row['nama']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= $row['email']; ?>">
                            </div>

                            <!-- Bagian Informasi Terdaftar -->
                            <div class="mb-3">
                                <label class="form-label">Tanggal Terdaftar</label>
                                <input type="text" class="form-control bg-light" value="<?= isset($row['tanggal_terdaftar']) ? date('d-m-Y H:i:s', strtotime($row['tanggal_terdaftar'])) : '-'; ?>" readonly>
                                <div class="form-text">Tanggal terdaftar dibuat otomatis oleh sistem dan tidak dapat diubah.</div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-success">Simpan Perubahan</button>
                            <a href="anggota.php" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>