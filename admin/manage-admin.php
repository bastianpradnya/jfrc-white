<?php 
    require_once "../config/Apps.php";
    $apps = new Apps();
    $apps->adminHead();
?>


    <div class="col-lg-12">
        <h1 class="page-header">Manajemen Admin</h1>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Daftar user Ad
                </div>
                <div class="panel-body">
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div>
                            <a href="../admin/manage-admin-create.php" class="btn btn-primary">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Admin</a>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Admin User</th>
                                    <th>Username</th>
                                    <th>Date Registry</th>
                                    <th>Operational</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                //panggil database dbconnect untuk melakukan proses query
                                include "../config/Dbconnect.php";

                                $batas   = 5;
                                $halaman = @$_GET['halaman'];
                                if(empty($halaman)){
                                    $posisi  = 0;
                                    $halaman = 1;
                                }
                                else{
                                    $posisi  = ($halaman-1) * $batas;
                                }
                                $no = $posisi+1;

                                $sql = "SELECT id, nama_admin, username, reg_date  FROM admin LIMIT $posisi, $batas";
                                $result = $conn->query($sql);

                                $a = 0;
                                if ($result->num_rows > 0) {
                                //if condition if table admin is already field

                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    //statement for read database  from table admin in here
                                    ?>
                                    <tr>
                                        <td> <?php echo $a += 1;?></td>
                                        <?php $id = $row['id']; //get id per field ?>
                                        <td> <?php echo $row['nama_admin']; ?> </td>
                                        <td> <?php echo $row['username']; ?> </td>
                                        <td> <?php echo $row['reg_date']; ?> </td>
                                        <td>
                                            <a href="../admin/manage-admin-edit.php?id=<?php echo $id ?>" class="btn btn-warning">
                                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>

                                            <a href="../admin/manage-admin.php?id=<?php echo $id ?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash" id="tombolHapus" aria-hidden="true"></span> Hapus </a>
                                        </td>
                                    </tr>

                                    <?php
                                }//end statement for read content from database table Admin.
                                ?>
                            </table>
                            <?php
                            //condition if database table admin is empty.
                            }else {?>
                                <tr>
                                    <td colspan="4">

                                        <h3>Hasil Tidak di Temukan (0)</h3>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                            <tr>
                                <td colspan="4">
                                    <?php
                                    $query2     = mysqli_query($conn, "select id FROM barang");
                                    $jmldata    = mysqli_num_rows($query2);
                                    $jmlhalaman = ceil($jmldata/$batas);
                                    ?>
                                    <ul class="pagination">
                                        <?php
                                        for($i=1;$i<=$jmlhalaman;$i++)
                                            if ($i != $halaman){
                                                echo "<li><a href='manage-admin.php?halaman=$i'>$i</a></li> ";
                                            }
                                            else{
                                                echo "<li class='active'><a href='#'>$i</a></li> ";
                                            }
                                        ?>
                                    </ul>
                                </td>
                            </tr>


                        </div>
                        <!-- /.table-responsive -->
                    </div>

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
        $sql = "DELETE FROM admin WHERE id= $id";

        if ($conn->query($sql) === TRUE) {
            echo "
                <script language='javascript'>
                 window.location.href = '../admin/manage-admin.php'
                </script>
                ";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        $conn->close();
    }
?>

<!--
| poopup for deleting admin
-->
<div id="hapus-record-admin" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Hapus Data Admin</h4>
            </div>
            <div class="modal-body">
                <div class="">
                    <?php
                        echo $user_id = $_GET['user_id'] ;
                    ?>
                    h2>Hasil: <span id="hasil"></span></h2>
                    <h5>Apakah anda yakin ingin menghapus data Admin ?</h5><br>
                    <center>
                        <button type="button" class="btn btn-warning">YA</button> &nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    $apps->adminFooter();
?>