<?php
//ini adalah file yang melakukan koneksi dari php ke database
$host="localhost";
$user="root";
$password="";
$database="perpustakaan_db"; 

$koneksi=new mysqli($host,$user,$password,$database);

if($koneksi->connect_error){
     echo "Koneksi gagal";
}

// Tambahan fungsi redirect agar tidak error saat proses
if (!function_exists('redirect')) {
    function redirect($url, $type = '', $message = '') {
        header("Location: $url");
        exit();
    }
}
?>