
<?php
/*
 * menjalankan query simpan data
 * Parameter saveData yang digunakan,
 * variabel nama_admin dari input data admin
 * variabel username dari inputdata form username
 * variabel password dari input data password
 * variabel conn dari variabel koneksi yang digunakan untuk proses query dari file DbConnect.php directory config
 */
function saveData($namaAdmin, $username, $password, $conn){
    //query data
    $sql = "INSERT INTO admin (nama_admin, username, password )VALUES ('$namaAdmin', '$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
        /*
         * Jika record berhasil disimpan maka dilakukan direct halaman
         * ke halaman manage-admin.php dengan menggunakan perintah js
         */
        echo "Data Record Berhasil Disimpan<br>
                <b>Silahkan Login ke <a href='../admin/'>Admin</a></b> 
            <br><br><hr>";

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>

<?php
//declarate var
$pesan = array(null, null, null, null );
$formWarning =  array(null, null, null, null);
$namaAdmin =  $username = $pass =  $password = null;

//panggil database connect untuk proses query
include "../config/Dbconnect.php";

//validasi jika form terkirim adalah POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $namaAdmin = $_POST['nama_admin'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $password = $_POST['password'];

    if(empty($namaAdmin) || empty($username) || empty($pass) || empty($password)){

        if (empty($namaAdmin)) {
            $pesan[0] =  "* Nama tidak Boleh Kosong";
            $formWarning[0] = "has-warning";
        }
        if (empty($username)) {
            $pesan[1] =  "* Username tidak Boleh Kosong";
            $formWarning[1] = "has-warning";
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

        $query = "SELECT 1 FROM admin WHERE username = '$username'";
        $result = $conn->query($query);

        if($result->num_rows > 0){
            $pesan[1] =  "* Username Sudah Ada";
            $formWarning[1] = "has-warning";
        } elseif($pass != $password){
            $pesan[2] =  "* Password Tidak Sama";
            $formWarning[2] = "has-warning";
            $pesan[3] =  " * Password Tidak Sama";
            $formWarning[3] = "has-warning";
        }else{
            //jalankan function simpan data
            saveData($namaAdmin, $username, md5($password), $conn);
        }
    }
}
?>

<form method="post" action="#" class="form-horizontal">
    <div class="form-group <?php echo $formWarning[0] ?>">
        <div class="col-sm-9">
            <input type="text" class="form-control" id="text" name="nama_admin" value="<?php echo $namaAdmin ?>" placeholder="Nama Lengkap">
            <p><i><?php echo $pesan[0] ?></i></p>
        </div>
    </div>

    <div class="form-group <?php echo $formWarning[1] ?>">
        <div class="col-sm-9">
            <input type="text" class="form-control" id="text" name="username" value="<?php echo $username ?>" placeholder="Username Admin">
            <p><i><?php echo $pesan[1] ?></i></p>
        </div>
    </div>

    <div class="form-group <?php echo $formWarning[2] ?>">
        <div class="col-sm-9">
            <input type="password" class="form-control" name="pass" value="<?php echo $pass ?>" placeholder="Password">
            <p><i><?php echo $pesan[2] ?></i></p>
        </div>
    </div>

    <div class="form-group <?php echo $formWarning[3] ?>">
        <div class="col-sm-9">
            <input type="password" class="form-control" value="<?php echo $password?>" name="password" placeholder="Konfirmasi password">
            <p><i><?php echo $pesan[3] ?></i></p>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Tambah Admin</button>
        </div>
    </div>
    <p><i>* Ini digunakan alternative jika semua user admin terdelete.</i></p>
</form>

