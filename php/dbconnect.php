<?php

if(isset($_GET['query'])) {
	query();
}

function query() {
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
     echo "Connection to MySQL server " .$hostname . " successful!
" . PHP_EOL;
}

//select the database to work with 
$db_selected = mysql_select_db($database, $link);
if (!$db_selected) {
    die ('Can\'t select database: ' . mysql_error());
}
else {
    echo 'Database ' . $database . ' successfully selected!';
}

//execute the SQL query and return records
$result = mysql_query("SELECT breed, url FROM puppies");

//fetch tha data from the database 
while ($row = mysql_fetch_array($result)) {
   echo "ID:".$row{'id'}." Type:".$row{'type'}."URL: ". //display the results
   $row{'url'}."<br>";
}


/*
$term = "shi";//trim(strip_tags($_GET['term']));//retrieve the search term that autocomplete sends

$qstring = "SELECT breed as breed, url FROM puppies WHERE breed LIKE '%".$term."%'";
$result = $mysqli->query($qstring);//query the database for entries containing the term

if ($result->num_rows>0)
	{
	while($row = $result->fetch_array())//loop through the retrieved values
		{
			echo "ID:".$row{'id'}." Breed:".$row{'breed'}."URL: ". //display the results
   $row{'url'}."<br>";
				/*$row['breed']=htmlentities(stripslashes($row['value']));
				$row['id']=(int)$row['id'];
				$row_set[] = $row;//build an array
		}
	//echo json_encode($row_set);//format the array into json data
	}
else echo "error";*/

//close the connection
mysql_close($link);
}

?>