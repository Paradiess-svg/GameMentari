<?php
session_start();
$koneksi = new mysqli('localhost', 'root', '', 'mentari_test1') or die(mysqli_error($koneksi));

if(isset($_POST['login'])) {
    $nama = htmlspecialchars($_POST['nama']);

    $query = $koneksi->query("SELECT * FROM score WHERE nama='$nama'");

    $num = mysqli_num_rows($query);
    $c = mysqli_fetch_array($query);
    if ($num > 0) {
        $_SESSION['nama'] = $c['nama'];
        $_SESSION['id'] = $c['id'];
        header("location:index.php");
    } else {
        echo "Gagal";
    }
}
?>