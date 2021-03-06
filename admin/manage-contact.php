<?php 
    require_once "../config/Apps.php";
    $apps = new Apps();
    $apps->adminHead();
?>


    <div class="col-lg-12">
        <h1 class="page-header">Pertanyaan atau Keluhan Pelanggan</h1>
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
                                    <th>Subject</th>
                                    <th>Isi Pesan</th>
                                    <th>Time</th>
                                    <th></th>
                                    
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

                                $sql = "SELECT id_kontak, nama_kontak, email_kontak, subjek_kontak, isi_pesan, waktu FROM kontak_kami ORDER BY id_kontak DESC LIMIT $posisi, $batas";
                                $result = $conn->query($sql);
                                $a = 0;
                                if ($result->num_rows > 0) { //if condition if table admin is already field
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    //statement for read database  from table admin in here
                                    ?>
                                    <tr>
                                        <td> <?php echo $a += 1;?></td>
                                        <?php $id = $row['id_kontak']; ?>
                                        <td> <?php echo $row['nama_kontak']; ?> </td>
                                        <td> <?php echo $row['email_kontak']; ?> </td>
                                        <td> <?php echo $row['subjek_kontak']; ?> </td>
                                        <td> <?php echo $row['isi_pesan']; ?> </td>                                      
                                        <td> <?php echo $row['waktu']; ?> </td>
                                        <td>
                                            <a href="../admin/manage-contact.php?id=<?php echo $id ?>" class="btn btn-danger">
                                                <span class="glyphicon glyphicon-trash" id="tombolHapus" aria-hidden="true"></span> Hapus </a>
                                        </td>

                                        </td>
                                    </tr>
                                    <?php
                                }//end statement for read content from database table Admin.

                            //condition if database table admin is empty.
                            }else {
                                echo "<h3>Hasil Tidak ditemukan !!</h3>";
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
                                                echo "<li><a href='manage-contact.php?halaman=$i'>$i</a></li> ";
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
<?php
include "../config/Dbconnect.php";

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // sql to delete a record
    $sql = "DELETE FROM kontak_kami WHERE id_kontak=$id";



    if ($conn->query($sql) === TRUE) {
        echo "
                <script language='javascript'>
                 window.location.href = '../admin/manage-contact.php'
                </script>
                ";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>

</div>
<?php
    $apps->adminFooter();
?>