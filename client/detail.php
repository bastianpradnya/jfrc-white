<?php
require_once "../config/Apps.php";
$apps = new Apps();
$apps->clientHeader();
?>

<?php
function getDataBarang($id, $conn){
	$row = null;
	$result = null;

	//$sql = "SELECT id, nama_admin, username  FROM admin WHERE id=$id";
	$sql = "SELECT id, nama_barang, harga, deskripsi, stok, photo_1, kategori_barang, dilihat FROM barang WHERE id=$id";

	if($id > 0){
		//query table admin
		$result = $conn->query($sql) or trigger_error($result);
	}

	if ($result == true) {
		//data menjadi array assosiatif
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	}
	return $row;
}

function updateLihatBarang($id, $getLihat, $conn){

	if($getLihat ==  null){
		$getLihat = 1;
	}else{
		$getLihat += 1;
	}

	$sql = "UPDATE barang SET dilihat =$getLihat  WHERE id=$id";

	if ($conn->query($sql) === TRUE) {
		//dilihat is update
	} else {
		echo "Error updating record: " . $conn->error;
	}
}

?>


<!-- start details js in here -->
<script src="../js/slides.min.jquery.js"></script>
   <script>
		$(function(){
			$('#products').slides({
				preload: true,
				preloadImage: 'img/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
				generateNextPrev: true,
				generatePagination: false
			});
		});
	</script>
<link rel="stylesheet" href="../css/etalage.css">
<script src="../js/jquery.etalage.min.js"></script>
<script>
	jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 360,
					thumb_image_height: 360,
					source_image_width: 900,
					source_image_height: 900,
					show_hint: true,
					click_callback: function(image_anchor, instance_id){
						alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
					}
				});

			});
</script>
<!-- ENd start details js is here -->

<div class="mens">    
	<div class="main">
		<div class="wrap">
			<?php
			include "../config/Dbconnect.php";

			//deklarate var
			$id = null;

			if ($_SERVER["REQUEST_METHOD"] == "GET") {
				$id = $_GET['id'];
			}

			//calling fuction and instance
			$data = getDataBarang($id, $conn);

			//$sql = "SELECT id, nama_barang, harga, deskripsi, stok, photo_1 FROM barang WHERE id=$id";

			//transform data from  database array asositatif to variabel
			$namabarang = $data ['nama_barang'];
			$harga =  $data ['harga'];
			$deskripsi = $data ['deskripsi'];
			$stok = $data ['stok'];
			$kategori = $data['kategori_barang'];
			$gambar = $data ['photo_1'];
			$getLihat = $data ['dilihat'];


			//calling function update lihat barang
			updateLihatBarang($id, $getLihat, $conn);

			?>
			 <!---Content Star Here-->
			<ul class="breadcrumb breadcrumb__t"><a class="home" href="index.php">Home</a> / <a href="#"><!--Root Kategori--><?php echo $kategori ?></a> / <!--Root NamaBarang--><?php echo $namabarang ?></ul>
			<div class="cont span_2_of_3">
				
				<!--digunakan untuk menampilkan gambar-->
				<div class="grid images_3_of_2">
					<?php
						$pathbig = "../storage/img/";
						$paththumb = "../storage/thumbs/";
					?>
					<ul id="etalage">

						<li>
							<a href="#"><!--
								<img class="etalage_thumb_image" src="<?php /*echo $pathtbig.$gambar*/?>" class="img-responsive" />
								<img class="etalage_source_image" src="<?php /*echo $paththumb.$gambar*/?>" class="img-responsive" title="" />
-->

								<img class="etalage_thumb_image" src="<?php echo $paththumb.$gambar?>" class="img-responsive" />
								<img class="etalage_source_image" src="<?php echo $pathbig.$gambar?>" class="img-responsive" title="" />
							</a>
						</li>

						<!--Jika gambar yang di tampilkan banyak maka dapat mengaktifkan list dibawah ini-->
					<!--	<li>
							<img class="etalage_thumb_image" src="../images/pic.jpg" class="img-responsive" />
							<img class="etalage_source_image" src="../images/pic1.jpg" class="img-responsive" title="" />
						</li>
						<li>
							<img class="etalage_thumb_image" src="../images/pic.jpg" class="img-responsive"  />
							<img class="etalage_source_image" src="../images/pic1.jpg" class="img-responsive"  />
						</li>
						<li>
							<img class="etalage_thumb_image" src="../images/pic.jpg" class="img-responsive"  />
							<img class="etalage_source_image" src="../images/pic1.jpg" class="img-responsive"  />
						</li>-->
					</ul>
					<div class="clearfix"></div>
				</div>

				<!--Deskripsi Kontent-->
				<div class="desc1 span_3_of_2">
					<h3 class="m_3"><?php echo $namabarang ?></h3> <!--Title Nama Barang -->
					<p class="m_5">Rp. <?php echo $harga ?> <!--<span class="reducedfrom">Rp. 999</span>--></p>
					<div class="btn_form">
						<form action="keranjang_aksi.php" method="post">
							<input type="hidden" name="id" value="<?php echo $id ?>">
							<input type="submit" value="Beli" >
						</form>
					</div>
					<span class="m_link"><a href="#">login untuk menyimpan ke keranjang belanja</a> </span>
					
					<p class="m_text2">
						<?php echo substr($deskripsi, 3) ?></p>
					</p>
				</div>

				<div class="clear"></div>

				<div class="clients">
					<h3 class="m_3">10 Barang dengan kategori yang sama</h3>
					<ul id="flexiselDemo3"><?php
						$path = "../storage/thumbs/";

						$sql = "SELECT id, nama_barang, harga,  status, photo_1 FROM barang WHERE kategori_barang ='$kategori' ";
						$result = $conn->query($sql);
						if (!$result === TRUE) {
							echo "Error: " . $sql . "<br>" . $conn->error;
						}

						if ($result->num_rows > 0) {//if condition if table is already field
						// output data of each row
							while ($row = $result->fetch_assoc()) {
							//statement for read database  from table
								if ($row ['status'] == "Aktif") { ?>

									<li>
										<img src="<?php echo $path.$row['photo_1'] ?>"/>
										<a href="detail.php?id=<?php echo $row['id']?>"><?php echo $pot = substr($row['nama_barang'], 0, 13);
											if(strlen($pot) > 12){echo "...";}
											?></a>
										<p>Rp.<?php echo $row['harga'] ?></p>
									</li>

									<?php
								}//end if
							}//end while
						}//end if
						?>
					</ul>



					<script type="text/javascript">
						$(window).load(function() {
							$("#flexiselDemo1").flexisel();
							$("#flexiselDemo2").flexisel({
								enableResponsiveBreakpoints: true,
								responsiveBreakpoints: {
									portrait: {
										changePoint:480,
										visibleItems: 1
									},
									landscape: {
										changePoint:640,
										visibleItems: 2
									},
									tablet: {
										changePoint:768,
										visibleItems: 3
									}
								}
							});

							$("#flexiselDemo3").flexisel({
								visibleItems: 5,
								animationSpeed: 1000,
								autoPlay: false,
								autoPlaySpeed: 3000,
								pauseOnHover: true,
								enableResponsiveBreakpoints: true,
								responsiveBreakpoints: {
									portrait: {
										changePoint:480,
										visibleItems: 1
									},
									landscape: {
										changePoint:640,
										visibleItems: 2
									},
									tablet: {
										changePoint:768,
										visibleItems: 3
									}
								}
							});

						});
					</script>
					<script type="text/javascript" src="../js/jquery.flexisel.js"></script>
				</div>

				<!-- Content ini dimatikan belum ada detail barang yg menyeluruh untuk diisi.-->
				<!--<div class="toogle">
					<h3 class="m_3">Product Details</h3>
					<p class="m_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>
				</div>

				<div class="toogle">
					<h3 class="m_3">More Information</h3>
					<p class="m_text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum.</p>
				</div>-->


			</div><!--end Div Wraping-->

			<div class="rsingle span_1_of_single">
				<h5 class="m_1">Categories</h5>
				<!--<select class="dropdown" tabindex="8" data-settings='{"wrapperClass":"metro"}'>
					<option value="1"></option>
					<option value="2">Creampie</option>
					<option value="3">R9</option>
				</select>-->
				<ul class="kids">
					<li><a href="jfrc37.php">JFRC 37</a></li>
					<li><a href="creampie.php">Creampie</a></li>
					<li><a href="r9.php">R9</a></li>
					<li><a href="uncategories.php">Uncategories</a></li>
					<li><a href="ban_second.php">Ban Second</a></li>
				</ul>

				<!--<section  class="sky-form">
					<h4>Harga</h4>
					<div class="row row1 scroll-pane">
						<div class="col col-4">
							<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Rp. 500 - Rp. 700</label>
						</div>
						<div class="col col-4">
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 700 - Rp. 1000</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 1000 - Rp. 1500</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 1500 - Rp. 2000</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 2000 - Rp. 2500</label>
							<label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>Rp. 2500 - Rp. 3000</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 3500 - Rp. 4000</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 4000 - Rp. 4500</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 4500 - Rp. 5000</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 5000 - Rp. 5500</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 5500 - Rp. 6000</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 6000 - Rp. 6500</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 6500 - Rp. 7000</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 7000 - Rp. 7500</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 7500 - Rp. 8000</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Rp. 8000 - Rp. 8500</label>
						</div>
					</div>
				</section>-->

				<script src="js/jquery.easydropdown.js"></script>

				<!--<section  class="sky-form">
					<h4>Product Lainnya</h4>
					<div class="row row1 scroll-pane">
						<div class="col col-5">
							<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>John Jacobs</label>
						</div>
						<div class="col col-4">
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Tag Heuer</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Lee Cooper</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Mikli</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>S Oliver</label>
							<label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>Hackett</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Killer</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>IDEE</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Vogue</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Gunnar</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Accu Reader</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>CAT</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Excellent</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Feelgood</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Odysey</label>
							<label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Animal</label>
						</div>
					</div>
				</section>
			</div>-->

			<div class="clear"></div>
		</div>

		<div class="clear"></div>

	</div>
</div>

<?php
$apps->clientFooter();
?>