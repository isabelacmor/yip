<?php

function connect() {
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
	     //successful connection
	}

	//select the database to work with 
	$db_selected = mysql_select_db($database, $link);
	if (!$db_selected) {
	    die ('Can\'t select database: ' . mysql_error());
	}
	else {
	    //successful database selection
	}
	return $link;
}

function API_Key() {
	return "1a271db4205854b";
}

?>