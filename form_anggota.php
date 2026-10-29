<?php require 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Anggota | Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom { background-color: #c4dfe9; }
        .btn-purple { background-color: #578bc2; color: white; }
        .btn-purple:hover { background-color: #8ed641; color: white; }
    </style>
</head>
<body class="bg-white">

    <nav class="navbar navbar-expand-lg navbar-custom px-4 py-3 mb-4 shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-dark" href="#">Perpustakaan</a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white py-3">
                        <h4 class="fw-bold mb-0">Tambah Data Anggota</h4>
                    </div>
                    <div class="card-body">
                        <form action="proses_anggota.php" method="POST">
                            <div class="mb-3">
                                <label for="nim" class="form-label fw-semibold">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" required>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label fw-semibold">No HP</label>
                                <input type="text" class="form-control" id="no_hp" name="no_hp">
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <a href="anggota.php" class="btn btn-secondary px-4">Kembali</a>
                                <button type="submit" name="submit" class="btn btn-purple px-4 fw-semibold">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>