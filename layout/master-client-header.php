<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>JFRC 37 - OFFICIAL SITES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
    <link href="../css/form.css" rel="stylesheet" type="text/css" media="all" />
    <link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="../js/jquery1.min.js"></script>
    <!-- start menu -->
    <link href="../css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="../js/megamenu.js"></script>
    <script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
    <!--start slider -->
    <link rel="stylesheet" href="../css/fwslider.css" media="all">
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/css3-mediaqueries.js"></script>
    <script src="../js/fwslider.js"></script>
    <!--end slider -->
    <script src="../js/jquery.easydropdown.js"></script>
</head>
<body>

<div class="header-top">
    <div class="wrap">
        <div class="header-top-left">
            <!--masih kosong-->
        </div>
        <div class="cssmenu">

            <ul>
                <?php

                //panggil database dbconnect untuk melakukan proses query
                require "../config/Dbconnect.php";

                session_start();

                function sessionCek($conn){
                    /*
                    * function session cek ini digunakan untuk melakukan validasi.
                    * dimana jika suatu sesi telah habis maka akan dilakukan direct ke login page.
                    * dalam pengunaan fungsi ini harus menyertakan terlebih dahulu pemanggilan fungsi Session_start()
                    * agar fungsi sessionCek ini dapat digunakan.
                    */

                    if(isset($_SESSION['email'])){
                        $customer = $customerName = null;
                        $customer = $_SESSION['email'];

                        $sql = "SELECT nama_customer FROM costumer WHERE email ='$customer' ";
                        $result = $conn->query($sql) or trigger_error($result);

                        if($result->num_rows > 0) {
                            //pemanggilan record menjadi array asosiatif.
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                            //institalize to var
                            $customerName = $row['nama_customer'];

                        }else{
                            /*
                            * Jika Record KOSONG dari hasil query maka pada kondisi ini
                            * Direct login dilakukan dimana admin melakukan login kembali untuk masuk kehalaman admin.
                            */
                            /*
                            echo "
                                  <script language='javascript'>
                                       window.location.href = '../client/index.php'
                                  </script>";*/
                        }
                        //   $conn->close();

                    }else{
                        /*
                        * jika variabel sesi dengan element email kosong maka dilakukan direct link
                        * dimana user admin melakukan login kembali untuk mengakses halaman admin.
                        */

                    }
                    /*
                     * return pada variabel admin name digunakan untuk mengembalikan nilai dari variabel admin name
                     * dimana pada variabel ini nantinya dapat digunakan diluar function ini.
                     * salah satu penggunaannya adalah menampilkan nama user admin yang sedang login.
                     */
                    if(!empty($customer)){
                        return $customerName;
                    }
                }


                //jalankan fungsi sessionCek
                sessionCek($conn);

                ?>

                <?php
                /*
                 * Digunakan untuk menampilkan nama Customer yang sedang login.
                 * variabel nama_admin digunakan untuk mengabil nilai dari adminName yang ada pada file admn_Sesion.php
                 */

                //memanggil sesion cek dan menginstance
                $nama_customer = sessionCek($conn);
                if(!empty($nama_customer)){
                    ?>
                    <li class="active"><h4>Selamat Datang '<?php echo $nama_customer ?>' &nbsp; </h4> </li> &nbsp; |
                    <li class="active"><a href="akunsaya.php">Akun Saya</a></li> |
                    <li><a href="../client/keranjang.php">Checkout</a></li> |
                    <li><a href="../client/logout.php">Logout</a></li>
                    <?php
                }else{
                    ?>
                    <li><a href="checkout.php">Checkout</a></li> |
                    <li><a href="login.php">Log In</a></li> |
                    <li><a href="register.php">Daftar</a></li>
                    <?php
                }

                /*
                 * Sesi untuk keranjang belanja.
                 */
                $total = 0;


                ?>

            </ul>
        </div>
        <div class="clear"></div>
    </div>
</div>

<div class="clear"></div>

<div class="header-bottom">
    <div class="wrap">
        <div class="header-bottom-left">
            <div class="logo">
                <a href="../client/"><img src="../images/logo.png" alt=""/></a>
            </div>
            <div class="menu">
                <ul class="megamenu skyblue">
                    <li class="active grid"><a href="../client/">Beranda</a></li>
                    <li><a class="color4" href="#">PRODUCT</a>
                        <div class="megapanel">
                            <div class="row">
                                <div class="col1">
                                    <div class="h_nav">
                                        <h4>Knalpot</h4>
                                        <ul>
                                            <li><a href="../client/jfrc37.php">37 Exhaust</a></li>
                                            <li><a href="../client/r9.php">R9</a></li>
                                            <li><a href="../client/creampie.php">Creampie</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col1">
                                    <div class="h_nav">
                                        <h4>BAN</h4>
                                        <ul>
                                            <li><a href="../client/ban_second.php">Ban Second</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a class="color6" href="../blog/">BLOG</a></li>
                    <li><a class="color7" href="#">BANTUAN</a>
                        <div class="megapanel">
                            <div class="col1">
                                <div class="h_nav">
                                    <a href="../client/about.php" class="color6"> <h4>Tentang Kami</h4> </a>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <a href="../client/contact.php" class="color6"><h4>Hubungi Kami</h4> </a>
                                </div>
                            </div>
                            <div class="col1">
                                <div class="h_nav">
                                    <a href="carabelanja.php" class="color6"><h4>Cara Belanja</h4> </a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="header-bottom-right">
            <!---Box pencarian barang -->
            <div class="search">
                <form action="../client/hasil.php" method="POST">
                    <input type="text" name="nama" class="textbox" value="Cari Barang" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Cari Barang';}">
                    <input type="submit" value="Subscribe" id="submit" name="submit"></form>
                <div id="response"> </div>
            </div>
            <!---End Box pencarian barang -->
            <div class="tag-list">
                <ul class="icon1 sub-icon1 profile_img">
                    <li><a class="active-icon c2" href="#"> </a>
                        <ul class="sub-icon1 list">
                            <li><h3>Keranjang Belanja</h3><a href=""></a></li>
                            <li><p>Belanjaan yang masuk keranjang belanja<a href="">adipiscing elit, sed diam</a></p></li>
                        </ul>
                    </li>
                </ul>
                <ul class="last"><li><a href="#">Cart(0)</a></li></ul>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!---end tag header fixed-->

<!--content inhere-->