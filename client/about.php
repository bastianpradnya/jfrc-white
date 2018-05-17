<?php
require_once "../config/Apps.php";
$apps = new Apps();
$apps->clientHeader();
?>

<div class="login">
    <div class="wrap">
        <ul class="breadcrumb breadcrumb__t"><a class="home" href="#">Home</a>  / About</ul>
        <div class="section group">


            <div class="labout span_1_of_about">
                <h3>Visi Misi</h3>
                <div class="testimonials ">
                    <div class="testi-item">
                        <blockquote class="testi-item_blockquote">
                            <a href="#">Melayani kebutuhan konsumen mengenai masalah sparepart. </a>
                            <div class="clear"></div>
                        </blockquote>
                    </div>
                </div>

                <div class="testimonials ">
                    <div class="testi-item">
                        <blockquote class="testi-item_blockquote">
                            <a href="#">Menjadikan JFRC sebagai pusat sparepart sepeda motor. </a>
                            <div class="clear"></div>
                        </blockquote>
                    </div>
                </div>
            </div>

            <div class="cont span_2_of_about">
                <h3>SELAMAT DATANG DI JFRC 37 - TUJUAN BERBELANJA SPAREPARTE DI INDONESIA</h3>
                <p>JFRC merupakan bagian dari Jufri Racing yang menjadi tujuan belanja online untuk memenuhi kebutuhan sparepart dan modifikasi sepeda motor.
                    Bergerak di bidang e-commerce, JFRC menghadirkan layanan berbelanja
                    yang mudah bagi konsumen dan akses langsung pada database konsumen.</p>
                <h3>BERBELANJA MUDAH DI JFRC</h3>
                <h3>Tujuan Belanja Utama</h3>
                <p>Dengan beragam pilihan produk yang tersedia dari berbagai kategori sparepart kendaraan maupun modifikasi sepeda motor,
                    JFRC menjadi tujuan untuk memenuhi kebutuhan sepeda motor Anda.</p>
                <p>Selain dari berbagai pilihan produk yang tersedia, Anda juga dapat menemukan berbagai produk yang hadir
                    secara eksklusif melalui JFRC.</p>
                <h3>Berbelanja Mudah dan Nyaman</h3>
                <p>Tanpa harus melalui macet, antrian dan berdesak-desakan! Belanja kapan saja, dimana saja, melalui komputer maupun handphone.</p>
                <p>Dengan layanan pengiriman kami yang cepat dan dapat diandalkan, Anda hanya perlu duduk santai dan paket akan diantarkan kepada Anda.</p>
                <h3>Berbelanja Aman dan Terpercaya</h3>
                <p>Kami memahami pentingnya bagi Anda untuk berbelanja dengan aman pada layanan yang dapat dipercaya. Kami menghadirkan berbagai pilihan metode
                    pembayaran bagi konsumen, termasuk bayar tunai di tempat atau Cash-On-Delivery, Anda hanya perlu membayar saat Anda menerima kiriman paket Anda.</p>
                <p>Kami memastikan kualitas dan keaslian produk: semua produk yang Anda beli di JFRC dijamin asli, bukan barang ilegal dan tidak rusak.
                    Apabila terjadi kasus sebaliknya, Anda dapat mengembalikannya dalam jangka waktu 14 hari dan menerima pengembalian uang sepenuhnya,
                    yang termasuk dalam Program Perlindungan Pelanggan.</p>
                <h5 class="m_6">Segera Belanja Disini</h5>
                <div class="section group">
                    <div class="col_1_of_about-box span_1_of_about-box">
                        <a class="popup-with-zoom-anim" href="#small-dialog3">  <span class="rollover"></span><img src="../images/pi6.jpg" title="continue" alt=""/></a>
                    </div>
                    <div class="col_1_of_about-box span_1_of_about-box">
                        <a class="popup-with-zoom-anim" href="#small-dialog3">  <span class="rollover"></span><img src="../images/pi4.jpg" title="continue" alt=""/></a>
                    </div>
                    <div class="col_1_of_about-box span_1_of_about-box">
                        <a class="popup-with-zoom-anim" href="#small-dialog3">  <span class="rollover"></span><img src="../images/pi3.jpg" title="continue" alt=""/></a>
                    </div>
                    <div class="clear"></div>

    </div>
    <!-- Add fancyBox main JS and CSS files -->
<script src="../js/jquery.magnific-popup.js" type="text/javascript"></script>
<link href="../css/magnific-popup.css" rel="stylesheet" type="text/css">
<script>
    $(document).ready(function() {
        $('.popup-with-zoom-anim').magnificPopup({
            type: 'inline',
            fixedContentPos: false,
            fixedBgPos: true,
            overflowY: 'auto',
            closeBtnInside: true,
            preloader: false,
            midClick: true,
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
    });
});

</script>
    </div>


            <div class="clear"></div>
        </div>
    </div>
</div>  

<?php
  $apps->clientFooter();
?>