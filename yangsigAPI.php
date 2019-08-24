<?php

/**
---------------------------------------------
YANGSIG BRIDGE API - VERSION 0.0.1 (unoptimal)
^_^ Made by student for students
    More Form, Less Code

안녕하세요 양식.js | part of 게네싯 project
***************************************-->
*/

header('Access-Control-Allow-Origin: *');

class yangDB{
	
    //YANGSIG CLASS VARIABLE
	protected $connect = null;         //TO ESTABILISH CONNECTION
    protected $host    = null;         //SET THE HOST FOR DATABASE
    protected $database_name = null;   //SET THE NAME OF DATABASE
    protected $error = 1;
    protected $hanshake_approved = null;

    /* PUBLIC FUNCTION */

    //CONNECT TO DATABASE FUNCTION
	public function connectDB($dbName, $host, $user, $password){
		
		try {

            $this->database_name = $dbName;
            $this->host = $host;

            //SET DESTINATION TO SEND DATA
            $destination = "mysql:dbname=".$dbName.";host=".$host;

        	//PDO OPTIONS
            $options  = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            );

            //MAKE NEW PDO
            $this->connect = new PDO($destination, $user, $password, $options);
            $this->error = null;

            //MAKE HANDSHAKE
            $hanshake_approved = 1;
            
		} 

        catch (PDOException $e) {
            $this->showError(500, $e->getMessage(), "log");
            $this->error = 1;
        }}

    // SEND DATA TO TABLE WITH RAW VERSION
    public function insertDataRaw($table, $req_det, $data){

        if (isset($data)) {

            //DATA FROM THE BRIDGE
            //$yangData = $request -> bridge_data;
        
            //include "assets/" . $bridge_name . ".php";

            try{

                //CHECK IF THERE'S ERROR IN DATABASE CONNECTION
                if ($this->connect != null) {
                    //$query = $bridge_generated_value;
                    //$conn->query($query);
                    //echo json_encode($request);
                }

                else if($this->connect == null && $this->error == 1){
                    $this->showError(500, "No database connection, please make one");
                }

            }
        
            catch(PDOException $e){
                echo $e;
            }

        }}

    // SEND DATA TO VIA YANGSIG BRIDGE 
    public function insertDataModel($yangsigConf){}

    // SELECT DATA 
    public function getData($a,$b,$c,$d){}

    //SELECT DATA WITH RAW MODE
    //SUPPORT ONLY JSON MODEL FOR NOW
    public function getDataRaw($sql_data, $format){
        
        try{

            if ($this->connect) {

                //GET DATA FROM SERVER VIA SQL COMMAND
                $result = $this->connect->query($sql_data);

                //INITIALIZE SERVER DATA
                $data = [];

                //FETCH DATA FROM DATABASE
                foreach ($result as $row) {
                    $data[] = $row;
                }

                //LOG RECEIVED DATA IF THE RECEIVED DATA IS VALID
                if ($data != []) {

                     //STORE DATA IN JSON FORMAT
                    if ($format == 100) {
                        $data = json_encode($data);
                    }

                }

                //SHOW ERROR WHEN RECEIVED DATA IS EMPTY
                else{

                    if ($format == 100) {
                        $data = json_encode(array('code' => $code,  
                                                  'msg'  => $message));  
                    }

                }

                //DISPLAY ENCODED DATA 
                echo $data;

            }

        }

        catch(PDOException $e){
            echo "Something happened";
        }}

    //DELETE DATA 
    public function deleteData($table, $sql_data){

       try{

            if ($this->connect) {

                //SQL COMMANDS
                $sql_data = "DELETE FROM $table WHERE " + $sql_data;

                //EXECUTE SQL COMMAND
                $result = $this->connect->query($sql_data);
                
                //FEEDBACK
                showError(200, "Data Deleted Successfully", "log");
            }

        }

        catch(PDOException $e){
            echo "Something happened";
        }}

    //DELETE DATA WITH RAW MODE
    public function deleteDataRaw($sql_data){

        try{

            if ($this->connect) {
                
                //AUTOMATICLY EXECUTE SQL COMMAND 
                $result = $this->connect->query($sql);

                //FEEDBACK
                showError(200, "Data Deleted Successfully", "log"); 

            }

        }

        catch(PDOException $e){
            showError("SQLERROR",$e,"log");
        }}


    public function log(){

        if ($this->error == 0) {
            echo "\nconnected to <b>\"" . $this->host . "\"</b> with database <b>\"" . $this->database_name ."\"</b>";
        }}


    /* PROTECTED FUNCTION */

    //SHOW ERROR
    protected function showError($code, $message, $errorType){

        $errorLog = json_encode(array('code'=>$code,
                                      'msg'=>$message));
        
        if ($errorType == "return") {
            return $errorLog;
        }

        else if($errorType == "log"){
            echo $errorLog;
        }}

}

?>