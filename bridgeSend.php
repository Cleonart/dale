<!--------------------------------------
YANGSIG BRIDGE API - VERSION 0.0.1 (unoptimal)
^_^ Made by student for students
    More Form, Less Code

안녕하세요 양식.js | part of 게네싯 project
***************************************-->
<!-- PROJECT BRIDGE -->
<!-- STEP TO USE 
	 1. COPY THE PHP GENERATED FILE TO ASSETS FOLDER
	 2. WITH YANGSIG.JS USE THE DEFAULT DATA SENDING
	 3. THIS API CAN ALWAYS BE REUSED AGAIN

	 ONLY SUPPORTING SINGLE DATA FOR NOW
-->

<?php
		
	header('Access-Control-Allow-Origin: *');

	include 'bridgeDbConnection.php';

	$data    = file_get_contents("php://input");
	$request = json_decode($data);

	if (isset($data)) {

		//NAME OF THE BRIDGE API
		$bridge_name = $request -> bridge_auth;

		//DATA FROM THE BRIDGE
		$yangData = $request -> bridge_data;
		
		include "assets/" . $bridge_name . ".php";

		try{

			$db = new DB();
			$conn = $db->connectDB();

			if ($conn) {
				$query = $bridge_generated_value;
				$conn->query($query);
				//echo json_encode($request);
			}

			else{
				echo $conn;
			}

		}
		
		catch(PDOException $e){
			echo $e;
		}

	}

?>
