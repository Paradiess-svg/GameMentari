
<?php
$host = 'localhost';
$user = 'root';
$pw = '';
$db = 'mentari_test1';

$conn = mysqli_connect($host, $user, $pw , $db );

mysqli_select_db($conn, $db);

?>
