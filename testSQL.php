<?php
			//Getting values
			$id = "17";//$_POST['id'];
			$seaco_barcode = $_POST['seaco_barcode'];
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$address1 = $_POST['address1'];
			$address2 = $_POST['address2'];
			$address2_no = $_POST['address2_no'];
			$address2_streetType = $_POST['address2_streetType'];
			$address2_streetName = $_POST['address2_streetName'];
			$address2_areaType = $_POST['address2_areaType'];
			$address2_areaName = $_POST['address2_areaName'];
			$address2_batu = $_POST['address2_batu'];
			$address2_mukim = $_POST['address2_mukim'];
			$createdBy = $_POST['createdBy'];
			$modifiedBy = "17";//$_POST['modifiedBy'];
			$isEdit = $_POST['isEdit'];

			//start currentDate
			$date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
			$currentDate = $date->format('Y-m-d H:i:s');
			//end currentDate
			
			//importing dbConnect.php script 
			require_once('db_Connect.php');

			//SQL
			$sql .= "INSERT INTO gisDetailHist (id_history, seaco_barcode, latitude, longitude, address1, 
					address2, address2_no, address2_streetType, address2_streetName, address2_areaType, 
					address2_areaName, address2_batu, address2_mukim, createdBy, createdDate, 
					modifiedBy, modifiedDate)
					SELECT id, seaco_barcode, latitude, longitude, address1, 
					address2, address2_no, address2_streetType, address2_streetName, address2_areaType, 
					address2_areaName, address2_batu, address2_mukim, createdBy, createdDate, 
					'$modifiedBy', '$currentDate' from `gisDetail` WHERE id = '$id';";
					
			$sql .= "INSERT INTO gisDetailHist (id_history, seaco_barcode, latitude, longitude, address1, 
					address2, address2_no, address2_streetType, address2_streetName, address2_areaType, 
					address2_areaName, address2_batu, address2_mukim, createdBy, createdDate, 
					modifiedBy, modifiedDate)
					SELECT id, seaco_barcode, latitude, longitude, address1, 
					address2, address2_no, address2_streetType, address2_streetName, address2_areaType, 
					address2_areaName, address2_batu, address2_mukim, createdBy, createdDate, 
					'$modifiedBy', '$currentDate' from `gisDetail` WHERE id = '$id'";

				//Executing query to database
				
				mysqli_multi_query($con, $sql) or die("MySQL Error: " . mysqli_error($con) . "<hr>\nQuery: $testquery");
				
				//if(mysqli_query($con,$sql)){
						//echo 'Location Added Successfully';
				//}else{
						//echo 'Could Not Add Location';
				//}

			mysqli_close($con);	
		
?>