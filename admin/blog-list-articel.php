<?php 
    include "../config/Apps.php";
    $apps = new Apps();
    $apps->adminHead();
?>

    <div class="col-lg-12">
        <h1 class="page-header">Artikel Blog</h1>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Daftar artikel Blog pada TOKO JFRC 37
                </div>

                <div class="panel-body">
                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                    <th>Waktu Posting</th>
                                    <th>Operasi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                include "../config/Dbconnect.php";


                                $batas   = 9;
                                $halaman = @$_GET['halaman'];
                                if(empty($halaman)){
                                    $posisi  = 0;
                                    $halaman = 1;
                                }
                                else{
                                    $posisi  = ($halaman-1) * $batas;
                                }
                                $no = $posisi+1;

                                $sql = "SELECT id, judul_artikel, kontent_artikel, kategori, status, tanggal_publish
                                          FROM blog_articel ORDER BY id DESC LIMIT $posisi, $batas";

                                $result = $conn->query($sql);
                                $a = 1;

                                if ($result->num_rows > 0) { //if condition if table admin is already field
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                                        //statement for read database  from table admin in here
                                        ?>
                                        <td><?php echo $a++ ?></td>
                                        <?php $id = $row['id'] ?>
                                        <td><a href="../admin/blog-edit.php?id=<?php echo $id ?>"> <b><?php echo $row['judul_artikel'] ?></b></a></td>
                                        <td><?php echo $row['kategori'] ?></td>
                                        <td><?php echo $row['status'] ?></td>
                                        <td><?php echo $row['tanggal_publish'] ?></td>
                                        <td>
                                            <a href="../admin/blog-list-articel.php?id=<?php echo $id ?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash" id="tombolHapus" aria-hidden="true"></span> Hapus </a>
                                        </td>
                                        </tr>
                                        <?php
                                    }//end statement for read content from database table Admin.

                                    //condition if database table admin is empty.
                                }else {?>
                                    <tr>
                                        <td colspan="7">
                                            <h3>Hasil Tidak di Temukan (0)</h3>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>

                                <tr>
                                    <td colspan="9">
                                        <?php
                                        $query2     = mysqli_query($conn, "select id FROM blog_articel");
                                        $jmldata    = mysqli_num_rows($query2);
                                        $jmlhalaman = ceil($jmldata/$batas);
                                        ?>
                                        <ul class="pagination">
                                            <?php
                                            for($i=1;$i<=$jmlhalaman;$i++)
                                                if ($i != $halaman){
                                                    echo "<li><a href='blog-list-articel.php?halaman=$i'>$i</a></li> ";
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
                            </table>

                        </div>
                        <!-- /.table-responsive -->

                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->


<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // sql to delete a record
    $sql = "DELETE FROM blog_articel WHERE id= $id";

    if ($conn->query($sql) === TRUE) {
        echo "
                <script language='javascript'>
                 window.location.href = '../admin/blog-list-articel.php'
                </script>
                ";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>

<?php
    $apps->adminFooter();
?>