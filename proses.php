
<?php

require 'koneksi.php';

// PROSES TAMBAH DATA BUKU
if (isset($_POST['submit'])) {

    $kode_buku = $_POST['kode_buku'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = (int) $_POST['tahun_terbit'];
    $stok = (int) $_POST['stok'];

    $nama_sampul = '';

    // Jika pengguna memilih gambar
    if (isset($_FILES['sampul']) &&
        $_FILES['sampul']['error'] === UPLOAD_ERR_OK) {

        $folder = __DIR__ . '/Sampul/';

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $ekstensi = strtolower(
            pathinfo($_FILES['sampul']['name'], PATHINFO_EXTENSION)
        );

        $ekstensi_diizinkan = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ekstensi, $ekstensi_diizinkan, true)) {
            die("Format gambar harus JPG, JPEG, PNG, atau WEBP.");
        }

        $nama_sampul = uniqid('sampul_', true) . '.' . $ekstensi;

        if (!move_uploaded_file(
            $_FILES['sampul']['tmp_name'],
            $folder . $nama_sampul
        )) {
            die("Gagal mengunggah gambar.");
        }

    } elseif (
        isset($_FILES['sampul']) &&
        $_FILES['sampul']['error'] !== UPLOAD_ERR_NO_FILE
    ) {
        die("Terjadi kesalahan saat mengunggah gambar.");
    }

    $stmt = $koneksi->prepare(
        "INSERT INTO buku
        (kode_buku, judul, pengarang, penerbit, tahun_terbit, stok, sampul)
        VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    $stmt->bind_param(
        "ssssiis",
        $kode_buku,
        $judul,
        $pengarang,
        $penerbit,
        $tahun_terbit,
        $stok,
        $nama_sampul
    );

    if ($stmt->execute()) {
        header("Location: buku.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . $stmt->error;
    }
}


// PROSES EDIT DATA BUKU
if (isset($_POST['update'])) {

    $kode_buku = $_POST['kode_buku'];
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = (int) $_POST['tahun_terbit'];
    $stok = (int) $_POST['stok'];

    // Ambil sampul lama langsung dari database
    $stmtLama = $koneksi->prepare(
        "SELECT sampul FROM buku WHERE kode_buku = ?"
    );

    $stmtLama->bind_param("s", $kode_buku);
    $stmtLama->execute();

    $hasilLama = $stmtLama->get_result();
    $dataLama = $hasilLama->fetch_assoc();

    if (!$dataLama) {
        die("Data buku tidak ditemukan.");
    }

    $nama_sampul = basename($dataLama['sampul'] ?? '');

    // Jika pengguna memilih gambar baru
    if (isset($_FILES['sampul']) &&
        $_FILES['sampul']['error'] === UPLOAD_ERR_OK) {

        $folder = __DIR__ . '/Sampul/';

        if (!is_dir($folder)) {
            mkdir($folder, 0755, true);
        }

        $ekstensi = strtolower(
            pathinfo($_FILES['sampul']['name'], PATHINFO_EXTENSION)
        );

        $ekstensi_diizinkan = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ekstensi, $ekstensi_diizinkan, true)) {
            die("Format gambar harus JPG, JPEG, PNG, atau WEBP.");
        }

        $nama_baru = uniqid('sampul_', true) . '.' . $ekstensi;

        if (!move_uploaded_file(
            $_FILES['sampul']['tmp_name'],
            $folder . $nama_baru
        )) {
            die("Gagal mengunggah gambar baru.");
        }

        // Simpan nama sampul baru
        $nama_sampul = $nama_baru;

    } elseif (
        isset($_FILES['sampul']) &&
        $_FILES['sampul']['error'] !== UPLOAD_ERR_NO_FILE
    ) {
        die("Terjadi kesalahan saat mengunggah gambar.");
    }

    $stmt = $koneksi->prepare(
        "UPDATE buku SET
            judul = ?,
            pengarang = ?,
            penerbit = ?,
            tahun_terbit = ?,
            stok = ?,
            sampul = ?
         WHERE kode_buku = ?"
    );

    $stmt->bind_param(
        "sssiiss",
        $judul,
        $pengarang,
        $penerbit,
        $tahun_terbit,
        $stok,
        $nama_sampul,
        $kode_buku
    );

    if ($stmt->execute()) {
        header("Location: buku.php");
        exit;
    } else {
        echo "Gagal mengubah data: " . $stmt->error;
    }
}

?>
