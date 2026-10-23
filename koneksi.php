<?php
//ini adalah file yang melakukan koneksi dari php ke database
$host="localhost";
$user="root";
$password="";
$database="perpustakaan_db"; // Ubah dari "perpustakaan" menjadi "db_perpustakaan"

$koneksi=new mysqli($host,$user,$password,$database);

if($koneksi->connect_error){
     echo "Koneksi gagal";
}
?>