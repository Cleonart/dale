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
    protected $handshake_credential    = 0;
    protected $handshake_authorization = 0; //0 MEAN THERE'S NO NEED OF SPECIFIC AUTHORIZATION TO ACCESS API

    /* PUBLIC FUNCTION */
    public function authorization($min=""){
        $this->handshake_authorization = $min;
    }

    //CONNECT TO DATABASE FUNCTION
	public function connectDB($host="", $dbName="", $user="", $password="", $log=0){
        
        $i = 0;
        $errors = [];

        //IF DATABASE NAME IS NOT EXIST
        if($dbName == "") {
           $errors[$i] = array('code'=>"C001", 'msg'=>"Database name can't be empty");
           $i++;
        }

        //IF DATABASE HOST IS NOT EXIST
        if($host == ""){
            $errors[$i] = array('code'=>"C002", 'msg'=>"Host Not Defined");
            $i++;
        }

        //IF DATABASE USER IS NOT EXIST
        if($user == "") {
           $errors[$i] = array('code'=>"C003", 'msg'=>"Database User Not Defined");
        }

        //ABORT CONNECTION
        if ($errors != []) {
            echo json_encode($errors);
        }

        //ESTABILISH CONNECTION WITH DATABASE
        else{

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

                //ONLY IF DEBUGGING TURNED ON
                if ($log == 1) {
                    $this->showError("D200", "Connected to database successfully");
                }

    		} 

            catch (PDOException $e) {
                $this->showError("SQLSTATE[".$e->errorInfo[0]."]",$e->errorInfo[2]);
                $this->error = 1;
            }
    
        }
    
    }

    // querying data
    public function query($sql_query){

        try{

            // trying to connect to database
            if($this->connect){
                
                // execute query from sql command
                $result = $this->connect->query($sql_query);
                
                // initialize and fetch the data
                $data = [];
                foreach($result as $row){
                    $data[] = $row;
                }

                // return data
                return $data;

            }

        }

        catch(PDOException $e){
            $this->showError("ERROR", $e);
        }

    }

    public function log(){

        if ($this->error == 0) {
            echo "\nconnected to <b>\"" . $this->host . "\"</b> with database <b>\"" . $this->database_name ."\"</b>";
        }}


    /* PROTECTED FUNCTION */

    //show error
    protected function showError($code, $message, $errorType=0){

        $errorLog = json_encode(array('code'=>$code,
                                      'msg'=>$message));
        
        if ($errorType == 1) {
            return $errorLog;
        }

        else if($errorType == 0){
            echo $errorLog;
        }}

}

?>