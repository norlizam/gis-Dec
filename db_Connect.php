<?php
//this codes just want to try if the instance from google cloud can connect or not
 //$db = mysqli_connect('104.197.255.249', 'root', 'root', 'denguesites') ;

	//this if statement just want to try if the instance from google cloud can connect or not
    //if($result = $db->query("SELECT DATABASE()")){
		//$row = $result->fetch_row();
		//printf("Default database is %s.\n", $row[0]);
		//$result->close();
	   
	   //define('HOST','127.0.0.1');
	  //define('HOST','104.199.141.48');
	  //define('HOST','104.199.149.101');
	  define('HOST','35.185.137.169');
	  define('USER','root');
	  define('PASS','');
	 // define('PASS','root');
	  define('DB','gis');
	 $con = mysqli_connect(HOST,USER,PASS,DB) or die('Unable to Connect');
	
   // }

?> 