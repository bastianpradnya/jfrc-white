<?php

    $c = 0;

    for($a=0; $a<100; $a++ ){
        $c ++;

        if($c <= 3){
            echo $a." &nbsp; ";
        }else{
            $c = 0;
            echo "<br>";
        }
    }
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
                        <p class="description"></p>
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


    ?><div class="col_1_of_3 span_1_of_3">
    <a href="../client/detail.php?id= <?php $id = $row['id'] ?>">
        <div class="inner_content clearfix">
            <div class="product_image">
                <img src="<?php echo $path . $row['photo_1'] ?>" alt=""/>
            </div>
            <!--<div class="sale-box"><span class="on_sale title_shop">New</span></div>-->
            <div class="price">
                <div class="cart-left">
                    <p class="title"><?php echo $row['nama_barang'] ?></p>
                    <div class="price1">
                        <span class="actual">Rp.<?php echo $row['harga'] ?></span>
                    </div>
                </div>
                <a href="#"> <div class="cart-right"></div> </a>
                <div class="clear"></div>
            </div>
        </div>
    </a>
    </div><?php

