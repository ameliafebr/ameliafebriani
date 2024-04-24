<?php 
$conn = mysqli_connect("localhost", "root", "", "ujikom_amelia");

//cek koneksi
if(mysqli_connect_error()){
    echo "Koneksi database gagal" .mysqli_connect_error();
}
?>