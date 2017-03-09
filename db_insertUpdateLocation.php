<?php
		//include('dbConnect.php');

		if($_SERVER['REQUEST_METHOD']=='POST'){

			//Getting values
			$id = $_POST['id'];
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
			$modifiedBy = $_POST['modifiedBy'];
			$isEdit = $_POST['isEdit'];
			$status = $_POST['status'];
			
			//start reverse geocode
			$address=file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=AIzaSyBoorH83D_jpkis-uzIQv5KHjZ3vbt4UaA");
			$json_data=json_decode($address);
			$address1=$json_data->results[0]->formatted_address;
			//end reverse geocode

			//start currentDate
			$date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
			$currentDate = $date->format('Y-m-d H:i:s');
			//end currentDate
			
			//importing dbConnect.php script 
			require_once('db_Connect.php');

			//SQL
			$sql ="SELECT * FROM gisDetail WHERE latitude = '$latitude' AND longitude ='$longitude'";


			//getting result 
			$r = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($r);

			//creates an array
			$result = array();

			//save maps
			if($isEdit == "N"){

				//set if exist return true, else false
				if($row<=0){
					$sql= "INSERT INTO gisDetail (seaco_barcode,latitude,longitude,address1,address2,
													address2_no,address2_streetType,address2_streetName,address2_areaType,address2_areaName,
													address2_batu,address2_mukim,createdBy,createdDate,modifiedBy, status) 
											VALUES ('$seaco_barcode','$latitude','$longitude','$address1','$address2',
													'$address2_no','$address2_streetType','$address2_streetName','$address2_areaType','$address2_areaName',
													'$address2_batu','$address2_mukim','$createdBy','$currentDate','$modifiedBy','$status')";
						
									//Executing query to database
									mysqli_query($con, $sql);
									
							$checkLatLonNotDup = 'true';
				}else{
					$checkLatLonNotDup = 'false';
				}

			}
			//edit maps
			else{

				//set if exist return true, else false
				if($row<=0){
				
					$sql = "INSERT INTO gisDetailHist (id_history, seaco_barcode, latitude, longitude, address1, 
									address2, address2_no, address2_streetType, address2_streetName, address2_areaType, 
									address2_areaName, address2_batu, address2_mukim, createdBy, createdDate, 
									modifiedBy, modifiedDate, status)
									SELECT id, seaco_barcode, latitude, longitude, address1, 
									address2, address2_no, address2_streetType, address2_streetName, address2_areaType, 
									address2_areaName, address2_batu, address2_mukim, createdBy, createdDate, 
									'$modifiedBy', '$currentDate', status from `gisDetail` WHERE id = '$id';";
					
					$sql .= "UPDATE gisDetail SET 
							seaco_barcode = '$seaco_barcode', 
							latitude = '$latitude', 
							longitude = '$longitude', 
							address1 = '$address1', 
							address2 = '$address2', 
							address2_no = '$address2_no', 
							address2_streetType = '$address2_streetType', 
							address2_streetName = '$address2_streetName', 
							address2_areaType = '$address2_areaType', 
							address2_areaName = '$address2_areaName', 
							address2_batu = '$address2_batu', 
							address2_mukim = '$address2_mukim', 
							modifiedBy = '$modifiedBy', 
							modifiedDate = '$currentDate',
							status = '$status'
							WHERE id ='$id'";

							//Executing query to database
							mysqli_multi_query($con, $sql);
				
					$checkLatLonNotDup = 'true';
				}else{
					if($id == $row['id']){
					
						$sql = "INSERT INTO gisDetailHist (id_history, seaco_barcode, latitude, longitude, address1, 
									address2, address2_no, address2_streetType, address2_streetName, address2_areaType, 
									address2_areaName, address2_batu, address2_mukim, createdBy, createdDate, 
									modifiedBy, modifiedDate, status)
									SELECT id, seaco_barcode, latitude, longitude, address1, 
									address2, address2_no, address2_streetType, address2_streetName, address2_areaType, 
									address2_areaName, address2_batu, address2_mukim, createdBy, createdDate, 
									'$modifiedBy', '$currentDate', status from `gisDetail` WHERE id = '$id';";
									
						$sql .= "UPDATE gisDetail SET 
								seaco_barcode = '$seaco_barcode', 
								latitude = '$latitude', 
								longitude = '$longitude', 
								address1 = '$address1', 
								address2 = '$address2', 
								address2_no = '$address2_no', 
								address2_streetType = '$address2_streetType', 
								address2_streetName = '$address2_streetName', 
								address2_areaType = '$address2_areaType', 
								address2_areaName = '$address2_areaName', 
								address2_batu = '$address2_batu', 
								address2_mukim = '$address2_mukim', 
								modifiedBy = '$modifiedBy', 
								modifiedDate = '$currentDate',
								status = '$status'
								WHERE id ='$id'";

								//Executing query to database
								mysqli_multi_query($con, $sql);

						$checkLatLonNotDup = 'true';
					}else{
						$checkLatLonNotDup = 'false';
					}
				}

			}

			//Pushing flag exist in the blank array created 
			array_push($result,array(
					"checkLatLonNotDup"=>$checkLatLonNotDup
					));

			//Displaying the array in json format 
			echo json_encode(array('result'=>$result));

			mysqli_close($con);

			
		}
?>