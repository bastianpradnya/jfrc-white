<?php
	$servername = "localhost";
	$dbusername = "root";
	$dbpassword = "";

	// Create connection
	$conn = new mysqli($servername, $dbusername, $dbpassword);
	if ($conn->connect_error) { // Check connection
	    die("Connection failed: " . $con->connect_error);
	}

	$dbname = "JFRC";
	$dbselect = mysqli_select_db($conn, $dbname);
	if($dbselect == TRUE){ //cek dB
	}else{
		// create Db Name
		$sql = "CREATE DATABASE ".$dbname;
		if ($conn->query($sql) == TRUE) {
		    echo "Database created successfully <br>";
		    echo "<h3>Please Refresh the page to installing Table Atribute</h3> <br>";
		} else {
		    echo "Error creating database: " . $conn->error;
		}	
	}
?>