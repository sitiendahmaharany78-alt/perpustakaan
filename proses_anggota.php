<?php
require 'koneksi.php';

// Simpan data baru
if (isset($_POST['submit'])) {
    $nim   = $_POST['nim'];
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];
    
    // 1. Ambil tanggal hari ini (Format: Tahun-Bulan-Tanggal, misal: 2026-10-30)
    $terdaftar = date('Y-m-d');

    // 2. Tambahkan kolom 'terdaftar' ke dalam query SQL dan tanda tanyanya (?)
    $sql  = "INSERT INTO anggota (nim, nama, email, no_hp, terdaftar) VALUES (?, ?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    
    // 3. Tambahkan huruf "s" kelima karena ada 5 parameter string
    $stmt->bind_param("sssss", $nim, $nama, $email, $no_hp, $terdaftar);

    if ($stmt->execute()) {
        redirect('anggota.php', 'success', 'Data berhasil disimpan.');
    } else {
        redirect('form_anggota.php', 'danger', 'Gagal menyimpan.');
    }
}

// Ubah data
if (isset($_POST['update'])) {
    $id_anggota = (int) $_POST['id_anggota'];
    $nim        = $_POST['nim'];
    $nama       = $_POST['nama'];
    $email      = $_POST['email'];
    $no_hp      = $_POST['no_hp'];

    $sql  = "UPDATE anggota SET nim = ?, nama = ?, email = ?, no_hp = ? WHERE id_anggota = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssi", $nim, $nama, $email, $no_hp, $id_anggota);

    if ($stmt->execute()) {
        redirect('anggota.php', 'success', 'Data berhasil diubah.');
    } else {
        redirect("edit_anggota.php?id=$id_anggota", 'danger', 'Gagal mengubah.');
    }
}

header('Location: anggota.php');
exit;