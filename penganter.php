<?php
//tulis semua kode php di dalam tag <?php...
// echo "Hello World!";

//variable di php diawali dengan tanda $
$nama_lengkap = "Violney Raidah Nsirina";
$umur = 19;

// concatenaton ( menggunakan tanda . )
echo 'Nama lengkap saya adalah' . $nama_lengkap . ', umur ' . $umur . ' tahun. ';

// operator aritmatik
echo "<br>";
$a = 3+4*5-6; // hasil 17
echo $a;

$angka1 = 10;
$angka2 = 15;
$angka3 = "10";

echo "<br>";
if ($angka1 > $angka2) {
    echo "Angka 1 lebih besar";
}else{
    echo "Angka 2 lebih besar";
}

echo "<br>";
if ($angka1 == $angka3){
    echo "Nilai tersebut sama";
}else{
    echo "Nilai tersebut tidak sama";
}