<?php
require_once "../config/Apps.php";
$apps = new Apps();
$apps->clientHeader();

?>


<div class="login">
    <div class="wrap">
        <div class="cont span_2_of_3">

            <h2 class="head">R9</h2>
            <div class="mens-toolbar">
                <div class="sort">
                    <div class="sort-by">
                        <label>Sort By</label>
                        <select>
                            <option value="">
                                Position                </option>
                            <option value="">
                                Name                </option>
                            <option value="">
                                Price                </option>
                        </select>
                        <a href=""><img src="../images/arrow2.gif" alt="" class="v-middle"></a>
                    </div>
                </div>

                <div class="pager">
                    <div class="limiter visible-desktop">
                        <label>Show</label>
                        <select>
                            <option value="" selected="selected">
                                9                </option>
                            <option value="">
                                15                </option>
                            <option value="">
                                30                </option>
                        </select> per page
                    </div>
                    <ul class="dc_pagination dc_paginationA dc_paginationA06">
                        <li><a href="#" class="previous">Pages</a></li>
                        <li><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>


            <?php
            include "../config/Dbconnect.php";
            $path = "../storage/thumbs/";

            $sql = "SELECT id, nama_barang, harga,  status, photo_1 FROM barang WHERE status ='Aktif' AND kategori_barang ='Knalpot R9' ";
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
                        ?><div class="top-box1">
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
                        </div><?php

                    }elseif ($loop == 2) {
                        ?><div class="col_1_of_3 span_1_of_3">
                        <a href="detail.php?id=<?php echo $row['id']?>">
                            <div class="inner_content clearfix">
                                <div class="product_image">
                                    <img src="<?php echo $path.$row['photo_1']?>" alt=""/>
                                </div>
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
                        </div><?php

                    }elseif ($loop == 3) {

                        ?><div class="col_1_of_3 span_1_of_3">
                        <a href="detail.php?id=<?php echo $row['id']?>">
                            <div class="inner_content clearfix">
                                <div class="product_image">
                                    <img src="<?php echo $path.$row['photo_1']?>" alt=""/>
                                </div>
                                <!-- <div class="sale-box1"><span class="on_sale title_shop">Hot</span></div>-->
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
                        </div><?php
                        $r = 0;

                        ?></div><?php
                        ?><div class="clear"></div><?php

                        $loop = 0;
                    }
                }//end while statement

            }else {//condition if database table admin is empty.
                ?><h3>Hasil Tidak di Temukan (0)</h3><?php
            }
            ?></div><!--End Tag Div untuk Barang Baru-->


    </div>
    <!--END tag Div untuk Barang Baru-->

    <!--

        <div class="top-box">

                    <div class="col_1_of_3 span_1_of_3">
                        <a href="single.html">
                            <div class="inner_content clearfix">
                                <div class="product_image">
                                    <img src="images/pic.jpg" alt=""/>
                                </div>
                                <div class="sale-box"><span class="on_sale title_shop">New</span></div>
                                <div class="price">
                                    <div class="cart-left">
                                        <p class="title">Lorem Ipsum simply</p>
                                        <div class="price1">
                                            <span class="actual">$12.00</span>
                                        </div>
                                    </div>
                                    <div class="cart-right"> </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col_1_of_3 span_1_of_3">
                        <a href="single.html">
                            <div class="inner_content clearfix">
                                <div class="product_image">
                                    <img src="images/pic1.jpg" alt=""/>
                                </div>
                                <div class="price">
                                    <div class="cart-left">
                                        <p class="title">Lorem Ipsum simply</p>
                                        <div class="price1">
                                            <span class="actual">$12.00</span>
                                        </div>
                                    </div>
                                    <div class="cart-right"> </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col_1_of_3 span_1_of_3">
                        <a href="single.html">
                            <div class="inner_content clearfix">
                                <div class="product_image">
                                    <img src="images/pic2.jpg" alt=""/>
                                </div>
                                <div class="sale-box1"><span class="on_sale title_shop">Sale</span></div>
                                <div class="price">
                                    <div class="cart-left">
                                        <p class="title">Lorem Ipsum simply</p>
                                        <div class="price1">
                                            <span class="reducedfrom">$66.00</span>
                                            <span class="actual">$12.00</span>
                                        </div>
                                    </div>
                                    <div class="cart-right"> </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="clear"></div>
                </div>-->

    <!--<h2 class="head">Staff Pick</h2>
    <div class="top-box1">
        <div class="col_1_of_3 span_1_of_3">
            <a href="single.html">
                <div class="inner_content clearfix">
                    <div class="product_image">
                        <img src="images/pic8.jpg" alt=""/>
                    </div>
                    <div class="sale-box"><span class="on_sale title_shop">New</span></div>
                    <div class="price">
                        <div class="cart-left">
                            <p class="title">Lorem Ipsum simply</p>
                            <div class="price1">
                                <span class="actual">$12.00</span>
                            </div>
                        </div>
                        <div class="cart-right"> </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col_1_of_3 span_1_of_3">
            <a href="single.html">
                <div class="inner_content clearfix">
                    <div class="product_image">
                        <img src="images/pic4.jpg" alt=""/>
                    </div>
                    <div class="price">
                        <div class="cart-left">
                            <p class="title">Lorem Ipsum simply</p>
                            <div class="price1">
                                <span class="actual">$12.00</span>
                            </div>
                        </div>
                        <div class="cart-right"> </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col_1_of_3 span_1_of_3">
            <a href="single.html">
                <div class="inner_content clearfix">
                    <div class="product_image">
                        <img src="images/pic2.jpg" alt=""/>
                    </div>
                    <div class="sale-box"><span class="on_sale title_shop">New</span></div>
                    <div class="price">
                        <div class="cart-left">
                            <p class="title">Lorem Ipsum simply</p>
                            <div class="price1">
                                <span class="actual">$12.00</span>
                            </div>
                        </div>
                        <div class="cart-right"> </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="clear"></div>
    </div>-->

    <!--
    <h2 class="head">New Products</h2>
    <div class="section group">
        <div class="col_1_of_3 span_1_of_3">
            <a href="single.html">
                <div class="inner_content clearfix">
                    <div class="product_image">
                        <img src="images/pic5.jpg" alt=""/>
                    </div>
                    <div class="sale-box"><span class="on_sale title_shop">New</span></div>
                    <div class="price">
                        <div class="cart-left">
                            <p class="title">Lorem Ipsum simply</p>
                            <div class="price1">
                                <span class="actual">$12.00</span>
                            </div>
                        </div>
                        <div class="cart-right"> </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col_1_of_3 span_1_of_3">
            <a href="single.html">
                <div class="inner_content clearfix">
                    <div class="product_image">
                        <img src="images/pic2.jpg" alt=""/>
                    </div>
                    <div class="sale-box"><span class="on_sale title_shop">New</span></div>
                    <div class="price">
                        <div class="cart-left">
                            <p class="title">Lorem Ipsum simply</p>
                            <div class="price1">
                                <span class="actual">$12.00</span>
                            </div>
                        </div>
                        <div class="cart-right"> </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col_1_of_3 span_1_of_3">
            <a href="single.html">
                <div class="inner_content clearfix">
                    <div class="product_image">
                        <img src="images/pic3.jpg" alt=""/>
                    </div>
                    <div class="sale-box"><span class="on_sale title_shop">New</span></div>
                    <div class="price">
                        <div class="cart-left">
                            <p class="title">Lorem Ipsum simply</p>
                            <div class="price1">
                                <span class="actual">$12.00</span>
                            </div>
                        </div>
                        <div class="cart-right"> </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </a>
        </div>
        <div class="clear"></div>
    </div>-->

</div>


<div class="rsidebar span_1_of_left">
    <h5 class="m_1">Categories</h5>

    <ul class="kids">
        <li><a href="jfrc37.php">JFRC 37</a></li>
        <li><a href="creampie.php">Creampie</a></li>
        <li><a href="r9.php">R9</a></li>
        <li><a href="uncategories.php">Uncategories</a></li>
        <li><a href="ban_second.php">Ban Second</a></li>
    </ul>

<!--    <section  class="sky-form">
        <h4>Price</h4>
        <div class="row row1 scroll-pane">
            <div class="col col-4">
                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Rs 500 - Rs 700</label>
            </div>

            <div class="col col-4">
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 700 - Rs 1000</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 1000 - Rs 1500</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 1500 - Rs 2000</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 2000 - Rs 2500</label>
                <label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>Rs 2500 - Rs 3000</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 3500 - Rs 4000</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 4000 - Rs 4500</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 4500 - Rs 5000</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 5000 - Rs 5500</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 5500 - Rs 6000</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 6000 - Rs 6500</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 6500 - Rs 7000</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 7000 - Rs 7500</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 7500 - Rs 8000</label>
                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rs 8000 - Rs 8500</label>
            </div>
        </div>
    </section>-->

</div>
<div class="clear"></div>
</div>
</div>
</div>
<script src="js/jquery.easydropdown.js"></script>

<br>
<br>
<br>
<br>
<?php
$apps->clientFooter();
?>
