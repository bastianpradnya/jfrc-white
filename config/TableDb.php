<?php
Class TableDb{
	public function tableAdmin($conn){
		/*
		| Create table Admins
		| admin field is Nama Admin, Username Admin, Password for login admin.
		*/
		$tablename = "admin";
		$cektable = "select id from ".$tablename;
		if($conn->query($cektable) === FALSE){
			/*
			| table admin is create
			| field create id, nama_admin, username, password, timestamps
			*/
			$sql = "CREATE TABLE ".$tablename." (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			nama_admin VARCHAR(120) NOT NULL,
			username VARCHAR(120) unique,
			password CHAR(255) NOT NULL,
			reg_date TIMESTAMP
			)";
			if ($conn->query($sql) === TRUE) {
			    echo "<b>Table $tablename created successfully <br></b>";
			} else {
			    echo "Error creating table: " . $conn->error;
			}
		}else{
			echo "Table $tablename is Exist !!! <br>";
		}
	}
	public function tableBarang($conn){	
		/*
		| Create table Barang
		| tables of barang field is id, nama barang, harga, deskripsi, 
		| tanggal posting, status, photo 1, photo 2, photo 3
		*/
		$tablename = "barang";
		$cektable = "select id from ".$tablename;
		if($conn->query($cektable) === FALSE){
			/*
			| table admin is create
			| field create id, nama_admin, username, password, timestamps
			*/
			$sql = "CREATE TABLE ".$tablename." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
				nama_barang VARCHAR(225) NOT NULL,
				harga INTEGER(10) NOT NULL,
				deskripsi TEXT NOT NULL,
				stok INTEGER(10) NOT NULL,
				status VARCHAR(25) NOT NULL,
				kategori_barang VARCHAR(70) NOT NULL,
				photo_1 VARCHAR(225) NOT NULL,
				photo_2 VARCHAR(225) NOT NULL,
				photo_3 VARCHAR(225) NOT NULL,
				dilihat INT(6),
				dibeli INT(6),
				waktu_publish TIMESTAMP
				)";
			if ($conn->query($sql) === TRUE) {
			    echo "<b>Table $tablename created successfully <br></b>";
			} else {
			    echo "Error creating table: " . $conn->error;
			}
		}else{
			echo "Table $tablename is Exist !!! <br>";
		}
	}
	public function tableCustomer($conn){
		/*
		| Create table Customer
		| tables of barang field is id, Nama_Customer, Alamat, Jenis Kelamin
		| tanggal lahir, No.Telepon, password, tanggal registrasi.
		*/
		$tablename = "costumer";
		$cektable = "select id from ".$tablename;
		if($conn->query($cektable) === FALSE){
			/*
			| table costumer is create
			| field create id, nama_admin, tanggal_lahir, alamat, jenis_kelamin, tanggal_registrasi
			*/
			$sql = "CREATE TABLE ".$tablename." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				nama_customer VARCHAR(225) NOT NULL,
				email varchar(225) NOT NULL,
				no_telp INT(14),
				alamat VARCHAR(225) NOT NULL,
				tanggl_lahir VARCHAR(20),
				jenis_kelamin VARCHAR(25) NOT NULL,
				tanggal_Registrasi  TIMESTAMP,
				avatar VARCHAR(225),
				password VARCHAR(225),
				status_member VARCHAR(25)
				)";
			if ($conn->query($sql) === TRUE) {
				echo "<b>Table $tablename created successfully <br> </b>";
			} else {
				echo "Error creating table: " . $conn->error;
			}
		}else{
			echo "Table $tablename is Exist !!! <br>";
		}
	}
	public function tabelBlogArticel($conn){
		/*
		 * This function for creating table Blog to database
		 * table blog have field there are id, Judul artikel, Konten artikel, status, kategori, tanggal publish,
		 * field status digunakan untuk mendeskripsikan artikel tersebut aktif atau nonaktif untuk di tampilkan di blog user.
		 *
		 */
		$tablename = "blog_articel";
		$cektable = "select id from ".$tablename;

		if($conn->query($cektable) === FALSE){
			/*
			 * Jika tabel kosong didalam database maka logic ini dijalankan
			 */
			$sql = "CREATE TABLE ".$tablename." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				judul_artikel VARCHAR(225) NOT NULL,
				kontent_artikel TEXT,
				status VARCHAR(10) NOT NULL,
				kategori VARCHAR(255) NOT NULL,
				tanggal_publish TIMESTAMP,
				view INT(6)
				)";
			if($conn->query($sql) === TRUE){
				echo "<b>Table $tablename created Succesfully <br></b>";
			}else{
				echo "Error Creating tbale : ". $conn->error;
			}
		}else{
			/*
			 * else statement if condition cek tables is done
			 * and table creating already exist.
			 */
			echo "<br>Table $tablename is Exist !!! <br>";
		}
	}
	public function categoryArticel($conn){
		/*
		 * category artikel digunakan untuk menampilkan kategori pada menu list
		 * didalam artikel, editing blog.
		 * field yang diperlukan dalam membuat kategori berupa id dan category
		 */
		$tablename = "blog_category_articel";
		$cektable = "select id from ".$tablename;

		if($conn->query($cektable) === FALSE){
			/*
			 * Jika tabel kosong didalam database maka logic ini dijalankan
			 */
			$sql = "CREATE TABLE ".$tablename." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				category VARCHAR(225) NOT NULL
				)";
			if($conn->query($sql) === TRUE){
				echo "<b>Table $tablename created Succesfully<br></b>";
			}else{
				echo "Error Creating tbale : ". $conn->error;
			}
		}else{
			/*
			 * else statement if condition cek tables is done
			 * and table creating already exist.
			 */
			echo "Table $tablename is Exist !!! <br>";
		}
	}
	public function blogComentar($conn){
		/*
		 * function blogComentar digunakan untuk membuat tabel komentar
		 * pada kontent blog. dimana tabel komentar ini berisi field berupa :
		 *
		 */
		$tablename = "blog_comentar_articel";
		$cektable = "select id from ".$tablename;

		if($conn->query($cektable) === FALSE){
			/*
			 * Jika tabel kosong didalam database maka logic ini dijalankan
			 */
			$sql = "CREATE TABLE ".$tablename." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				id_articel INT(6) NOT NULL,
				nama_komentator VARCHAR(255),
				isi_komentar TEXT,
				waktu TIMESTAMP
				)";
			if($conn->query($sql) === TRUE){
				echo "<b>Table $tablename created Succesfully<br></b>";
			}else{
				echo "Error Creating tbale : ". $conn->error;
			}
		}else{
			/*
			 * else statement if condition cek tables is done
			 * and table creating already exist.
			 */
			echo "Table $tablename is Exist !!! <br>";
		}
	}
	public function bannerBanground($conn){
		/*
		 * function blogComentar digunakan untuk membuat tabel komentar
		 * pada kontent blog. dimana tabel komentar ini berisi field berupa :
		 *
		 */
		$tablename = "Banner";
		$cektable = "select id from ".$tablename;

		if($conn->query($cektable) === FALSE){
			/*
			 * Jika tabel kosong didalam database maka logic ini dijalankan
			 */
			$sql = "CREATE TABLE ".$tablename." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				judul INT(6) NOT NULL,
				photo VARCHAR(255),
				status VARCHAR(25),
				waktu TIMESTAMP
				)";
			if($conn->query($sql) === TRUE){
				echo "<b>Table $tablename created Succesfully<br></b>";
			}else{
				echo "Error Creating tbale : ". $conn->error;
			}
		}else{
			/*
			 * else statement if condition cek tables is done
			 * and table creating already exist.
			 */
			echo "Table $tablename is Exist !!! <br>";
		}
	}
	public function keranjang($conn){
		$tablename = "keranjang";
		$cektable = "select id from ".$tablename;

		if($conn->query($cektable) === FALSE){
			/*
			 * Jika tabel kosong didalam database maka logic ini dijalankan
			 */
			$sql = "CREATE TABLE ".$tablename." (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				id_produk INT(6) NOT NULL,
				id_session INT(6) NOT NULL,
				jumlah INT(6) NOT NULL,
				waktu TIMESTAMP
				)";
			if($conn->query($sql) === TRUE){
				echo "<b>Table $tablename created Succesfully<br></b>";
			}else{
				echo "Error Creating tbale : ". $conn->error;
			}
		}else{
			/*
			 * else statement if condition cek tables is done
			 * and table creating already exist.
			 */
			echo "Table $tablename is Exist !!! <br>";
		}
	}
	public function ContactUS($conn){
		/*
		 * function Contack digunakan untuk membuat tabel kontak
		 * pada halaman hubungi kami. dimana tabel ini berisi field berupa :
		 *
		 */
		$tablename = "kontak_kami";
		$cektable = "select id from ".$tablename;

		if($conn->query($cektable) === FALSE){
			/*
			 * Jika tabel kosong didalam database maka logic ini dijalankan
			 */
			$sql = "CREATE TABLE ".$tablename." (
				id_kontak INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				nama_kontak VARCHAR(50) NOT NULL,
				email_kontak VARCHAR(255),
				subjek_kontak VARCHAR(100),
				isi_pesan TEXT,
				waktu TIMESTAMP
				)";
			if($conn->query($sql) === TRUE){
				echo "<b>Table $tablename created Succesfully<br></b>";
			}else{
				echo "Error Creating table : ". $conn->error;
			}
		}else{
			/*
			 * else statement if condition cek tables is done
			 * and table creating already exist.
			 */
			echo "Table $tablename is Exist !!! <br>";
		}
	}
}
?>