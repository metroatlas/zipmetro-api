<?php
 	// CORS header
 	// To allow cross-domain API connections
 	header("Access-Control-Allow-Origin: *");

	// Create connection
	$con=mysqli_connect("localhost","root","root","zipmetro");

  $key = 'APIkey';

  // Check connection
  if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error() . "</br>";
  };

  $zip = $_GET['zip'];
  $field = $_GET['field'];
  $userkey = $_GET['key'];

  if($userkey == $key){
    $result = mysqli_query($con,"SELECT * FROM A_ZipCBSA_2010 WHERE zip = " . $zip);
    while($row = mysqli_fetch_array($result)) {
        //print_r($row);
        $r = array( 'zip' => $row['zip'],
              'countyname' => $row['countyname'],
              'countynamefull' => $row['countynamefull'],
              'CBSATitle' => $row['CBSATitle'],
              'CBSACentralCity' => $row['CBSACentralCity'],
              'CBSACentralCities' => explode(",", $row['CBSACentralCities']),
              'CBSAStates' => explode(",", $row['CBSAStates']),
              'CBSACode' => $row['CBSACode'],
              'StateName' => $row['StateName'],
              'CSATitle' => $row['CSATitle'],
              'CSACode' => $row['CSACode'],
              'CSACentralCity' => $row['CSACentralCity'],
              'CSACentralCities' => explode(",", $row['CSACentralCities']),
              'CSAStates' => explode(",", $row['CSAStates']),
              'PSATitle' => $row['PSATitle'],
              'PSACode' => $row['PSACode'],
              'PSACentralCity' => $row['PSACentralCity'],
              'PSACentralCities' => explode(",", $row['PSACentralCities']),
              'PSAStates' => explode(",", $row['PSAStates']),
              'cities' => explode(", ", $row['allCities']));
        if($field) {
          if($field == 'cities') {
            // Transform the allCities field in a json object
            $cities = explode(", ", $row['allCities']);
            echo json_encode($cities);
          } else {
            echo $r[$field];
          }
        } else {
          echo json_encode($r);
        }
        
    }

    mysqli_close($con);
  } else {
    echo 'Invalid API key.';
  }
?>