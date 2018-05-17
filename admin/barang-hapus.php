<?php
include "../config/Dbconnect.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM barang WHERE id=$id";

    if ($conn->query($sql) == TRUE) {
        /*
        * if cond for delleting image from directory
        * thumnail dan img, storage.
        */

        //query table admin
        $result = $conn->query($sql) or trigger_error($result);

        //data menjadi array assosiatif
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $photo1 = $row['photo_1'];
        $photo2 = $row['photo_2'];
        $photo2 = $row['photo_3'];

        $path ="../storage/img/".$photo1;
        $PathThumb = "../storage/thumbs/".$photo1;

        // First close the file
    //    fclose($path);

        if (!unlink($path) && !unlink($PathThumb)){
            echo ("Error deleting $path and $PathThumb");
            /*
             * Jika File image didalam foldes storage kosong bisa
             * langsung hapus database.
             */

            $sql = "DELETE FROM barang WHERE id= $id";

            if ($conn->query($sql) === TRUE) {
                Header("location:../admin/barang-daftar.php");
            } else {
                echo "Error deleting record: " . $conn->error;
            }
            $conn->close();

        }else{
            /*
             * Jika hapus file gambar berhasil maka dilakukan penghapusan
             * record data di database.
             * Query for deleting record from database/
             */

            $sql = "DELETE FROM barang WHERE id= $id";

             if ($conn->query($sql) === TRUE) {
                 Header("location:../admin/barang-daftar.php");
             } else {
                 echo "Error deleting record: " . $conn->error;
             }
             $conn->close();
        }

    }else{
        echo "Operasi Hapus Data GAGAL !!!";
    }
}
?>

?>