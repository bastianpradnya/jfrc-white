<?php 
    include "../config/Apps.php";
    $apps = new Apps();
    $apps->adminHead();
?>
<?php
    function saveData($title, $kontent_artikel, $status, $category, $conn){
        /*
         * Fungsi SaveDataBLog digunakan untuk menyimpan data form
         * untuk dikirimkan ke database
         */
        //query data
        $sql = "INSERT INTO blog_articel (judul_artikel, kontent_artikel, kategori, status)
                VALUES ('$title', '$kontent_artikel', '$category', '$status' )";

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

    function addCategory($categoryAdd, $conn){
        /*
         * function add category digunakan untuk menambah kategori artikel
         * categori artikel ini disimpan ke dalam database tersendiri dengan
         * nama database blog_category_articel
         */

        $sql = "INSERT INTO blog_category_articel (category) VALUES ('$categoryAdd')";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
            echo " Category Has Added <br> ";

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }

    //declarate var
    $pesan = array(null, null, null, null );
    $formWarning =  array(null, null, null, null);
    $title = $category = $content_articel =  $status = null;

    //panggil database connect untuk proses query
    include "../config/Dbconnect.php";

    //validasi jika form terkirim adalah POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $title = $_POST['title'];
        $category = $_POST['category'];
        $content_articel = $_POST['content_articel'];
        $status = $_POST['status'];

        if (empty($title)) {
            $pesan[0] =  "* Judul Tidak Boleh Kosong";
            $formWarning[0] = "has-warning";
        }else{
            //jalankan function simpan data
            saveData($title, $content_articel, $status, $category,  $conn);
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
    <!-- /.row -->

    <form method="POST" action="#">
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
                        <input type="text" class="form-control" name="title" id="formGroupInputLarge" value="<?php echo $title?>" placeholder="Masukan Judul Artikel">
                        <p><i><?php echo $pesan[0]?></i></p>
                    </div>

                    <div class="form-group">
                        <label>Editor Untuk Kontent Blog</label>
                        <textarea name="content_articel" > <?php echo $content_articel ?> </textarea>
                        <script>
                            CKEDITOR.replace( 'content_articel' );
                        </script>
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
                    <i class="glyphicon glyphicon-flag"></i> kategori & Publikasi
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

    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Category</button>

    <!--
    pemanggilan class Modal, dimana class modal ini digunakan untuk membuat
    Popup tambah category
    -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">New message</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="control-label">Recipient:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="control-label">Message:</label>
                            <textarea class="form-control" id="message-text"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end Modal popup -->

<?php
    $apps->adminFooter();
?>