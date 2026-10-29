<?php
require 'koneksi.php';
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$stmt = $koneksi->prepare("SELECT * FROM anggota WHERE id_anggota = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: anggota.php");
    exit;
}
$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Anggota | Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">Edit Data Anggota</h4>
                    </div>
                    <div class="card-body">
                        <form action="proses_anggota.php" method="POST">
                            <input type="hidden" name="id_anggota" value="<?= $data['id_anggota']; ?>">
                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim" value="<?= htmlspecialchars($data['nim']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($data['email'] ?? ''); ?>">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">No HP</label>
                                <input type="text" class="form-control" name="no_hp" value="<?= htmlspecialchars($data['no_hp'] ?? ''); ?>">
                            </div>
                            <button type="submit" name="update" class="btn btn-warning">Simpan Perubahan</button>
                            <a href="anggota.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>