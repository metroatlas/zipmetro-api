<?php
	// Create connection
	$con=mysqli_connect("localhost","root","root","metroatlas");

	// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error() . "</br>";
	} else {
		echo "Connected to database" . "</br>";
	}

	$zip = $_GET['zip'];
	echo $zip . "</br>";

	$result = mysqli_query($con,"SELECT * FROM A_ZipCBSA_2010 WHERE zip = " . $zip);

	while($row = mysqli_fetch_array($result)) {
  		print_r($row);
  		echo $row['countyname'] . " - " . $row['CBSATitle'];
  		echo "</br>";
	}

	mysqli_close($con);

?>