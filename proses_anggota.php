<?php
require 'koneksi.php';

// Simpan data baru
if (isset($_POST['submit'])) {
    $nim   = $_POST['nim'];
    $nama  = $_POST['nama'];
    $email = $_POST['email'];
    $no_hp = $_POST['no_hp'];

    $sql  = "INSERT INTO anggota (nim, nama, email, no_hp) VALUES (?, ?, ?, ?)";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssss", $nim, $nama, $email, $no_hp);

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