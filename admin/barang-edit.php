
<?php
include "../config/Apps.php";
$apps = new Apps();
$apps->adminHead();
?>
<?php

function getDataBarang($id, $conn){

    $sql = "SELECT id, nama_barang, harga, deskripsi, stok, status, kategori_barang, photo_1, photo_2, photo_3  FROM barang WHERE id=$id";

    //query table admin
    $result = $conn->query($sql) or trigger_error($result);
    //data menjadi array assosiatif
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    return $row;
}


function updateBarang($id, $namaBarang, $harga, $deskripsi, $stok,  $status, $kategori, $photo1, $conn){
    //query data
    $sql = "UPDATE barang set nama_barang = '$namaBarang', harga=$harga, deskripsi='$deskripsi', stok=$stok, status='$status',  kategori_barang='$kategori', photo_1='$photo1' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
        /*
         * Jika record berhasil disimpan maka dilakukan direct halaman
         * ke halaman manage-admin.php dengan menggunakan perintah js
         */
        echo "
                <script language='javascript'>
                     window.location.href = '../admin/barang-daftar.php'
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

<br>
<?php
//declarate var
$pesan = array(null, null, null, null );
$formWarning =  array(null, null, null, null);
//deklrate if var empty
$namaBarang = $harga = $deskripsi = $stok = $status = $kategori_barang = $photo1 = $photo2 = $photo3 = null;


//panggil database connect untuk proses query
include "../config/Dbconnect.php";

/*
 ********************************************************************
 * penggunaan variabel didalam container ini digunakan untuk melakukan
 * pemanggilan dan mengambil data dari method Get yang dikirim dari
 * url blog list, kemudian pada variabel $id nilainya ditampung.
 * selanjutkan dilakukan pemanggilan function getDataBlog untuk
 * memanggil data dari database. dimana nilai ini nantinya yang akan dilakukan
 * update data.
 *
 * ******************************************************************
 */


//get id from send data GET
$id = $_GET['id'];

//calling fuction and instance
$data = getDataBarang($id, $conn);

//transform data from  database array asositatif to variabel
$namaBarang = $data ['nama_barang'];
$harga =  $data ['harga'];
$deskripsi =  $data ['deskripsi'];
$stok =  $data ['stok'];
$status =  $data ['status'];
$kategori_barang =  $data ['kategori_barang'];
$photo1 =  $data ['photo_1'];
$photo2 =  $data ['photo_2'];
$photo3 =  $data ['photo_3'];


/*
 * *************************************************************
 * Akhir dari proses mengambil data dari database
 *
 * *******************************************************************
 */

//validasi jika form terkirim adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Ambil Data yang Dikirim dari Form
    $namaBarang = $_POST['nama_barang'];
    $harga = $_POST['harga_barang'];
    $kategori_barang = $_POST['category'];
    $stok = $_POST['stok_barang'];
    $deskripsi = $_POST['deskripsi'];
    $status = $_POST['status_barang'];

    $gambar1 = time().$_FILES['gambar1']['name'];
    // Set path folder tempat menyimpan gambarnya
    //  $path = "../storage/img/".$nama_file;

    if (isset($_FILES['gambar'])==empty(null)) {
        $pesan[3] =  "* Gambar 1 tidak Boleh Kosong";
    }

    if(empty($namaBarang) || empty($harga) || empty($stok) ){

        if (empty($namaBarang)) {
            $pesan[0] =  "* Nama barang tidak Boleh Kosong";
            $formWarning[0] = "has-warning";
        }
        if (empty($harga)) {
            $pesan[1] =  "* Harga tidak Boleh Kosong";
            $formWarning[1] = "has-warning";
        }
        if (empty($stok)) {
            $pesan[2] =  "* Stok tidak Boleh Kosong";
            $formWarning[2] = "has-warning";
        }

    }else{


        // Define directory to saved image  upload directory dan thumbnail directory.
        $path ="../storage/img/";
        $path_Thumb = "../storage/thumbs/";

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
        $upload_img = cwUpload('gambar1', $path, $path_Thumb, '537', '331');

        //$upload_img = cwUpload('image','uploads/','',TRUE,'uploads/thumbs/','200','160');

        //full path of the thumbnail image
        $thumb_src = '../storage/thumbs/'.$upload_img;

        //jalankan function simpan data
        updateBarang($id, $namaBarang, $harga, $deskripsi,  $stok,  $status, $kategori_barang, $gambar1, $conn);
    }
}

?>

<form method="POST" action="#" enctype="multipart/form-data">
    <div class="col-lg-12">
        <h1 class="page-header">Barang</h1>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-pencil"></i> Edit Data Barang
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="form-group <?php echo $formWarning[0] ?>">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang"  value="<?php echo $namaBarang?>" placeholder="Masukan Nama Barang">
                        <p><i><?php echo $pesan[0]?></i></p>
                    </div>

                    <div class="form-group <?php echo $formWarning[1] ?>">
                        <label>Harga</label>
                        <input type="text" class="form-control" name="harga_barang" value="<?php echo $harga?>" placeholder="Masukan Harga Dalam Rupiah">
                        <p><i><?php echo $pesan[1]?></i></p>
                    </div>

                    <div class="form-group <?php echo $formWarning[2] ?>">
                        <label>Stok</label>
                        <input type="text" class="form-control" name="stok_barang" value="<?php echo $stok?>" placeholder="Masukan Jumlah Stok">
                        <p><i><?php echo $pesan[2]?></i></p>
                    </div>

                    <div class="form-group">
                        <label>Deskprisi Barang</label>
                        <textarea name="deskripsi" ><?php echo $deskripsi ?></textarea>
                        <script>
                            CKEDITOR.replace( 'deskripsi' );
                        </script>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-send"></i>  Publikasi
                </div>
                <!-- /.panel-heading -->

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
                <div class="panel-body">

                    <div class="form-group">
                        <label>Upload Gambar 1</label><br>
                        <img id="imageView" src="../storage/thumbs/<?php echo $photo1 ?>"  class="img-rounded " style="width: 140px; height: 140px;"/><br>
                        <input type='file'  id="exampleInputFile" name="gambar1" onchange="readURL(this);" />
                        <p><i><?php echo $pesan[3]?></i></p>
                    </div>

                    <?php
                    $setStatus = array(null, null);
                    if($status == "Aktif"){
                        $setStatus[0]="checked";
                    }else{
                        $setStatus[1]="checked";
                    }
                    ?>

                    <div class="form-group">
                        <label>Pilih Catergory</label>
                        <select class="form-control" name="category">
                            <option><?php echo $kategori_barang?></option>
                            <option>Knalpot 37</option>
                            <option>Knalpot R9</option>
                            <option>Knalpot Creampie</option>
                            <option>Ban Second</option>
                            <option>Uncategory</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status Barang </label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status_barang" id="optionsRadios1" value="Aktif" <?php echo $setStatus[0]?>/>Aktif
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status_barang" id="optionsRadios2" value="Non Aktif" <?php echo $setStatus[1]?> />Non Aktif
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                            Update Barang</button>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</form>


<?php
$apps->adminFooter();
?>