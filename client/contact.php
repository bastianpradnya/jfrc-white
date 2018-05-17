<?php
include '../config/Apps.php';
$apps = new Apps();
$apps->clientHeader();
?>



<div class="login">
    <div class="wrap">
        <ul class="breadcrumb breadcrumb__t"><a class="home" href="#">Home</a>  / Contact</ul>
        <?php
        $masuk_nama = $masuk_email = $masuk_subject = $masuk_pesan = null;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            $masuk_nama     = $_POST['masuk_nama'];
            $masuk_email    = $_POST['masuk_email'];
            $masuk_subject  = $_POST['masuk_subject'];
            $masuk_pesan  = $_POST['masuk_pesan'];


            $dataValid="YA";
            ?><center><?php
            if($masuk_nama == 'Masukkan Nama'){
                echo "Nama Harus Diisi! <br>";
                $dataValid="TIDAK";
            }
            if($masuk_email == 'Email'){
                echo "Email Harus Diisi! <br>";
                $dataValid="TIDAK";
            }
            if($masuk_subject == 'Subject'){
                echo "Subject Harus Diisi! <br>";
                $dataValid="TIDAK";
            }

            if($masuk_pesan == 'Message:' || $masuk_pesan == 'Message:' ){
                $pesan[4] = "Pesan Tidak Boleh Kosong ";
                $dataValid="TIDAK";
            }
            if($dataValid == "TIDAK"){
                echo "Masih Ada Kesalahan, silahkan perbaiki! <br>";
                exit;
            }

            include "../config/Dbconnect.php";

            $sql = "insert into kontak_kami
			(nama_kontak,email_kontak,subjek_kontak,isi_pesan)
			values
			('$masuk_nama','$masuk_email','$masuk_subject','$masuk_pesan')" ;
            $hasil = mysqli_query($conn, $sql);

            if(!$hasil)
            {
                echo "Gagal Simpan, silahkan diulangi <br>" ;
                exit;
            }
            else {
                echo "Simpan data berhasil" ;
            }
        }
        ?></center>
        <div class="content-top">
            <form method="post" action="#">

                <div class="to">
                    <input type="text" class="text"  name="masuk_nama" value="Masukkan Nama" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Masukan Nama';}">
                    <input type="text" class="text" name="masuk_email"  value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" style="margin-left: 10px">
                </div>

                <div class="subject">
                    <input type="text" name="masuk_subject" class="text" value="Subject" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}">
                </div>

                <div class="text">
                    <textarea value="Message:" name="masuk_pesan"  onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message:</textarea>
                </div>

                <div class="submit">
                    <input type="submit" value="Submit">
                </div>

            </form>

             <div class="map">
                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1rxLXsuWD7u0ZxAZULDYg5hL-ewo" width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" >
                </iframe>
                <br>
             </div>

        </div>
    </div>
</div>

<?php
$apps->clientFooter();
?>