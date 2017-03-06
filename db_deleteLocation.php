<?php 
	//Importing Database Script  
	require_once('db_Connect.php');
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		
		//Getting values
		$id = $_POST['id'];
		
		//correct the timezone. need manual setting instead using NOW() because the mistake while setting timezone.
		 $date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
		 $currentDate = $date->format('Y-m-d H:i:s');
		
		//Creating an sql query		
		$sql = "DELETE FROM `gis`.`gisDetail` WHERE `id`='$id'";
		
		//Executing query to database
		if(mysqli_query($con,$sql)){
			//echo 'DELETE Successfully';
		}else{
			//echo 'Could Not DELETE';
		}
		
		//Closing the database 
		mysqli_close($con);
	}
?> 