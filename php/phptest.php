<?php

// Handles actual connection with the MySQL database
include 'dbconnect.php';

// Direct querying with /?query=term
// Shouldn't actually be used outside of quick testing
if(isset($_GET['query'])) {
	echo "<h3>Searching for: " . $_GET['query'] . "</h3>";

	query($_GET['query']);
} // Querying with a list of breeds generated from search box
else if(isset($_POST['breeds'])) {
	// Get arguments from the list of breeds
	$breedQuery = $_POST['breeds'];

	// Run the query on the database
	query( $breedQuery );
} // Shouldn't ever enter this state, but just in case... shower the user with doge
else {
	query( "Shiba Inu" );
}


// Search the database for a list of breeds
function query($term) {
	// Convert query to array
	$breedList = explode(",", $term);

	// Connect to the database
	$link = connect();

	// Exact match
	// Our database stores dog breeds for each image link as a comma-separated string with breeds in alphabetical order
	// Case and spelling matter, which is why we only allow users to query breeds from a defined list of breeds (taken from AKC)
	$result = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '". $term ."'");

	// Presentation logic for displaying results header
	echo "<h2 class='resultTitle'>Results for: " . $term . "</h2>";
	if( mysql_num_rows($result) <= 0 ) {
		echo "<h4 class='nomatch'>No exact matches found :(</h4>";
	}

	// Fetch data from database and display it
	echo "<section class='large clearfix'>";
	showDog($result);
	echo "</section>";

	// Non-exact matches: any combination of breeds, including purebreds of every breed given
	if(count($breedList) == 3) {
		
		// Presentation logic for displaying results header mix combinations
		echo "<h2 class='resultTitle'>Related Mixes:</h2>";
		
		// Fetch data from database for every combination (current search is limited to a max of 3 breeds)
		$result1 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[0] . "," . $breedList[1] . "'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[1] . "," . $breedList[2] . "'");
		$result3 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[0] . "," . $breedList[2] . "'");

		// Presentation logic for displaying results
		if(mysql_num_rows($result1) + mysql_num_rows($result2) + mysql_num_rows($result3) > 0) { 
			echo "<section class='small clearfix'>";
			showDog($result1);
			showDog($result2);
			showDog($result3);
			echo "</section>";
		}else{
			echo "<section class='small clearfix'><h4 class='nomatch'>No related mixes found :(</h4></section>";
		}

		// Presentation logic for displaying results header purebreds
		echo "<h2 class='resultTitle'>Related Purebreds:</h2>";

		// Fetch data from database for every purebred
		$result1 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[0] . "'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[1] . "'");
		$result3 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[2] . "'");

		// Presentation logic for displaying results
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
		// Presentation logic for displaying results header mix combinations
		echo "<h2 class='resultTitle'>Related Purebreds:</h2>";

		// Fetch data from database for every purebred
		$result1 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[0] . "'");
		$result2 = mysql_query("SELECT breed, url FROM `puppies` WHERE breed LIKE '" . $breedList[1] . "'");

		// Presentation logic for displaying results header purebreds
		if(mysql_num_rows($result1) + mysql_num_rows($result2) > 0) { 
			echo "<section class='small clearfix'>";
			showDog($result1);
			showDog($result2);
			echo "</section>";
		}else{
			echo "<section class='small clearfix'><h4 class='nomatch'>No related purebreds found :(</h4></section>";
		}

	} else if(count($breedList) == 1) {
		// Can't do anything if searching for one breed and it wasn't already found
		// Not found message would already have printed
	}

	// Close connection to the database
	mysql_close($link);

}


// Presentation logic for displaying a styled list of results
function showDog( $result ){
	// Fetch data from database 
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


// console.log PHP echos
function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}

?>