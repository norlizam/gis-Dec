<?php 
 
 if($_SERVER['REQUEST_METHOD']=='POST'){
 
 //Getting values 
	//$userEmail = $_POST['userEmail'];
	$userName = $_POST['userName'];
	$userPassword = $_POST['userPassword'];
	
 //importing dbConnect.php script 
	require_once('db_Connect.php');
 
 //Creating sql query
	//$sql = "SELECT * FROM denguesitesUser WHERE userEmail='$userEmail' AND userPassword = '$userPassword'";
	$sql = "SELECT * FROM gisUser WHERE userName='$userName' AND userPassword = '$userPassword'";
	//$sql = "SELECT * FROM denguesitesUser WHERE userPhoneNo='0137429954' AND userPassword = 'liza1234'";

 //getting result 
	$r = mysqli_query($con,$sql);

  //pushing result to an array 
	$result = array();
	$row = mysqli_fetch_array($r);
	
 //if we got some result 
	if($row>0){
		array_push($result,array(
			"userId"=>$row['userId'],
			"userFullName"=>$row['userFullName'],
			"userName"=>$row['userName'],
			"userPassword"=>$row['userPassword'],
			"userRegtype"=>$row['userRegtype'],
			"regDate"=>$row['regDate']
		));
		
		//displaying in json format 
		echo json_encode(array('result'=>$result));
		
		//displaying success	
		echo "success";
		
	}
	else{
		//displaying failure
		echo "failure";
	}
	
	mysqli_close($con);
 }
?>
 