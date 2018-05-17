<?php
/*
 * Destroy digunakan untuk menghapus sesi login.
 */
session_start();

// membuang variabel session yang berisi username
session_unset($_SESSION['email']);

// memusnahkan session
session_destroy();
{
    if(!isset($_SESSION['username'])){
        header("Location:../client/index.php");
    }
}
?>

