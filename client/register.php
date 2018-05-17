<?php
require_once "../config/Apps.php";
$apps = new Apps();
$apps->clientHeader();
?>

<?php
/*
 * menjalankan query simpan data
 * Parameter saveData yang digunakan,
 * variabel nama_admin dari input data admin
 * variabel username dari inputdata form username
 * variabel password dari input data password
 * variabel conn dari variabel koneksi yang digunakan untuk proses query dari file DbConnect.php directory config
 */
function saveDataCustomer($namaLengkap, $email, $password, $tanggallahir, $conn){
    //query data
    $sql = "INSERT INTO costumer (nama_customer, email, tanggl_lahir, password )VALUES ('$namaLengkap', '$email','$tanggallahir', '$password')";

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
        $_SESSION['email'] = $email; //session email

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>

<?php
    //declarate var
    $pesan = array(null, null, null, null, null, null, null, null, null, null, null, null, null, null );
    $namaLengkap = $email =  $pass =   $passwordkonfr = $tanggallahir = $tanggal_valid = null;

    //panggil database connect untuk proses query
    include "../config/Dbconnect.php";

    //validasi jika form terkirim adalah POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $namaLengkap = $_POST['nama_lengkap'];
        $email = $_POST['e-mail'];
        $pass =  $_POST['pass'];
        $passwordkonfr = $_POST['konfirmPass'];
        $tanggallahir = $_POST['Tanggal_Lahir'];

        $tanggal_valid = substr($tanggallahir, 0, 4);


        if(empty($namaLengkap) || empty($email) || empty($pass) || empty($passwordkonfr) || empty($tanggallahir)){

            if (empty($namaLengkap)) {
                $pesan[0] =  "* Nama tidak Boleh Kosong";
            }
            if (empty($email)) {
                $pesan[1] =  "* Username tidak Boleh Kosong";
            }
            if (empty($pass)) {
                $pesan[2] =  "* Password tidak Boleh Kosong";
            }
            if (empty($passwordkonfr)) {
                $pesan[3] =  "* Konfirmasi Password  tidak Boleh Kosong";
            }
            if (empty($tanggallahir)) {
                $pesan[6] =  "* Tanggal Lahir harus di isi";
            }

        }else if($tanggal_valid > 1998) {
            $pesan[7] =  "* Pendaftaran Harus Minimal Umur 15 Tahun";

        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $pesan[8] =  "Alamat email yang anda dimasukkan tidak valid";
            $pass = null;
            $passwordkonfr = null;

        }else{

            $query = "SELECT 1 FROM admin WHERE username = '$email'";
            $result = $conn->query($query);

            if($result->num_rows > 0){
                $pesan[4] =  "* Email Sudah Ada";
            }
            elseif($pass != $passwordkonfr){
                $pesan[5] =  "* Password Tidak Sama";
            }
            else{
                //jalankan function simpan data
                saveDataCustomer($namaLengkap, $email, md5($passwordkonfr), $tanggallahir,  $conn);
            }
        }
    }
?>

<div class="register_account">
	<div class="wrap">
      <h4 class="title">Buat Akun</h4>
       <form action="#" method="post">
         <div class="col_1_of_2 span_1_of_2">
            <div>
                <input type="text"  placeholder="Nama Lengkap" name="nama_lengkap" value="<?php echo $namaLengkap ?>">
                <p style="color: #990000"><i><?php echo $pesan[0] ?></i></p>
            </div>

            <div>
                <input type="password" placeholder="Password" name="pass" >
                <p style="color: #990000"><i><?php echo $pesan[2] ?></i></p>
                <p style="color: #990000"><i><?php echo $pesan[5] ?></i></p>
            </div>

            <div>
                <input type="password"  placeholder="Konfirmasi Password" name="konfirmPass" >
                <p style="color: #990000"><i><?php echo $pesan[3] ?></i></p>
                <p style="color: #990000"><i><?php echo $pesan[5] ?></i></p>
            </div>

         </div>

         <div class="col_1_of_2 span_1_of_2">

             <div>
                 <input type="text"  placeholder="E-Mail" name="e-mail" value="<?php echo $email ?>">
                 <p style="color: #990000"><i><?php echo $pesan[1] ?></i></p>
                 <p style="color: #990000"><i><?php echo $pesan[4] ?></i></p>
                 <p style="color: #990000"><i><?php echo $pesan[8] ?></i></p>
             </div>

             <div>
                 <input type="date" class="register_account" placeholder="Tanggal Lahir" name="Tanggal_Lahir"  value="<?php echo $tanggallahir ?>">
                 <p style="color: #990000"><i><?php echo $pesan[6] ?></i></p>
                 <p style="color: #990000"><i><?php echo $pesan[7] ?></i></p>
             </div>


            <p class="terms">Dengan mengeklik 'Buat Akun' anda menyetujui segala
                <a href="#">ketentuan yang berlaku di Toko JFRC 37</a>.</p>
             <br><br><br><br>
                <button class="grey">BUAT AKUN</button>
            <div class="clear"></div>

            </form>

        </div>
</div>

    <br><br><br><br><br><br><br><br><br><br><br><br>
    <br><br><br><br><br><br><br><br><br><br><br><br>

<?php
$apps->clientFooter();
?>
