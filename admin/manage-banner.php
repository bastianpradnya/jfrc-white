<?php
include "../config/Apps.php";
$apps = new Apps();
$apps->adminHead();
?>


<?php
function saveData($title, $photo, $status, $conn){
    /*
     * Fungsi SaveDataBLog digunakan untuk menyimpan data form
     * untuk dikirimkan ke database
     */
    //query data
    $sql = "INSERT INTO blog_articel (judul, photo, status)
                VALUES ('$title', '$photo', '$status' )";

    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
        echo "
            <script language='javascript'>
                 window.location.href = '../admin/blog-list-articel.php'
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

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manajemen Banner </h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <!-- /.row -->

    <form method="POST" action="#">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="glyphicon glyphicon-pencil"></i> Banner Photo Customer
                    </div>

                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                            <?php
                                //declarate var
                                $pesan = array(null, null, null, null );
                                $formWarning =  array(null, null, null, null);
                                $title = $banner  =  $status = null;

                                //panggil database connect untuk proses query
                                include "../config/Dbconnect.php";

                                //validasi jika form terkirim adalah POST
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                                    $title = $_POST['title'];
                                    $banner = time().$_FILES['gambar']['name'];
                                    $status = $_POST['status'];

                                    if (empty($title) || empty($_FILES['gambar'])) {
                                        if(empty($title)){
                                            $pesan[0] =  "* Judul Tidak Boleh Kosong";
                                            $formWarning[0] = "has-warning";
                                        }
                                        if(empty($_FILES['gambar'])){
                                            $pesan[1] =  "* Gambar Harus di Isi";
                                            $formWarning[0] = "has-warning";
                                        }
                                    }else{

                                        // Define directory to saved image  upload directory dan thumbnail directory.
                                        $path =null;
                                        $path_Thumb = "../storage/banner/";

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
                                        $upload_img = cwUpload('gambar', $path, $path_Thumb, '1680', '600');

                                        //$upload_img = cwUpload('image','uploads/','',TRUE,'uploads/thumbs/','200','160');

                                        //full path of the thumbnail image
                                        $thumb_src = '../storage/banner/'.$upload_img;

                                        //set success and error messages
                                        $message = $upload_img?"<span style='color:#008000;'>Image thumbnail have been created successfully.</span>":"<span style='color:#F00000;'>Some error occurred, please try again.</span>";

                                        //jalankan function simpan data
                                        saveData($title, $banner, $status, $conn);
                                    }
                                }
                                ?>


                                <form action="#" method="post"  enctype="multipart/form-data">

                                <div class="form-group <?php echo $formWarning[0] ?>">
                                    <label>Nama Banner</label>
                                    <input type="text" class="form-control" name="title" value="<?php echo $title?>" placeholder="Nama Banner">
                                    <p><i><?php echo $pesan[0]?></i></p>
                                </div>

                                <div class="form-group">
                                    <label>Status </label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="optionsRadios1" value="Aktif" checked>Aktif
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="status" id="optionsRadios2" value="Non Aktif">Non Aktif
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">


                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <input type="file" name="gambar" id="exampleInputFile">
                                    <p class="help-block">Example block-level help text here.</p>
                                </div>

                                <!-- JS buat menampilkan image upload preview-->
                                <!-- <script type="text/javascript">
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
                                    <img id="imageView"  class="img-rounded " style="width: 140px; height: 140px;"/><br>
                                    <input type="file" name="gambar" id="exampleInputFile">
                                    <p><i><?php /*echo $pesan[3]*/?></i></p>
                                </div>-->


                                <button type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    Tambah Banner</button>
    </form>

                            </div>
                        </div>


                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <!-- /.row -->
    </form>


<?php
$apps->adminFooter();
?>