<?php
include 'koneksi.php';
function tambah_data($data){

    $nama = $data['nama'];

    $query = "INSERT INTO score (id, nama, nilai, waktu) VALUES(null, '$nama', '0' ,'0')";
    $sql = mysqli_query($GLOBALS['conn'], $query);



    return true;
}