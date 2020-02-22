
<?php
	
	header('Access-Control-Allow-Origin: *');

	//INCLUDE LIBRARY
	include 'dale.php';

	//MAKE NEW DATABASE
	$dale = new dale();

	$dale->konek_ke_database("localhost", "wan","root","");

	$dale->kueri("SELECT * FROM USER");
	
	
?>