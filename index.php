<?php
	// Create connection
	$con=mysqli_connect("localhost","root","root","metroatlas");

	// Check connection
	if (mysqli_connect_errno()) {
  		echo "Failed to connect to MySQL: " . mysqli_connect_error() . "</br>";
	};

	$zip = $_GET['zip'];
	$field = $_GET['field'];

	$result = mysqli_query($con,"SELECT * FROM A_ZipCBSA_2010 WHERE zip = " . $zip);

	while($row = mysqli_fetch_array($result)) {
  		//print_r($row);
  		$r = array( 'zip' => $row['zip'],
  					'countyname' => $row['countyname'],
  					'CBSATitle' => $row['CBSATitle'],
  					'CBSACentralCity' => $row['CBSACentralCity']);
  		if($field) {
  			echo $r[$field];
  		} else {
  			echo json_encode($r);
  		}
  		
	}

	mysqli_close($con);

?>