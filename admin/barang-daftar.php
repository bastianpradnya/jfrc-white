<?php
include "../config/Apps.php";
$apps = new Apps();
$apps->adminHead();
?>

    <div class="col-lg-12">
        <h1 class="page-header">Semua Barang</h1>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Data Barang yang Tersimpan
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Kategori</th>
                                <th>Waktu Publish</th>
                                <th>Operasi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include "../config/Dbconnect.php";

                            $batas   = 10;
                            $halaman = @$_GET['halaman'];
                            if(empty($halaman)){
                                $posisi  = 0;
                                $halaman = 1;
                            }
                            else{
                                $posisi  = ($halaman-1) * $batas;
                            }
                            $no = $posisi+1;

                            $sql = "SELECT id, nama_barang, harga, stok, status, kategori_barang,
                                    waktu_publish, photo_1 FROM barang ORDER BY id DESC LIMIT $posisi, $batas ";
                            $result = $conn->query($sql);

                            if (!$result === TRUE) {
                                echo "Error: " . $sql . "<br>" . $conn->error;
                            }

                            $a = 1;
                            if ($result->num_rows > 0) {//if condition if table admin is already field
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    //statement for read database  from table admin in here
                                    ?>

                                    <?php $id = $row['id'] ?> <!--id record barang.-->
                                    <td><?php echo $a++ ?></td>
                                    <td><img  class="img-rounded "  src="../storage/thumbs/<?php echo $row['photo_1'] ?>" style="height: 60px" ></td>
                                    <td><a href="../admin/barang-edit.php?id=<?php echo $id ?>">
                                            <b><?php echo $row['nama_barang'] ?></b></a></td>
                                    <td>Rp.<?php echo $row['harga'] ?></td>
                                    <td><?php echo $row['stok'] ?></td>
                                    <td><?php echo $row['status'] ?></td>
                                    <td><?php echo $row['kategori_barang'] ?></td>
                                    <td><?php echo $row['waktu_publish'] ?></td>
                                    <td>
                                        <a href="../admin/barang-hapus.php?id=<?php echo $id ?>" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-trash" id="tombolHapus" aria-hidden="true"></span> Hapus </a>
                                    </td>
                                    </tr>
                                    <?php
                                }//end statement for read content from database table Admin.
                            }else {?>
                                <tr>
                                    <td colspan="9">
                                        <h3>Hasil Tidak di Temukan (0)</h3>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                            <tr>
                                <td colspan="9">
                                    <?php
                                    $query2     = mysqli_query($conn, "select id FROM barang");
                                    $jmldata    = mysqli_num_rows($query2);
                                    $jmlhalaman = ceil($jmldata/$batas);
                                    ?>
                                    <ul class="pagination">
                                        <?php
                                        for($i=1;$i<=$jmlhalaman;$i++)
                                            if ($i != $halaman){
                                                echo "<li><a href='barang-daftar.php?halaman=$i'>$i</a></li> ";
                                            }
                                            else{
                                                echo "<li class='active'><a href='#'>$i</a></li> ";
                                            }
                                        ?>
                                    </ul>

                                    <h5>Total Artikel : <?php echo $jmldata;?> Item</h5>
                                </td>
                            </tr>

                            </tbody>
                    </div>
                    <!-- /.table-responsive -->




                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
<?php
$apps->adminFooter();
?>