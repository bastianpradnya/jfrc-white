<?php
require_once "../config/Apps.php";
$apps = new Apps();
$apps->clientHeader();

?>

<?php
    function getDataCustomer($sessi_Email, $conn){
        $row = null;
        $result = null;

        //$sql = "SELECT id, nama_admin, username  FROM admin WHERE id=$id";
        $sql = "SELECT id, nama_customer, email,no_telp, alamat, tanggl_lahir, avatar, jenis_kelamin, tanggal_Registrasi FROM costumer WHERE email='$sessi_Email'";

        if(!empty($sessi_Email)){
            //query table admin
            $result = $conn->query($sql) or trigger_error($result);
        }

        if ($result == true) {
            //data menjadi array assosiatif
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        return $row;
    }

    function updateData($mail, $namaleng, $telp, $tanggal_lahir, $alamat,  $jenis_kelamin,  $avatar,  $conn){
        //query data
        $sql = "UPDATE costumer set nama_customer = '$namaleng',no_telp='$telp', alamat='$alamat', tanggl_lahir='$tanggal_lahir', jenis_kelamin='$jenis_kelamin', avatar='$avatar' WHERE email='$mail'";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
            /*
             * Jika record berhasil disimpan maka dilakukan direct halaman
             * ke halaman manage-admin.php dengan menggunakan perintah js
             */
            echo "
                    <script language='javascript'>
                         window.location.href = '../client/akunsaya.php'
                    </script>
                ";

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        $conn->close();
    }

    function cwUpload($field_name = '', $target_folder,  $thumb_folder, $thumb_width = '', $thumb_height = ''){
        //declare
        $file_name = '';
        $thumb = TRUE;

        //folder path setup
        $target_path = $target_folder;
        $thumb_path = $thumb_folder;

        //file name setup
        $filename_err = explode(".",$_FILES[$field_name]['name']);
        $filename_err_count = count($filename_err);
        $file_ext = $filename_err[$filename_err_count-1];
        if($file_name != ''){
            $fileName = time().$file_name.'.'.$file_ext;
        }else{
            $fileName = time().$_FILES[$field_name]['name'];
        }

        //upload image path
        $upload_image = $target_path.basename($fileName);

        //upload image
        if(move_uploaded_file($_FILES[$field_name]['tmp_name'],$upload_image))
        {
            //thumbnail creation
            if($thumb == TRUE)
            {
                $thumbnail = $thumb_path.$fileName;
                list($width,$height) = getimagesize($upload_image);
                $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
                switch($file_ext){
                    case 'jpg':
                        $source = imagecreatefromjpeg($upload_image);
                        break;
                    case 'jpeg':
                        $source = imagecreatefromjpeg($upload_image);
                        break;

                    case 'png':
                        $source = imagecreatefrompng($upload_image);
                        break;
                    case 'gif':
                        $source = imagecreatefromgif($upload_image);
                        break;
                    default:
                        $source = imagecreatefromjpeg($upload_image);
                }

                imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
                switch($file_ext){
                    case 'jpg' || 'jpeg':
                        imagejpeg($thumb_create,$thumbnail,100);
                        break;
                    case 'png':
                        imagepng($thumb_create,$thumbnail,100);
                        break;

                    case 'gif':
                        imagegif($thumb_create,$thumbnail,100);
                        break;
                    default:
                        imagejpeg($thumb_create,$thumbnail,100);
                }

            }

            return $fileName;
        }
        else
        {
            return false;
        }
    }

?>

<?php
    include "../config/Dbconnect.php";

    /*
     * Block program php pada bagian ini digunakan untuk membaca data dari database ke tampilan layout.
     */
    //inisialisasi
    $nama = $mail = $taggal_reg = $notelp = $avatar = $tanggl_lahir = $alamat = $jenis_kelamin = null;

    if(isset($_SESSION['email'])){
        $mail = $_SESSION['email'];

        $ambildata = getDataCustomer($mail, $conn);

        //instance
        $nama = $ambildata['nama_customer'];
        $mail = $ambildata['email'];
        $tanggal_reg = $ambildata['tanggal_Registrasi'];
        $notelp = $ambildata['no_telp'];
        $avatarget = $ambildata['avatar'];
        $tanggl_lahir = $ambildata['tanggl_lahir'];
        $alamat_get = $ambildata['alamat'];
        $jenis_kelamin = $ambildata['jenis_kelamin'];

    }
?>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"
          xmlns="http://www.w3.org/1999/html">


    <div class="login">
        <div class="wrap">
            <ul class="breadcrumb breadcrumb__t"><a class="home" href="index.php">Home</a>  / Akun Saya / <?php echo $nama ?></ul>
            <div class="section group">


            <div class="col-xs-12" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $nama ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center">
                                <?php
                                $path="../storage/avatar/";
                                if (empty($avatarget)){?>
                                    <img alt="User Pic" src="../storage/avatar/ava-default.png" class="img-rounded img-responsive">
                                <?php }else{?>
                                    <img alt="User Pic" src="<?php echo $path.$avatarget?>" class="img-rounded img-responsive">
                                <?php }?>

                            </div>

                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Nama Lengkap:</td>
                                        <td><?php echo $nama ?></td>
                                    </tr>
                                    <tr>
                                        <td>E-mail</td>
                                        <td><?php echo $mail ?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?php echo $notelp ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Lahir</td>
                                        <td><?php echo $tanggl_lahir ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td><?php echo $alamat_get ?></td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td><?php echo $jenis_kelamin ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Registrasi</td>
                                        <td><?php echo  $tanggal_reg?></td>
                                    </tr>

                                    </tbody>
                                </table>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Lengkapi Akun saya
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <?php
        /*
         * Block program yang digunakan untuk update data
         * customers.
         */
        $telp = $tgl_lahir = $alamat = $jenis_kelamin = $avatar = null;

            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $namaleng = $_POST['nama_leng'];
                $telp = $_POST['no_telp'];
                $tgl_lahir = $_POST['tanggal_lahir'];
                $alamat = $_POST['alamat'];
                $jenis_kelamin= $_POST['jenis_kelamin'];
                $avatar = time(). $_FILES['avatar']['name'];

                // Define directory to saved image  upload directory dan thumbnail directory.
                $path = "../storage/avatar/original/";
                $path_Thumb = "../storage/avatar/";

                /*
                 * call thumbnail creation function and store thumbnail name
                 * where parameter funct
                 * cwUpload($field_name, $target_folder, $file_name = '', $thumb = FALSE, $thumb_folder, $thumb_width = '', $thumb_height = '')
                 * $field_name --> file image name.
                 * $target_folder --> where your image file saved in directory
                 * $file_name -->
                 * $thumb --> thumbnail condition for ..
                 * $thumb_folder --> where your image thumbnail file saved in directory thumbnail.
                 * $thumb_width --> width of your image thumbnail  croped.
                 * $thumb_height -->height of your image thumbnail croped.
                 */
                //  $upload_img = cwUpload($gambar1, $path, '', TRUE, $path_Thumb, '200','160');

                //call thumbnail creation function and store thumbnail name
                $upload_img = cwUpload('avatar', $path, $path_Thumb, '537', '331');

                //$upload_img = cwUpload('image','uploads/','',TRUE,'uploads/thumbs/','200','160');

                //full path of the thumbnail image
                $thumb_src = '../storage/thumbs/'.$upload_img;

                //set success and error messages
                $message = $upload_img?"<span style='color:#008000;'>Image thumbnail have been created successfully.</span>":"<span style='color:#F00000;'>Some error occurred, please try again.</span>";

                //jalankan function simpan data
                updateData($mail, $namaleng, $telp, $tgl_lahir, $alamat,  $jenis_kelamin,  $avatar,  $conn);

            }

        ?>

            <script class="jsbin" src="../bower_components/bootstrap/js/modal.js"></script>
            <!-- Modal -->
            <div class="modal  fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog  modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Perbarui Data Profil</h4>
                        </div>

                        <div class="modal-body">

                            <div class="row">

                                <form action="#" method="post" enctype="multipart/form-data">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama</label>
                                            <input type="text" name="nama_leng" class="form-control" value="<?php echo $nama ?>" id="exampleInputEmail1" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $mail ?>" placeholder="Email" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">No. Telp</label>
                                            <input type="text" name="no_telp" class="form-control" value="<?php echo $notelp ?>" id="exampleInputEmail1" placeholder="No. Telp">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Alamat Lengkap</label>
                                            <textarea name="alamat" class="form-control" placeholder="Isi alamat anda dengan lengkap agar barang yang dikirimkan sesuai dengan tujuan"><?php echo $alamat_get ?></textarea>
                                        </div>
                                    </div>

                                    <!-- /.col-lg-6 -->
                                    <div class="col-lg-6">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tanggal Lahir</label>
                                            <input type="date" name="tanggal_lahir" class="form-control" id="exampleInputEmail1" value="<?php echo $tanggl_lahir ?>" placeholder="Tanggal Lahir">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control">
                                                <?php
                                                    if($jenis_kelamin == "Laki - Laki"){
                                                        ?><option value="Laki - Laki">Laki - Laki</option>
                                                          <option value="Perempuan">Perempuan</option><?php
                                                    }else{
                                                        ?><option value="Perempuan">Perempuan</option>
                                                        <option value="Laki - Laki">Laki - Laki</option><?php
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                        <!-- JS buat menampilkan image upload preview-->
                                        <script type="text/javascript">
                                            function readURL(input) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();

                                                    reader.onload = function (e) {
                                                        $('#imageView').attr('src', e.target.result);
                                                    }
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                        </script>

                                        <div class="form-group">
                                            <label>Upload Gambar</label><br>
                                            <img id="imageView" src="../storage/avatar/<?php echo $avatarget ?>"  class="img-rounded " style="width: 140px; height: 140px;"/><br>
                                            <input type='file'  class="img-responsive" id="exampleInputFile" name="avatar" onchange="readURL(this);" />
                                        </div>

                                    </div>
                                    <!-- /.col-lg-6 -->
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
$apps->clientFooter();
?>