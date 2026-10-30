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
            <!-- Tombol Garis Tiga (Toggler) -->
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