<?php


if(isset($_GET['query'])) {
	echo "<h3>Searching for: " . $_GET['query'] . "</h3>";

	query($_GET['query']);
} else if(isset($_POST['breeds'])) {
	//debug_to_console ("Searching default");

	//get arguments from the searchList
	$breedQuery = $_POST['breeds'];
	//debug_to_console ( "breedQuery: " + $breedQuery );

	query( $breedQuery );
} else {
	query( "Shiba Inu" );
}

function query($term) {
	//convert query to array
	$breedList = explode(",", $term);

	//debug_to_console( "Connecting to db" );

	//ENTER YOUR DATABASE CONNECTION INFO BELOW:
	$hostname="db551601059.db.1and1.com";
	$database="db551601059";
	$username="dbo551601059";
	$password="Maximus123!";

	//connect to the database
	$link = mysql_connect($hostname, $username, $password);
	if (!$link) {
	die('Connection failed: ' . mysql_error());
	}
	else{
	     //debug_to_console( "Connection to MySQL server " .$hostname . " successful!" );
	}

	//select the database to work with 
	$db_selected = mysql_select_db($database, $link);
	if (!$db_selected) {
	    die ('Can\'t select database: ' . mysql_error());
	}
	else {
	    //debug_to_console( "Database " . $database . " successfully selected!" );
	}

	//execute the SQL query and return records
	//$result = mysql_query("SELECT breed, url FROM puppies");
	//exact match
	$result = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $term ."'");
	//echo "<link rel='stylesheet' type='text/css' href='style.css' />";  

	echo "<h3>Results for: " . $term . "</h3>";
	if( mysql_num_rows($result) <= 0 ) {
		echo "No matches found :(";
	}

	//fetch tha data from the database 
	showDog($result);
/*
	if(count($breedList) == 3) {
		echo "<h3>Related results for: " . $term . "</h3>";
		$result1 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $breedList[0] ."," . $breedList[1]"'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $breedList[2] ."'");

		showDog($result1);
		showDog($result2);

		$result1 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $breedList[1] ."," . $breedList[2]"'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $breedList[0] ."'");

		showDog($result1);
		showDog($result2);

		$result1 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $breedList[0] ."," . $breedList[2]"'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $breedList[1] ."'");

		showDog($result1);
		showDog($result2);
	} else if(count($breedList) == 2) {
		echo "<h3>Related results for: " . $term . "</h3>";
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $breedList[0] ."'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $breedList[1] ."'");

		showDog($result1);
		showDog($result2);
	} else if(count($breedList) == 1) {
		echo "No matches found :(";
	}*/

	/*
	//error message if no matches
	if( mysql_num_rows($result) <= 0 ) {
		echo "No matches found :(";
	}*/

	//close the connection
	mysql_close($link);

}

function showDog( $result ){
	//fetch tha data from the database 
	while ($row = mysql_fetch_array($result)) {
	   $breed = $row{'breed'};
	   $url = $row{'url'};

	   $divDog = "<div class='dog'>";
	   $divImage = "<div class='container'>";
	   $display =  $divImage."<img src='".$url."'' /></div>";

	   echo $divDog."Breed: ".$breed."<br>".$display."</div>";
	}
}


function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

?>