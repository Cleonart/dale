<!-------------------------------------------
---------------------------------------------
YANGSIG BRIDGE API - VERSION 0.0.1 (unoptimal)
^_^ Made by student for students
    More Form, Less Code

안녕하세요 양식.js | part of 게네싯 project
******************************************-->

<!-- API TESTING -->

<?php
	
	header('Access-Control-Allow-Origin: *');

	//INCLUDE LIBRARY
	include 'yangsigAPI.php';

	//MAKE NEW DATABASE
	$yangsig = new yangDB();

	//SETTING UP DATABASE CONNECTION
	//ONLY SUPPORT WITH MYSQL TYPE DATABASE
	$yangsig->connectDB("perizinan", "localhost", "root", "");

	//INSERT DATA - THERE'S  2 MODE
	//RAW MODE AND MODEL MODE
	//WE HIGHLY RECOMMEND USING MODEL MODE ^_^
	$yangsig->insertDataRaw("tes", "we", "as");
	$yangsig->insertDataModel("yangsig_config");
		
	//SELECT DATA
	//BY DEFAULT THE OUTPUT DATA IS IN "JSON FORMAT"
	$yangsig->getData("table_name", "data_to_get", "no_limit", "extenstion_with_where");
	$yangsig->getDataRaw("SELECT * FROM `list_perizinan` ORDER BY tgl_reg ASC, jenis_perizinan ASC", 100);

	//ENABLE STATUS
	//DISABLE THIS WHEN USING IN PRODUCTION
	//MUST BE IN THE VERY BOTTOM
	//$yangsig->log();

?>