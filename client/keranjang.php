<?php
require_once "../config/Apps.php";
$apps = new Apps();
$apps->clientHeader();
?>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"
          xmlns="http://www.w3.org/1999/html">

    <div class="login">
        <div class="wrap">
            <ul class="breadcrumb breadcrumb__t"><a class="home" href="#">Home</a>  / Keranjang Belanja</ul>


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Rincian Pembelian
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><b>Nama Barang</b></th>
                                        <th></th>
                                        <th><b>Harga</b></th>
                                        <th><b>Banyaknya</b></th>
                                        <th><b>Harga Total</b></th>
                                    </tr>
                                    </thead>

                                    <?php
                                    $ambilsesi = $_SESSION['keranjang']; //membuat sesi

                                    include "../config/Dbconnect.php";

                                    ?>

                                    <?php
                                    //jalankan perintah inner join dari tabel keranjang dan produk

                                    $sql = "SELECT * FROM keranjang, barang WHERE id_session = $ambilsesi AND keranjang.id_produk = barang.id";
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        // output data of each row
                                        while($row = mysqli_fetch_assoc($result)){
                                            $total = $row['jumlah']* $row['harga'];
                                            echo "
                                             <tr>
                                                <td>".$row['nama_barang']." </td>
                                                <td><img src='../storage/thumbs/".$row['photo_1']."' class='image-rounded' style='height: 70px'> </td>
                                                <td>Rp.  ".$row['harga']."</td>
                                                <td>".$row['jumlah']." </td>
                                                <td>Rp.".$total." </td>
                                             </tr>
                                            ";
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->


            <div class="clear"></div>
        </div>
    </div>
    </div>

<br><br><br><br><br><br>
<?php
$apps->clientFooter();
?>