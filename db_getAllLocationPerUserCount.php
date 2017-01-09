<?php 

		if($_SERVER['REQUEST_METHOD']=='POST'){

			//set display per page
			$per_page = 16; 

			//Getting values 
			$insertBy = $_POST['userId'];
			$userRegtype = $_POST['userRegtype'];
			$subValues = $_POST['subValues'];
			$page= $_POST['currentPage'];

			//set start page
			$start = ($page-1)*$per_page;

			//importing dbConnect.php script 
			require_once('db_Connect.php');

			if($userRegtype == "S0"){
				if($subValues == "0"){
					//SQL 1
					$sql = "SELECT * FROM gis ORDER BY id desc";
				}else{
					//SQL 2
					$sql = "SELECT * FROM gis WHERE address2_mukim = '$subValues' ORDER BY id desc";

				}
			}else{
				if($subValues == "0"){
					//SQL 1
					$sql = "SELECT * FROM gis WHERE createdBy = '$insertBy'  ORDER BY id desc";
				}else{
					//SQL 2
					$sql = "SELECT * FROM gis WHERE createdBy = '$insertBy' AND address2_mukim = '$subValues' ORDER BY id desc";

				}
			}

			//end months

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
