<?php
//$breeds = array('Breed', 'Breed2', 'Breed3');
$breeds = $_POST['breeds'];
$img = $_FILES['img'];
if(isset($_POST['submit'])) {
	if($img['name']=='') {
		echo "<h2>An Image Please.</h2>";
	}else{
		$filename = $img['tmp_name'];
		$client_id="1a271db4205854b";
		$handle = fopen($filename, "r");
		$data = fread($handle, filesize($filename));
		$pvars   = array('image' => base64_encode($data));
		$timeout = 30;
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
		if($url!=""){
			echo "<h2>Uploaded Without Any Problem</h2>";
			echo "<img src='$url'/>";
			$hostname="db551601059.db.1and1.com";
			$database="db551601059";
			$username="dbo551601059";
			$password="Maximus123!";
			//connect to the database
			$link = mysql_connect($hostname, $username, $password);
			if (!$link) {
				die('Connection failed: ' . mysql_error());
			}else{
			     //debug_to_console( "Connection to MySQL server " .$hostname . " successful!" );
			}
			//select the database to work with 
			$db_selected = mysql_select_db($database, $link);
			if (!$db_selected) {
			    die ('Can\'t select database: ' . mysql_error());
			}else{
			    //debug_to_console( "Database " . $database . " successfully selected!" );
			}
			$result = mysql_query("INSERT INTO puppies (breed, url) VALUES ('$breeds', '$url')");
			if(! $result )
			{
			  die('Could not enter data: ' . mysql_error());
			}
			echo "Entered data successfully\n";
			mysql_close($conn);
		}else{
			echo "<h2>There's a Problem</h2>";
			echo $pms['data']['error'];  
		}
	}
}
?>