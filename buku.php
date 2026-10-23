```php
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
        <h1>Data Buku</h1>
        <a class="btn btn-primary" href="form.php">Input Buku</a>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Kode Buku</th>
                <th>Judul</th>
                <th>Pengarang</th>
                <th>Penerbit</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Sampul</th>
                <th>Aksi</th>

            </tr>
            <?php
              require "koneksi.php";
              $sql = "Select*From buku";
              $result = $koneksi->query($sql);
              $no = 1;
              while($row = $result->fetch_assoc()){

              
            ?>
            <tr>
              <td><?=$no++?></td>
              <td><?= $row['kode_buku'] ?></td>
              <td><?= $row['judul'] ?></td>
              <td><?= $row['pengarang'] ?></td>
              <td><?= $row['penerbit'] ?></td>
              <td><?= $row['tahun_terbit'] ?></td>
              <td><?= $row['stok'] ?></td>

              <td>
                <?php
                  $nama_sampul = $row['sampul'] ?? '';

                  if (
                      !empty($nama_sampul) &&
                      $nama_sampul !== 'Array' &&
                      $nama_sampul !== '0' &&
                      is_file(__DIR__ . '/Sampul/' . basename($nama_sampul))
                  ) {
                ?>
                  <img
                    src="Sampul/<?= rawurlencode(basename($nama_sampul)) ?>"
                    width="100px"
                    alt="Sampul buku">
                <?php
                  } else {
                    echo '<span class="text-muted">Sampul belum tersedia</span>';
                  }
                ?>
              </td>

              <td>
                <a href="edit.php?id=<?= $row['id_buku']?>" class="btn btn-warning btn-sm">Edit</a>
                <a onclick="return confirm('Apakah Anda yakin menghapus data ini?')" href="hapus.php?id=<?= $row['id_buku']?> "class="btn btn-danger btn-sm">Hapus</a>
              </td>

        </tr>
        <?php } ?>
        </table>
     </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>
```