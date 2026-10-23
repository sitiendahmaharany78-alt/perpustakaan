```php
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Data Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Perpustakaan</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="buku.php">Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Anggota</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
require 'koneksi.php';

$id = $_GET['id'] ?? '';

$stmt = $koneksi->prepare(
    "SELECT * FROM buku WHERE id_buku = ?"
);
$stmt->bind_param("s", $id);
$stmt->execute();

$query = $stmt->get_result();
$row = $query->fetch_assoc();

if (!$row) {
    die("Data buku tidak ditemukan.");
}
?>

<div class="container mt-4">
    <h1>Edit Data Buku</h1>

    <form action="proses.php" method="post"
          enctype="multipart/form-data">

        <input type="hidden" name="id_buku"
               value="<?= $row['id_buku'] ?>">

        <input type="hidden" name="sampul_lama"
               value="<?= $row['sampul'] ?? '' ?>">

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Kode Buku</label>
            <div class="col-sm-4">
                <input type="text" class="form-control"
                       name="kode_buku"
                       value="<?= $row['kode_buku'] ?>"
                       readonly required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-4">
                <input type="text" class="form-control"
                       name="judul"
                       value="<?= $row['judul'] ?>"
                       required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Pengarang</label>
            <div class="col-sm-4">
                <input type="text" class="form-control"
                       name="pengarang"
                       value="<?= $row['pengarang'] ?>"
                       required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Penerbit</label>
            <div class="col-sm-4">
                <input type="text" class="form-control"
                       name="penerbit"
                       value="<?= $row['penerbit'] ?>"
                       required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Tahun Terbit</label>
            <div class="col-sm-4">
                <input type="number" class="form-control"
                       name="tahun_terbit"
                       value="<?= $row['tahun_terbit'] ?>"
                       required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Stok</label>
            <div class="col-sm-4">
                <input type="number" class="form-control"
                       name="stok"
                       value="<?= $row['stok'] ?>"
                       required>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Sampul Lama</label>
            <div class="col-sm-4">
                <?php
                $namaLama = basename($row['sampul'] ?? '');
                $fileLama = 'Sampul/' . $namaLama;
                ?>

                <?php if ($namaLama !== '' && is_file(__DIR__ . '/' . $fileLama)): ?>
                    <img
                        src="<?= $fileLama ?>"
                        alt="Sampul buku lama"
                        class="img-thumbnail mb-2"
                        style="width:150px; height:200px; object-fit:cover;">

                    <p class="text-muted small">
                        Sampul lama akan tetap digunakan jika
                        tidak memilih gambar baru.
                    </p>
                <?php else: ?>
                    <p class="text-muted">
                        Sampul lama tidak ditemukan atau belum tersedia.
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Ganti Sampul</label>
            <div class="col-sm-4">
                <input type="file" class="form-control"
                       id="sampul" name="sampul"
                       accept="image/jpeg,image/png,image/webp">

                <small class="text-muted">
                    Kosongkan jika ingin memakai sampul lama.
                </small>

                <div class="mt-3">
                    <img id="previewSampul"
                         src=""
                         alt="Preview sampul baru"
                         class="img-thumbnail d-none"
                         style="width:150px; height:200px; object-fit:cover;">
                </div>
            </div>
        </div>

        <input type="submit" value="Simpan"
               name="update" class="btn btn-primary">

        <a href="buku.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<script>
document.getElementById('sampul').addEventListener('change', function () {
    const preview = document.getElementById('previewSampul');

    if (this.files && this.files[0]) {
        preview.src = URL.createObjectURL(this.files[0]);
        preview.classList.remove('d-none');
    } else {
        preview.classList.add('d-none');
        preview.removeAttribute('src');
    }
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```