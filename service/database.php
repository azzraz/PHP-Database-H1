<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "buku_tamu";

$db = mysqli_connect($hostname, $username, $password, $database_name); 

if(mysqli_connect_error()){
    echo "Koneksi database gagal"; 
    die("eror!");
}

?>
