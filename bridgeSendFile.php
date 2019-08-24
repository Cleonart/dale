<?php
  	
  	//MOVE UPLOADED FILES TO SERVER
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "stored_files/".$_FILES['file']['name'])) {
        exit;
    }
  
    //echo "failed";
  
?>