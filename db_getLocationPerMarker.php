<?php
		//include('dbConnect.php');

		if($_SERVER['REQUEST_METHOD']=='POST'){

			//Getting values 
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];

			//importing dbConnect.php script 
			require_once('db_Connect.php');

			//SQL
			$sql ="SELECT * FROM gisDetail WHERE latitude = '$latitude' AND longitude ='$longitude'";


			//getting result 
			$r = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($r);

			//creates an array
			$result = array();

			//set if exist return true, else false
			if($row>0){

				$checkLatLonIsExist = 'true';

				//Pushing flag exist in the blank array created 
				array_push($result,array(
						"checkLatLonIsExist"=>$checkLatLonIsExist,
						"id"=>$row['id'],
						"seaco_barcode"=>$row['seaco_barcode'],
						"latitude"=>$row['latitude'],
						"longitude"=>$row['longitude'],
						"address1"=>$row['address1'],
						"address2"=>$row['address2'],
						"address2_no"=>$row['address2_no'],
						"address2_streetType"=>$row['address2_streetType'],
						"address2_streetName"=>$row['address2_streetName'],
						"address2_areaType"=>$row['address2_areaType'],
						"address2_areaName"=>$row['address2_areaName'],
						"address2_batu"=>$row['address2_batu'],
						"address2_mukim"=>$row['address2_mukim'],
						"createdBy"=>$row['createdBy'],
						"createdDate"=>$row['createdDate'],
						"modifiedBy"=>$row['modifiedBy'],
						"modifiedDate"=>$row['modifiedDate'],
						"status"=>$row['status']
						));

			}else{

				$checkLatLonIsExist = 'false';

				array_push($result,array(
						"checkLatLonIsExist"=>$checkLatLonIsExist,
						"id"=>$row['id'],
						"seaco_barcode"=>$row['seaco_barcode'],
						"latitude"=>$row['latitude'],
						"longitude"=>$row['longitude'],
						"address1"=>$row['address1'],
						"address2"=>$row['address2'],
						"address2_no"=>$row['address2_no'],
						"address2_streetType"=>$row['address2_streetType'],
						"address2_streetName"=>$row['address2_streetName'],
						"address2_areaType"=>$row['address2_areaType'],
						"address2_areaName"=>$row['address2_areaName'],
						"address2_batu"=>$row['address2_batu'],
						"address2_mukim"=>$row['address2_mukim'],
						"createdBy"=>$row['createdBy'],
						"createdDate"=>$row['createdDate'],
						"modifiedBy"=>$row['modifiedBy'],
						"modifiedDate"=>$row['modifiedDate'],
						"status"=>$row['status']
						));

			}

			//Displaying the array in json format 
			echo json_encode(array('result'=>$result));

			mysqli_close($con);
		}
?>