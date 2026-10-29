<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $id_anggota = (int) $_GET['id'];
    $stmt = $koneksi->prepare("DELETE FROM anggota WHERE id_anggota = ?");
    $stmt->bind_param("i", $id_anggota);
    $stmt->execute();
}

header("Location: anggota.php");
exit();
?>