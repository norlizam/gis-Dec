<?php 

		if($_SERVER['REQUEST_METHOD']=='POST'){

			//set display per page
			$per_page = 16; 

			//Getting values 
			$id = $_POST['id'];  //id from gisDetail
			$page= $_POST['currentPage'];
			
			//set start page
			$start = ($page-1)*$per_page;

			//importing dbConnect.php script 
			require_once('db_Connect.php');

			//start select statement
		
			//SQL 1
			$sql = "SELECT gisDetailHist.*, gis1.userFullName as Createdby, gis2.userFullName as Modifiedby FROM gisDetailHist
					LEFT JOIN gisUser as gis1 ON gisDetailHist.createdBy = gis1.userId
					LEFT JOIN gisUser as gis2 ON gisDetailHist.modifiedBy = gis2.userId
                    WHERE id_history = '$id'
				    ORDER BY id desc limit $start,$per_page";	
			//end select statement

			//getting result 
			$r = mysqli_query($con,$sql);

			//creating a blank array 
			$result = array();

			//looping through all the records fetched
			while($row = mysqli_fetch_array($r)){

				//Pushing name and id in the blank array created 
				array_push($result,array(
						"id"=>$row['id'],
						"id_history"=>$row['id_history'],
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
						"Createdby"=>$row['Createdby'],
						"Modifiedby"=>$row['Modifiedby']));
			}

			//Displaying the array in json format 
			echo json_encode(array('result'=>$result));

			mysqli_close($con);
		}
?>
