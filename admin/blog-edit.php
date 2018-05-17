<?php
include "../config/Apps.php";
$apps = new Apps();
$apps->adminHead();
?>
<?php
function getDataBlog($id, $conn){

    $sql = "SELECT id, judul_artikel, kontent_artikel, status, kategori  FROM blog_articel WHERE id=$id";

    //query table blog-articel
    $result = $conn->query($sql) or trigger_error($result);
    //data menjadi array assosiatif
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    return $row;
}

function updateDataBlog($id, $judul, $kontent, $status, $kategori, $conn){

    $sql = "UPDATE blog_articel SET judul_artikel ='$judul', kontent_artikel='$kontent', status='$status', kategori='$kategori' WHERE id=$id";


    if ($conn->query($sql) === TRUE) {
       // echo "Record updated successfully";

        echo "
                <script language='javascript'>
                     window.location.href = '../admin/blog-list-articel.php'
                </script>
            ";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}

?>

<?php
    /*
     * Fungsi Logic mulai berjalan disini
     */

    include "../config/Dbconnect.php";

    //declarate var
    $pesan = array(null, null, null, null );
    $formWarning =  array(null, null, null, null);
    $judul = $kontent = $status = $kategori = null;


    $id = $_GET['id'];

    //calling fuction and instance
    $data = getDataBlog($id, $conn);

    //transform data from  database array asositatif to variabel
    $judul = $data ['judul_artikel'];
    $kontent =  $data ['kontent_artikel'];

    //validasi jika form terkirim adalah POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $judul = $_POST['title'];
        $kontent = $_POST['content_articel'];
        $status = $_POST['status'];
        $kategori = $_POST['category'];

        if (empty($judul)) {
            $pesan[0] =  "* Judul Tidak Boleh Kosong";
            $formWarning[0] = "has-warning";
        }elseif(empty($kontent)){
            $pesan[1] =  "* Kontent Tidak Boleh Kosong";
            $formWarning[1] = "has-warning";
        }else{
            //jalankan function simpan data
            updateDataBlog($id, $judul, $kontent, $status, $kategori, $conn );
        }
    }
?>

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Artikel Blog</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    <form method="POST" action="#">
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-pencil"></i> Editor Post
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="form-group form-group-lg <?php echo $formWarning[0] ?>">
                        <label>Judul</label>
                        <input type="text" class="form-control" name="title" id="formGroupInputLarge" value="<?php echo $judul ?>" placeholder="Masukan Judul Artikel">
                        <p><i><?php echo $pesan[0]?></i></p>
                    </div>

                    <div class="form-group">
                        <label>Editor Untuk Kontent Blog</label>
                        <textarea name="content_articel" ><?php echo $kontent ?></textarea>
                        <script>
                            CKEDITOR.replace( 'content_articel' );
                        </script>
                        <p><i><?php echo $pesan[1]?></i></p>
                    </div>

                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->

        </div>
        <!-- /.col-lg-8 -->

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="glyphicon glyphicon-flag"></i> Kategori & Publikasi
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="form-group">
                        <label>Pilih Catergory</label>
                        <select class="form-control" name="category">
                            <option>Category Belum Terplilih</option>
                            <option>Category 1</option>
                            <option>Category 2</option>
                        </select>
                        <p><i>* Gunakan kategori untuk melakukan filter artikel yang terbitkan</i></p>

                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">
                            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Category</button>
                    </div>

                    <div class="form-group">
                        <label>Status Artikel</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" id="optionsRadios1" value="Publish" checked>Publikasikan Artikel
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" id="optionsRadios2" value="Draft">Simpan sebagai Draft
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-send" aria-hidden="true"></span>
                        Publish Artikel</button>

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