<?php
include "../config/Apps.php";
$apps = new Apps();
$apps->blogHeader();
?>

<div class="single">
	 <div class="container">
		  <div class="col-md-8 single-main">

			  <?php
			  include "../config/Dbconnect.php";
			  $id = $_GET['id'];

			  $sql = "SELECT judul_artikel, kontent_artikel, kategori, status, tanggal_publish FROM blog_articel WHERE id = $id";
			  $result = $conn->query($sql);
			  $a = 1;

			  if ($result->num_rows > 0) { //if condition if table admin is already field
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
					  //statement for read database  from table admin in here
					  ?>

					  <div class="single-grid">
						  <h2>
							  <!-- Title -->
							  <?php echo $row['judul_artikel'] ?>
						  </h2><br>

						  <img src="../blog-assets/images/post1.jpg" alt=""/>

						  <p>
							  <!-- Kontent Artikel-->
							  <?php echo $row['kontent_artikel'] ?>
						  </p>
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

	 </div>




		 <div class="col-md-4 content-right">
			 <div class="recent">
				 <h3>RECENT POSTS</h3>
				 <ul>
					 <li><a href="#">Aliquam tincidunt mauris</a></li>
					 <li><a href="#">Vestibulum auctor dapibus  lipsum</a></li>
					 <li><a href="#">Nunc dignissim risus consecu</a></li>
					 <li><a href="#">Cras ornare tristiqu</a></li>
				 </ul>
			 </div>
			 <div class="comments">
				 <h3>RECENT COMMENTS</h3>
				 <ul>
					 <li><a href="#">Amada Doe </a> on <a href="#">Hello World!</a></li>
					 <li><a href="#">Peter Doe </a> on <a href="#"> Photography</a></li>
					 <li><a href="#">Steve Roberts  </a> on <a href="#">HTML5/CSS3</a></li>
				 </ul>
			 </div>
			 <div class="clearfix"></div>
			 <div class="archives">
				 <h3>ARCHIVES</h3>
				 <ul>
					 <li><a href="#">October 2013</a></li>
					 <li><a href="#">September 2013</a></li>
					 <li><a href="#">August 2013</a></li>
					 <li><a href="#">July 2013</a></li>
				 </ul>
			 </div>
			 <div class="categories">
				 <h3>CATEGORIES</h3>
				 <ul>
					 <li><a href="#">Vivamus vestibulum nulla</a></li>
					 <li><a href="#">Integer vitae libero ac risus e</a></li>
					 <li><a href="#">Vestibulum commo</a></li>
					 <li><a href="#">Cras iaculis ultricies</a></li>
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
