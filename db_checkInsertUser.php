<?php 

		if($_SERVER['REQUEST_METHOD']=='POST'){

			//Getting values 
			$userFullName = $_POST['userFullName'];
			$userName = $_POST['userName'];
			$userPassword = $_POST['userPassword'];
			$userRegtype = $_POST['userRegtype'];

			//start currentDate
			$date = new DateTime('now', new DateTimeZone('Asia/Kuala_Lumpur'));
			$currentDate = $date->format('Y-m-d H:i:s');
			//end currentDate

			//importing dbConnect.php script 
			require_once('db_Connect.php');

			//Creating sql query
			$sql = "SELECT * FROM gisUser WHERE userName='$userName' AND userPassword = '$userPassword'";
			//$sql = "SELECT * FROM gis.gisUser WHERE userName='lizamat' AND userPassword = 'liza1234'";

			//getting result 
			$r = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($r);

			//if no return any data, insert. Otherwise block
			if($row<=0){
				$sqlInsert = "INSERT INTO gis.gisUser (userFullName, userName, userPassword, userRegtype, regDate) 
						VALUES ('$userFullName','$userName','$userPassword','$userRegtype','$currentDate')";

						//Executing query to database
						if(mysqli_query($con,$sqlInsert)){
							echo "success";
						}else{
							echo "failure";
						}
			}else{
				echo "failure";
			}

			mysqli_close($con);
		}
?>
