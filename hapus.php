<?php
require 'koneksi.php';

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $query = $koneksi->query("DELETE FROM buku WHERE id_buku='$id'");

    if($query){
        header("Location: buku.php");
    }else
        header("Location: buku.php");
}

?>