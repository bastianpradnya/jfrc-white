<?php 
    require_once "../config/Apps.php";
    $apps = new Apps();
    $apps->adminHead();
?>


    <div class="col-lg-12">
        <h1 class="page-header">Manajemen Costumer</h1>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Daftar Costumer di TOKO JFRC 37
                </div>
                <div class="panel-body">

                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>No.Telp</th>
                                    <th>Alamat</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tanggal Registrasi</th>
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

                                $sql = "SELECT id, nama_customer, email, no_telp, tanggl_lahir, alamat, jenis_kelamin,
                                      tanggal_Registrasi, avatar  FROM costumer ORDER BY id DESC LIMIT $posisi, $batas ";

                                $result = $conn->query($sql);
                                $a = 0;
                                if ($result->num_rows > 0) { //if condition if table admin is already field
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    //statement for read database  from table admin in here
                                    ?>
                                    <tr>
                                        <td> <?php echo $a += 1;?></td>
                                        <?php $id = $row['id']; ?>
                                        <td> <?php echo $row['nama_customer']; ?> </td>
                                        <td> <?php echo $row['email']; ?> </td>
                                        <td> <?php echo $row['no_telp']; ?> </td>
                                        <td> <?php echo $row['alamat']; ?> </td>
                                        <td> <?php echo $row['tanggl_lahir']; ?> </td>
                                        <td> <?php echo $row['jenis_kelamin']; ?> </td>
                                        <td> <?php echo $row['tanggal_Registrasi']; ?> </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <?php
                                }//end statement for read content from database table Admin.
                                ?>


                            <?php
                            //condition if database table admin is empty.
                            }else {
                                echo "0 Results";
                            }
                            ?>
                                    <tr>
                                        <td colspan="9">
                                            <?php
                                            $query2     = mysqli_query($conn, "select id FROM costumer");
                                            $jmldata    = mysqli_num_rows($query2);
                                            $jmlhalaman = ceil($jmldata/$batas);
                                            ?>
                                            <ul class="pagination">
                                                <?php
                                                for($i=1;$i<=$jmlhalaman;$i++)
                                                    if ($i != $halaman){
                                                        echo "<li><a href='manage-customer.php?halaman=$i'>$i</a></li> ";
                                                    }
                                                    else{
                                                        echo "<li class='active'><a href='#'>$i</a></li> ";
                                                    }

                                                $conn->close(); //for closing conection database
                                                ?>
                                            </ul>

                                            <h5>Total Artikel : <?php echo $jmldata;?> Item</h5>
                                        </td>
                                    </tr>

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

</div>
<?php
    $apps->adminFooter();
?>