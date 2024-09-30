<?php
include 'koneksi.php';
// function tambah_data($data, $files){

//     $plat_nomor = $data['plat_nomor'];
//     $merek_mobil = $data['merek_mobil'];
//     $status = $data['status'];

//     echo $files['foto']['name'];

//     $split = explode('.',$files['foto']['name']);
//     $ekstensi = $split[count($split)-1];
//     $foto = $plat_nomor.'.'.$ekstensi;
//     $alamat_pool = $data['alamat_pool'];
//     $dir = "img/";
//     $tmpFile = $files['foto']['tmp_name'];

//     move_uploaded_file($tmpFile, $dir.$foto);

//     $query = "INSERT INTO tb_mobil VALUES(null, '$plat_nomor', '$merek_mobil', '$status', '$foto', '$alamat_pool')";
//     $sql = mysqli_query($GLOBALS['conn'], $query);

//     return true;
// }

function nilai($data){
    $id = $data['id'];
    $nama = $data['nama'];
    $nilai = $data['nilai'];
    // $status = $data['status'];
    // $alamat_pool = $data['alamat_pool'];

    $queryshow = "SELECT * FROM score WHERE id = '$id';";
    $sqlshow = mysqli_query($GLOBALS['conn'], $queryshow);
    $result = mysqli_fetch_assoc($sqlshow);

    $query = "UPDATE score SET nilai='$nilai' WHERE id ='$id';";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;
}

function hapus_data($data){
    $id_mobil = $data['hapus'];

    $queryshow = "SELECT * FROM tb_mobil WHERE id_mobil = '$id_mobil';";
    $sqlshow = mysqli_query($GLOBALS['conn'] , $queryshow);
    $result = mysqli_fetch_assoc($sqlshow);

    unlink("img/".$result['foto_mobil']);

    $query="DELETE FROM tb_mobil WHERE id_mobil = '$id_mobil' ;";
    $sql = mysqli_query($GLOBALS['conn'], $query);

    return true;

}

?>