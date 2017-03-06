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
			
			//SQL 1
			$sql = "SELECT gisDetailHist.*, gis1.userFullName as Createdby, gis2.userFullName as Modifiedby FROM gisDetailHist
					LEFT JOIN gisUser as gis1 ON gisDetailHist.createdBy = gis1.userId
					LEFT JOIN gisUser as gis2 ON gisDetailHist.modifiedBy = gis2.userId
                    WHERE id_history = '$id'
					ORDER BY id desc";

			//getting result 
			$r = mysqli_query($con,$sql);

			$count = mysqli_num_rows($r);
			$pages = ceil($count/$per_page);

			//creates an array
			$result = array();

			//Pushing name and id in the blank array created 
			array_push($result,array(
					"pageCount"=>$pages
					));

			//Displaying the array in json format 
			echo json_encode(array('result'=>$result));

			mysqli_close($con);
		}
?>
