<?php 
    include "../config/Apps.php";
    $apps = new Apps();
    $apps->adminHead();
?>
<?php
    function getDataAdmin($id, $conn){

      $sql = "SELECT id, nama_admin, username  FROM admin WHERE id=$id";

      //query table admin
      $result = $conn->query($sql) or trigger_error($result);
      //data menjadi array assosiatif
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

      return $row;
    }

    function updateDataAdmin($id, $nama, $password, $conn){

        $sql = "UPDATE admin SET nama_admin ='$nama', password='$password' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
            echo "
                <script language='javascript'>
                     window.location.href = '../admin/manage-admin.php'
                </script>
            ";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        $conn->close();
    }

?>

    <div class="col-lg-12">
        <h1 class="page-header">Manajemen Admin</h1>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Edit Data Admin
                </div>
                <div class="panel-body">

                    <!-- /.panel-heading -->
                    <div class="panel-body">

                        <?php
                        /*
                         * Fungsi Logic mulai berjalan disini
                         */

                        include "../config/Dbconnect.php";

                        //declarate var
                        $pesan = array(null, null, null, null );
                        $formWarning =  array(null, null, null, null);
                        $pass =  $password = null;

                        $id = $_GET['id'];


                        //calling fuction and instance
                        $data = getDataAdmin($id, $conn);

                        //transform data from  database array asositatif to variabel
                        $nama = $data ['nama_admin'];
                        $username =  $data ['username'];


                        //validasi jika form terkirim adalah POST
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {

                            $namaAdmin = $_POST['nama_admin'];
                            $username = $_POST['username'];
                            $pass = $_POST['pass'];
                            $password = $_POST['password'];

                            if(empty($namaAdmin) || empty($pass) || empty($password) ){

                                if (empty($namaAdmin)) {
                                    $pesan[0] =  "* Nama tidak Boleh Kosong";
                                    $formWarning[0] = "has-warning";
                                }
                                if (empty($pass)) {
                                    $pesan[2] =  "* Password tidak Boleh Kosong";
                                    $formWarning[2] = "has-warning";
                                }
                                if (empty($password)) {
                                    $pesan[3] =  "* PassKonfirmasi  tidak Boleh Kosong";
                                    $formWarning[3] = "has-warning";
                                }

                            }else{
                                if($pass != $password){
                                    $pesan[2] =  "* Password Tidak Sama";
                                    $formWarning[2] = "has-warning";
                                    $pesan[3] =  " * Password Tidak Sama";
                                    $formWarning[3] = "has-warning";
                                }else{
                                    //jalankan function update data
                                    updateDataAdmin($id, $namaAdmin, md5($password), $conn);
                                }
                            }
                        }

                        ?>
                        <form class="form-horizontal" role="form" method="post" action="#">
                            <div class="form-group <?php echo $formWarning[0] ?>">
                                <label class="control-label col-sm-2">Nama :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="text" name="nama_admin" value="<?php echo $nama ?>" placeholder="Nama Lengkap">
                                    <p><i><?php echo $pesan[0] ?></i></p>
                                </div>
                            </div>

                            <div class="form-group <?php echo $formWarning[1] ?>">
                                <label class="control-label col-sm-2" for="email">Username :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="text" name="username" value="<?php echo $username ?>" placeholder="Username Admin" readonly>
                                    <p><i><?php echo $pesan[1] ?></i></p>
                                </div>
                            </div>

                            <div class="form-group <?php echo $formWarning[2] ?>">
                                <label class="control-label col-sm-2" for="pwd">Password :</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="pass" value="<?php echo $pass ?>" placeholder="Password">
                                    <p><i><?php echo $pesan[2] ?></i></p>
                                </div>
                            </div>

                            <div class="form-group <?php echo $formWarning[3] ?>">
                                <label class="control-label col-sm-2" for="pwd">Konf Pass :</label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" value="<?php echo $password?>" name="password" placeholder="Konfirmasi password">
                                    <p><i><?php echo $pesan[3] ?></i></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></span> Perbarui Data</button>
                                </div>
                            </div>
                        </form>


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
    $apps->adminFooter();
?>