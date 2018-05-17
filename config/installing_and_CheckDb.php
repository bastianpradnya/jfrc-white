<?php
	/*
	 * Untuk Menginstal Tabel ke database
	 * silahkan jalankan file installing_and CheckDb ini
	 * agar semua database configurasi dari file TableDb dapat bermigrasi ke database Admin
	 */

	include "../config/Dbconnect.php";

	if($conn == TRUE) { 
		// Check connection jika conection tersambung.
		echo "Connection is Conected <br>";
	}

	if($dbselect === TRUE){ 
		// mengecek atau memvalidasi jika tabel database sudah ada
		echo"Database $dbname is intalled <br><br>";
	}

	function tabel($conn){
		include "../config/TableDb.php";
		//instace from class TableDb
		$tabeldb = new TableDb();

		//calling FUNCTION and parameter from class TableDb
		$tabeldb->tableAdmin($conn);
		$tabeldb->tableBarang($conn);
		$tabeldb->tabelBlogArticel($conn);
		$tabeldb->categoryArticel($conn);
		$tabeldb->blogComentar($conn);
		$tabeldb->tableCustomer($conn);
		$tabeldb->bannerBanground($conn);
		$tabeldb->keranjang($conn);
		$tabeldb->ContactUS($conn);
	}

	//jalankan function
	tabel($conn);