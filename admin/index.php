<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JFRC37 - LOGIN</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <!--
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<?php
    function sessionCek($conn){
        /*
        * function session cek ini digunakan untuk melakukan validasi.
        * dimana jika suatu sesi telah habis maka akan dilakukan direct ke login page.
        * dalam pengunaan fungsi ini harus menyertakan terlebih dahulu pemanggilan fungsi Session_start()
        * agar fungsi sessionCek ini dapat digunakan.
        */

        if(isset($_SESSION['username'])){
            $adminName = null;
            $admin_check = $_SESSION['username'];

            $sql = "SELECT nama_admin FROM admin WHERE username ='$admin_check' ";
            $result = $conn->query($sql) or trigger_error($result);

            if($result->num_rows > 0) {
                header("Location:../admin/dashboard.php ");
            }else{
                /*
                * Jika Record KOSONG dari hasil query maka pada kondisi ini
                * Direct login dilakukan dimana admin melakukan login kembali untuk masuk kehalaman admin.
                */

                echo "
                      <script language='javascript'>
                           window.location.href = '../admin/index.php'
                      </script>";
            }
        }
        /*
         * return pada variabel admin name digunakan untuk mengembalikan nilai dari variabel admin name
         * dimana pada variabel ini nantinya dapat digunakan diluar function ini.
         * salah satu penggunaannya adalah menampilkan nama user admin yang sedang login.
         */
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Silahkan Masuk</h3>
                </div>
                <div class="panel-body">
                    <?php
                        include "../config/Dbconnect.php";
                        session_start();

                        //deklarate variabel
                        $pesan = array(null, null, null, null );
                        $formWarning =  array(null, null, null, null);
                        $username = $password = $salah = null;

                        //validasi jika user sudah login dengan memanggil fungsi sessioncek
                        sessionCek($conn);


                        if ($_SERVER["REQUEST_METHOD"] == "POST"){
                            $username = $_POST['username'];
                            $password = md5($_POST['password']);

                            if(empty($username) || empty($password)){
                                if(empty($username)){
                                    $pesan[0] = "* username tidak boleh kosong.";
                                    $formWarning[0] = "has-warning";
                                }
                                if(empty($password)){
                                    $pesan[1] = "* password tidak boleh kosong.";
                                    $formWarning[1] = "has-warning";
                                }
                            }else{

                                $sql = "SELECT username FROM admin WHERE username = '$username' AND password ='$password' ";
                                $result = $conn->query($sql) or trigger_error($result);

                                if($result->num_rows > 0){
                                    //pemanggilan record menjadi array asosiatif.
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                    //inisialisasi aray asosiatif menjadi var
                                    $sesNamaAdm = $row ['username'];

                                    /*
                                     * digunakan untuk membuat sesi,
                                     * dimana sesi ini digunakan untuk mengakses halaman admin.
                                     */
                                    $_SESSION['username'] = $sesNamaAdm;

                                    /*
                                     * jika username dan password sesuai dengan data yang ada didatabase
                                     * maka dilakukan direct link ke halaman Admin.
                                     * dirrect link ini menuju ke halaman dashboard admin.
                                     */
                                    echo "
                                        <script language='javascript'>
                                             window.location.href = '../admin/dashboard.php'
                                        </script>
                                       ";

                                    //echo "Login Berhasi";
                                }else{
                                    $salah = " Username atau Password salah";
                                    $formWarning[0] = "has-warning";
                                    $formWarning[1] = "has-warning";
                                }
                            }
                        }
                    ?>

                    <form role="form" method="post" action="#">
                        <fieldset>
                            <div class="form-group <?php echo $formWarning[0] ?>">
                                <input class="form-control" placeholder="Masukkan username" value="<?php echo $username?>" name="username" type="text" autofocus>
                                <p><i><?php echo $pesan[0] ?></i></p>
                            </div>
                            <div class="form-group <?php echo $formWarning[1] ?>">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                <p><i><?php echo $pesan[1]?></i></p>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Ingatkan Saya
                                </label>
                            </div>
                            <div class="form-group">
                                <p style="color:#800000"><?php echo $salah ?></p>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">Masuk</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

