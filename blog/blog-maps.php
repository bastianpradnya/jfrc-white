<?php
include "../config/Apps.php";
$apps = new Apps();
$apps->blogHeader();
?>

<!-- Bootstrap Core CSS -->
<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">


<div class="single">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">

            <div class="col-lg-12">
                <h3 class="page-header">JFRC37 Blog Maps</h3>
            </div>

            <div class="col-md-offset-1">
                <ul >
                    <li><a href="index.php"> Beranda </a></li>
                    <li><a href="about.php"> About Me</a></li>
                    <li><a href="../client/">Shopping / Belanja</a> </li>
                    <li>

                    </li>
                </ul>
            </div>

        </div>
    </div>

    <br><br><br><br><br><br>
    <br><br><br><br><br><br>
</div>


<?php
$apps->blogFooter();
?>
