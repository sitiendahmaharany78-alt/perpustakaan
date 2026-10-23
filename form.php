<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Perpustakaan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="Perpustakaan">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Buku</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Anggota</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    <div class="container">
        <h1>Input Data</h1>
        <form action="proses.php" method="POST" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="kode_buku" class="col-sm-2 col-form-label">Kode Buku</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="kode_buku" name="kode_buku" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="judul" name="judul">
                </div>
            </div>
            <div class="row mb-3">
                <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pengarang" name="pengarang">
                </div>
            </div>
            <div class="row mb-3">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="penerbit" name="penerbit">
                </div>
            </div>
            <div class="row mb-3">
                <label for="tahun_terbit" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit">
                </div>
            </div>
             <div class="row mb-3">
                <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="stok" name="stok">
                </div>
            </div>
            <div class="row mb-3">
                <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                <div class="col-sm-4">
                    <input type="file" accept="image/*" class="form-control" id="sampul" name="sampul">
                </div>
            </div>
            <input type="submit" value="Simpan" name="submit" class="btn btn-primary">
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>