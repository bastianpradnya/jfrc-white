<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>JFRC 37 | Admin</title>

    <!--
        | Bostrap linked server to read css and Js.
        |
        -->
    <!--  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      -->
    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--CkEditor-->
     <script src="../bower_components/ckeditor/ckeditor.js"></script>


   <!-- <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
   -->
    <script class="jsbin" src="../bower_components/jquery/dist/jquery.js"></script>
    <script class="jsbin" src="../bower_components/jquery/dist/jquery.min.js"></script>
    <link class="jsbin" href="../bower_components/jquery">

</head>
<body>
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

        if(isset($_SESSION['username'])){
            $adminName = null;
            $admin_check = $_SESSION['username'];

            $sql = "SELECT nama_admin FROM admin WHERE username ='$admin_check' ";
            $result = $conn->query($sql) or trigger_error($result);

            if($result->num_rows > 0) {
                //pemanggilan record menjadi array asosiatif.
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                //institalize to var
                $adminName = $row['nama_admin'];

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
         //   $conn->close();

        }else{
            /*
            * jika variabel sesi dengan element username kosong maka dilakukan direct link
            * dimana user admin melakukan login kembali untuk mengakses halaman admin.
            */
            echo "
                  <script language='javascript'>
                       window.location.href = '../admin/index.php'
                  </script>";

        }
        /*
         * return pada variabel admin name digunakan untuk mengembalikan nilai dari variabel admin name
         * dimana pada variabel ini nantinya dapat digunakan diluar function ini.
         * salah satu penggunaannya adalah menampilkan nama user admin yang sedang login.
         */
        return $adminName;
    }

    //jalankan fungsi sessionCek
    sessionCek($conn);
    ?>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                 <a class="navbar-brand" href="../admin/dashboard.php">JFRC 37 ADMIN</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>-->
                    <ul class="dropdown-menu dropdown-messages">
                        <!--<li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a href="#">
                                <div>
                                    <strong>John Smith</strong>
                                    <span class="pull-right text-muted">
                                        <em>Yesterday</em>
                                    </span>
                                </div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a class="text-center" href="#">
                                <strong>Read All Messages</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>-->
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>-->
                    <ul class="dropdown-menu dropdown-tasks">
                        <!--<li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Task 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a class="text-center" href="#">
                                <strong>See All Tasks</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>-->
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <!--<a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>-->
                    <ul class="dropdown-menu dropdown-alerts">
                        <!--<li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>-->
                        <li class="divider"></li>
                        <!--<li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>-->
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <?php
                /*
                 * Digunakan untuk menampilkan username admin yang sedang login.
                 * variabel nama_admin digunakan untuk mengabil nilai dari adminName yang ada pada file admn_Sesion.php
                 */


                //memanggil sesi    on cek dan menginstance
                $nama_admin = sessionCek($conn);

                ?>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"> </i> <?php echo $nama_admin ?></a>
                        </li>
                        <!--<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>-->
                        </li>
                        <li class="divider"></li>
                        <li><a href="../admin/Destroy.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Cari...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="../admin/index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="#"><i class="glyphicon glyphicon-briefcase"></i> &nbsp;Barang<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../admin/barang-tambah.php">Tambah Barang</a>
                                    <a href="../admin/barang-daftar-37.php">Daftar Knalpot 37</a>
                                    <a href="../admin/barang-daftar-creampie.php">Daftar Knalpot Creampie</a>
                                    <a href="../admin/barang-daftar-r9.php">Daftar Knalpot R9</a>
                                    <a href="../admin/barang-daftar-ban-sec.php">Daftar Ban Second</a>
                                    <a href="../admin/barang-daftar-uncategories.php">Daftar Uncategories</a>
                                    <a href="../admin/barang-daftar.php">Semua Daftar Barang</a>
                                </li>
                            </ul>
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Blog<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../admin/blog-create.php">Buat Artikel</a>
                                    <a href="../admin/blog-list-articel.php">Daftar Artikel</a>
                                </li>
                                
                            </ul>
                        </li>
                       
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Manage<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="../admin/manage-admin.php">Manage Admin</a>
                                    <a href="../admin/manage-customer.php">Manage Customer</a>
                                    <a href="../admin/manage-banner.php">Manage Banner</a>
                                    <a href="../admin/manage-contact.php">Manajemen Pertanyaan</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <!--content In here-->
