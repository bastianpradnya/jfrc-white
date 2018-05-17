<?php
require_once "../config/Apps.php";
$apps = new Apps();
$apps->clientHeader();
?>

    <!-- start slider banner -->
    <div id="fwslider">
        <div class="slider_container">
            <div class="slide">
                <!-- Slide image -->
                <img src="../images/banner.jpg" alt="" />
                <!-- /Slide image -->
                <!-- Texts container -->
                <div class="slide_content">
                    <div class="slide_content_wrap">
                        <!-- Text title -->
                        <h4 class="title">JFRC 37</h4>
                        <!-- /Text title -->

                        <!-- Text description -->
                        <p class="description">Experiance ray ban</p>
                        <!-- /Text description -->
                    </div>
                </div>
                <!-- /Texts container -->
            </div>
            <!-- /Duplicate to create more slides -->
            <div class="slide">
                <img src="../images/banner1.jpg" alt=""/>
                <div class="slide_content">
                    <div class="slide_content_wrap">
                        <h4 class="title">JFRC 37 </h4>
                        <p class="description">diam nonummy nibh euismod</p>
                    </div>
                </div>
            </div>
            <!--/slide -->
        </div>
        <div class="timers"></div>
        <div class="slidePrev"><span></span></div>
        <div class="slideNext"><span></span></div>
    </div>
    <!--/slider banner -->





    <div class="login">
        <div class="wrap">
            <div class="section group">
                <!--Tag Div untuk Barang Baru-->
                <div class="cont span_2_of_3">

                    <h2 class="head">BARU</h2>
                    <?php
                    include "../config/Dbconnect.php";
                    $path = "../storage/thumbs/";

                    $sql = "SELECT id, nama_barang, harga,  status, photo_1 FROM barang WHERE status ='Aktif' ORDER BY id DESC LIMIT 15";
                    $result = $conn->query($sql);
                    if (!$result === TRUE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }

                    if ($result->num_rows > 0) {//if condition if table is already field
                        // output data of each row
                        $loop = null;
                        while($row = $result->fetch_assoc()) {
                            //statement for read database  from table
                            $loop++; //var looping tambah 1
                            if ($loop == 1) {
                                ?>
                            <div class="top-box1">
                                <div class="col_1_of_3 span_1_of_3">
                                    <a href="detail.php?id=<?php echo $row['id']?>">
                                        <div class="inner_content clearfix">
                                            <div class="product_image">
                                                <img src="<?php echo $path.$row['photo_1']?>" alt=""/>
                                            </div>
                                            <!--<div class="sale-box"><span class="on_sale title_shop">New</span></div>-->
                                            <div class="price">
                                                <div class="cart-left">
                                                    <p class="title"><?php echo $row['nama_barang'] ?></p>
                                                    <div class="price1">
                                                        <span class="actual">Rp.<?php echo $row['harga']?></span>
                                                    </div>
                                                </div>
                                                <div class="cart-right"></div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>


                                <?php
                            }elseif ($loop == 2) {
                                ?>
                                <div class="col_1_of_3 span_1_of_3">
                                    <a href="detail.php?id=<?php echo $row['id']?>">
                                        <div class="inner_content clearfix">
                                            <div class="product_image">
                                                <img src="<?php echo $path.$row['photo_1']?>" alt=""/>
                                            </div>
                                            <!--<div class="sale-box"><span class="on_sale title_shop">New</span></div>-->
                                            <div class="price">
                                                <div class="cart-left">
                                                    <p class="title"><?php echo $row['nama_barang'] ?></p>
                                                    <div class="price1">
                                                        <span class="actual">Rp.<?php echo $row['harga']?></span>
                                                    </div>
                                                </div>
                                                <div class="cart-right"></div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <?php
                            }elseif ($loop == 3) {
                                $r = 0;
                                $loop = 0;
                                ?>

                                <div class="col_1_of_3 span_1_of_3">
                                    <a href="detail.php?id=<?php echo $row['id']?>">
                                        <div class="inner_content clearfix">
                                            <div class="product_image">
                                                <img src="<?php echo $path.$row['photo_1']?>" alt=""/>
                                            </div>
                                            <!--<div class="sale-box"><span class="on_sale title_shop">New</span></div>-->
                                            <div class="price">
                                                <div class="cart-left">
                                                    <p class="title"><?php echo $row['nama_barang'] ?></p>
                                                    <div class="price1">
                                                        <span class="actual">Rp.<?php echo $row['harga']?></span>
                                                    </div>
                                                </div>
                                                <div class="cart-right"></div>
                                                <div class="clear"></div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="clear"></div>

                            </div><!--end op-box1-->

                                <?php
                            }//endif
                        }//end while statement

                        if($loop == 1 || $loop == 2){
                            ?>
                            <div class="clear"></div>
                        </div><!--end op-box1 TUTUP AKHIR kalo kotent tidak memenuhi 3 box -->
                        <?php
                        }
                    }else {//condition if database table admin is empty.
                        ?><h3>Hasil Tidak di Temukan (0)</h3><?php
                    }?>


                <h2 class="head">BANYAK DILIHAT</h2>
                <?php
                include "../config/Dbconnect.php";
                $path = "../storage/thumbs/";

                $sql = "SELECT id, nama_barang, harga,  status, photo_1 FROM barang WHERE status ='Aktif' AND dilihat > 9 LIMIT 15";
                $result = $conn->query($sql);
                if (!$result === TRUE) {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                if ($result->num_rows > 0) {//if condition if table is already field
                // output data of each row
                $loop = null;
                while($row = $result->fetch_assoc()) {
                    //statement for read database  from table
                    $loop++; //var looping tambah 1
                    if ($loop == 1) {
                        ?>
                        <div class="top-box">
                        <div class="col_1_of_3 span_1_of_3">
                            <a href="detail.php?id=<?php echo $row['id']?>">
                                <div class="inner_content clearfix">
                                    <div class="product_image">
                                        <img src="<?php echo $path.$row['photo_1']?>" alt=""/>
                                    </div>
                                    <!--<div class="sale-box"><span class="on_sale title_shop">New</span></div>-->
                                    <div class="price">
                                        <div class="cart-left">
                                            <p class="title"><?php echo $row['nama_barang'] ?></p>
                                            <div class="price1">
                                                <span class="actual">Rp.<?php echo $row['harga']?></span>
                                            </div>
                                        </div>
                                        <div class="cart-right"></div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </a>
                        </div>


                        <?php
                    }elseif ($loop == 2) {
                        ?>
                        <div class="col_1_of_3 span_1_of_3">
                            <a href="detail.php?id=<?php echo $row['id']?>">
                                <div class="inner_content clearfix">
                                    <div class="product_image">
                                        <img src="<?php echo $path.$row['photo_1']?>" alt=""/>
                                    </div>
                                    <!--<div class="sale-box"><span class="on_sale title_shop">New</span></div>-->
                                    <div class="price">
                                        <div class="cart-left">
                                            <p class="title"><?php echo $row['nama_barang'] ?></p>
                                            <div class="price1">
                                                <span class="actual">Rp.<?php echo $row['harga']?></span>
                                            </div>
                                        </div>
                                        <div class="cart-right"></div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php
                    }elseif ($loop == 3) {
                        $r = 0;
                        $loop = 0;
                        ?>

                        <div class="col_1_of_3 span_1_of_3">
                            <a href="detail.php?id=<?php echo $row['id']?>">
                                <div class="inner_content clearfix">
                                    <div class="product_image">
                                        <img src="<?php echo $path.$row['photo_1']?>" alt=""/>
                                    </div>
                                    <!--<div class="sale-box"><span class="on_sale title_shop">New</span></div>-->
                                    <div class="price">
                                        <div class="cart-left">
                                            <p class="title"><?php echo $row['nama_barang'] ?></p>
                                            <div class="price1">
                                                <span class="actual">Rp.<?php echo $row['harga']?></span>
                                            </div>
                                        </div>
                                        <div class="cart-right"></div>
                                        <div class="clear"></div>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="clear"></div>

                        </div><!--end op-box1-->

                        <?php
                    }//endif
                }//end while statement

                if($loop == 1 || $loop == 2){
                ?>
                <div class="clear"></div>
            </div><!--end op-box1 TUTUP AKHIR kalo kotent tidak memenuhi 3 box -->
            <?php
            }
            }else {//condition if database table admin is empty.
                ?><h3>Hasil Tidak di Temukan (0)</h3><?php
            }?>




        </div><!--END cont span_2_of_3-->


                <!--SIDE BAR RIGHT PANEL-->
                <div class="rsidebar span_1_of_left">

                    <div class="top-border"> </div>
                    <div class="border">
                        <link href="../css/default.css" rel="stylesheet" type="text/css" media="all" />
                        <link href="../css/nivo-slider.css" rel="stylesheet" type="text/css" media="all" />
                        <script src="../js/jquery.nivo.slider.js"></script>
                        <script type="text/javascript">
                            $(window).load(function() {
                                $('#slider').nivoSlider();
                            });
                        </script>

                        <div class="slider-wrapper theme-default">
                            <p class="title">Temukan Lokasi Kami</p>
                            <div id="#" class="nivoSlider">
                                <iframe src="https://www.google.com/maps/d/embed?mid=z_NEXUQwS8C8.kyOcZ-JqptTs" width="240" height="300"></iframe>
                            </div>
                        </div>

                    </div>

                    <div class="top-border"> </div>

                    <div class="sidebar-bottom">
                        <p class="title">Informasi</p>
                        <p class="m_text" align="justify">
                            Untuk Wilayah Jogja bisa COD di: Jln. Kusumanegara, Kampus 2 UTY Jln.Glagahsari, Jln.Gajah Tahunan Umbulharjo (Kota Jogja).
                        </p>
                    </div>
                </div>
                <!--SIDE BAR RIGHT PANEL-->

            </div><!--- end tag section group-->
        </div><!--- end tag wrap-->
    </div><!--End tag div wrap and Login-->

    <div class="clear"></div>


<?php
$apps->clientFooter();
?>