<?php


include 'dbconnect.php';


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

	$link = connect();

	//exact match
	$result = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $term ."'");
	//echo "<link rel='stylesheet' type='text/css' href='style.css' />";  

	echo "<h2 class='resultTitle'>Results for: " . $term . "</h2>";
	if( mysql_num_rows($result) <= 0 ) {
		echo "<h4 class='nomatch'>No exact matches found :(</h4>";
	}

	//fetch tha data from the database 
	echo "<section class='large clearfix'>";
	showDog($result);
	echo "</section>";

	if(count($breedList) == 3) {
		
		echo "<h2 class='resultTitle'>Related Mixes:</h2>";
		
		$result1 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[0] . "," . $breedList[1] . "'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[1] . "," . $breedList[2] . "'");
		$result3 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[0] . "," . $breedList[2] . "'");
		//$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[2] . "'");

		if(mysql_num_rows($result1) + mysql_num_rows($result2) + mysql_num_rows($result3) > 0) { 
			echo "<section class='small clearfix'>";
			showDog($result1);
			showDog($result2);
			showDog($result3);
			echo "</section>";
		}else{
			echo "<section class='small clearfix'><h4 class='nomatch'>No related mixes found :(</h4></section>";
		}

		echo "<h2 class='resultTitle'>Related Purebreds:</h2>";

		$result1 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[0] . "'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[1] . "'");
		$result3 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[2] . "'");

		if(mysql_num_rows($result1) + mysql_num_rows($result2) + mysql_num_rows($result3) > 0) { 
			echo "<section class='small clearfix'>";
			showDog($result1);
			showDog($result2);
			showDog($result3);
			echo "</section>";
		}else{
			echo "<section class='small clearfix'><h4 class='nomatch'>No related purebreds found :(</h4></section>";
		}

	} else if(count($breedList) == 2) {
		echo "<h2 class='resultTitle'>Related Purebreds:</h2>";

		$result1 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[0] . "'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[1] . "'");

		if(mysql_num_rows($result1) + mysql_num_rows($result2) > 0) { 
			echo "<section class='small clearfix'>";
			showDog($result1);
			showDog($result2);
			echo "</section>";
		}else{
			echo "<section class='small clearfix'><h4 class='nomatch'>No related purebreds found :(</h4></section>";
		}

	} else if(count($breedList) == 1) {
		//echo "No matches found :(";
	}

	//close the connection
	mysql_close($link);

}

function showDog( $result ){
	//fetch tha data from the database 
	while ($row = mysql_fetch_array($result)) {
	   $breed = $row{'breed'};
	   $url = $row{'url'};

	   $divWrapper = "<div class='dog-wrapper'>";
	   $divBreed = "<div class='dogName'>";
	   $divImage = "<div class='dogImage'>";
	   $display =  $divImage . "<img src='" . $url . "'' /></div>";

	   echo $divWrapper . $divBreed . "" . $breed . "</div>" . $display."</div>";
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