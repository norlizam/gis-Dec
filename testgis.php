<?php
		//include('dbConnect.php');

		//if($_SERVER['REQUEST_METHOD']=='POST'){

			//Getting values
		
			$latitude = "3.0646030099437325";//$_POST['latitude'];
			$longitude = "101.60098314285278";//$_POST['longitude'];
		
			
			//start reverse geocode
			$address=file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$latitude,$longitude&key=AIzaSyBoorH83D_jpkis-uzIQv5KHjZ3vbt4UaA");
			$json_data=json_decode($address);
			$address1=$json_data->results[0]->formatted_address;
			//end reverse geocode

			echo $address1;
			
		//}
?>