<?php
session_start();

include "../config/Dbconnect.php";

$getid = $_POST['id'];//ambil nilai

$_SESSION['keranjang'] = $getid; //membuat sesi

$getsesker = $_SESSION['keranjang'];

//di cek dulu apakah barang yang di beli sudah ada di tabel keranjang
$sql = "SELECT id FROM keranjang WHERE id_produk=$getid AND id_session=$getsesker ";

$result = mysqli_query($conn, $sql);

if ( mysqli_num_rows($result) == 0){
    // kalau barang belum ada, maka di jalankan perintah insert
   // mysql_query("INSERT INTO keranjang (id_produk, jumlah, id_session) VALUES ('$_GET[id]', 1, '$sid')");

   $sql = "INSERT INTO keranjang (id_produk, jumlah, id_session) VALUES ($getid, 1, $getsesker)";

   // $result = mysqli_query($conn, $sql);
    if (mysqli_query($conn, $sql)) {
        //data disimpan berhasil
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

} else {
   //  kalau barang ada, maka di jalankan perintah update
   // mysql_query("UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_session ='$sid' AND id_produk='$_GET[id]'");

    $sql = "UPDATE keranjang SET jumlah = jumlah + 1 WHERE id_session =$getsesker AND id_produk=$getid";

    $result = mysqli_query($conn, $sql);

}

header('Location:keranjang.php');

?>
