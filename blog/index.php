<?php
include "../config/Apps.php";
$apps = new Apps();
$apps->blogHeader();
?>

	<div class="content">
		<div class="container">
			<div class="content-grids">
				<div class="col-md-8 content-main">
					<div class="content-grid">
						<?php
						include "../config/Dbconnect.php";

						$batas   = 7;
						$halaman = @$_GET['halaman'];
						if(empty($halaman)){
							$posisi  = 0;
							$halaman = 1;
						}
						else{
							$posisi  = ($halaman-1) * $batas;
						}
						$no = $posisi+1;

						$sql = "SELECT id, judul_artikel, kontent_artikel, kategori, status, tanggal_publish FROM blog_articel LIMIT $posisi, $batas";
						$result = $conn->query($sql);
						$a = 1;

						if ($result->num_rows > 0) { //if condition if table admin is already field
							// output data of each row
							while($row = $result->fetch_assoc()) {
								//statement for read database  from table admin in here
								?>

								<div class="content-grid-info">
									<img src="../blog-assets/images/post1.jpg" alt=""/>
									<div class="post-info">
										<h4><a href="../blog/single.php?id=<?php echo $id = $row['id'] ?>">
												<?php echo $row['judul_artikel'] ?></a>  <?php echo $row['tanggal_publish'] ?> / 27 Comments</h4>
										<p><?php
											$artikel = $row['kontent_artikel'];

											// strip tags to avoid breaking any html
											$string = strip_tags($artikel);

											if (strlen($string) > 500) {

												// truncate string
												$stringCut = substr($string, 0, 500);

												// make sure it ends in a word so assassinate doesn't become ass...
												$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'... <a href="/this/story">Read More</a>';
											}
											echo $string;

											?></p>
										<a href="../blog/single.php?id=<?php echo $id = $row['id'] ?>"><span></span>Selanjutnya</a>
									</div>
								</div>

								<?php
							}//end statement for read content from database table Admin.

							//condition if database table admin is empty.
						}else {?>
							<tr>
								<td colspan="7">
									<h3>Hasil Tidak di Temukan (0)</h3>
								</td>
							</tr>
							<?php
						}
						?>
						<tr>
							<td colspan="7">
								<hr>
								<?php
								$query2     = mysqli_query($conn, "SELECT id, judul_artikel, kontent_artikel, kategori, status, tanggal_publish FROM blog_articel");
								$jmldata    = mysqli_num_rows($query2);
								$jmlhalaman = ceil($jmldata/$batas);
								?>
								<ul class="pagination">
									<?php
									for($i=1;$i<=$jmlhalaman;$i++)
										if ($i != $halaman){
											echo "  <li><a href='index.php?halaman=$i'>$i</a></li> ";
										}
										else{
											echo "   <li class='active'><a href='#'>$i</a></li> ";
										}
									?>
								</ul>
							</td>
						</tr>

					</div>
				</div>


				<div class="col-md-4 content-right">
					<div class="recent">
						<h3>RECENT POSTS</h3>
						<ul>
							<li><a href="#">Knalpot 37</a></li>
						</ul>
					</div>
		
					<div class="categories">
						<h3>CATEGORIES</h3>
						<ul>
							<li><a href="#">Ban</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!---->
	<!--end content in here-->

<?php
$apps->blogFooter();
?>