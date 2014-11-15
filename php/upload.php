<?php

// Handles actual connection with the MySQL database
include 'dbconnect.php';


// User-provided list of dog breeds their photo matches
$breeds = $_POST['breeds'];
// User-provided photo of a dog
$img = $_FILES['img'];

if(isset($_POST['submit'])) {
	
	// No image given
	if($img['name']=='') {
		echo "<h2>An Image Please.</h2>";
	} else {
		// Upload setup
		$filename = $img['tmp_name'];
		$client_id = API_Key();
		$handle = fopen($filename, "r");
		$data = fread($handle, filesize($filename));
		$pvars   = array('image' => base64_encode($data));
		$timeout = 30;

		// Imgur API calls
		// $url stores the image's URL uploaded on Imgur
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
		curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
		$out = curl_exec($curl);
		curl_close ($curl);
		$pms = json_decode($out,true);

		$url=$pms['data']['link'];

		// Add list of breeds and image link to database
		if($url!="") {
			$conn = connect();

			$result = mysql_query("INSERT INTO puppies (breed, url) VALUES ('$breeds', '$url')");
			if(! $result ) {
			  die('Could not enter data: ' . mysql_error());
			}

			// Return success message
			echo "SUCCESS_UPLOAD";
			mysql_close($conn);
		} else {
			// Return error message
			echo "ERROR_UPLOAD";
		}
	}
}
?>