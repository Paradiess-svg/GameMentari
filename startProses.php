<?php

include 'startFungsi.php';
session_start();


        if($_POST['aksi'] == "register"){

            $berhasil= tambah_data($_POST);

                header("location:login.php");

            }
        
            ?>
