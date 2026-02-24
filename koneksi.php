<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "perpus_ytta";

$koneksi = mysqli_connect($server, $user, $password, $database);
if(!$koneksi){
    echo "koneksi error : ".mysqli_error($koneksi);
}

?>
