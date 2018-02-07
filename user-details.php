<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


if(isset($_GET["e"]) && isset($_GET["p"]) ){
	if( !empty($_GET["e"])  && !empty($_GET["p"])  ){
	
		//$conn = new mysqli("localhost", "username", "password", "database");
			 $conn = new PDO("mysql:host=localhost;dbname=makio", "root", "NELLYBELLY");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$username=$_GET["e"];
		$password=$_GET["p"];
		$password=md5($password);
		
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		//$username = $conn->real_escape_string($username);
		//$password = $conn->real_escape_string($password);

		
		$query="SELECT u_name, u_id, u_phone, u_address, u_pincode FROM users  
				where u_verified=1 and u_id like '".$username."' and u_password like '".$password."'";
		//$result = $conn->query($query);
		$result = $conn->prepare($query);
                $result->execute();

              // $data=  $result->fetchAll(PDO::FETCH_ASSOC);
			  // var_dump($data);exit;
		$outp = "";
		
		if( $rs=$result->fetchAll(PDO::FETCH_ASSOC)[0]) {
			if ($outp != "") {$outp .= ",";}
			$outp['u_name'] = $rs["u_name"];
			$outp['u_id'] = $rs["u_id"];
			$outp['u_phone'] = $rs["u_phone"];
			$outp['u_address'] = $rs["u_address"];
			$outp['u_pincode'] = $rs["u_pincode"];
			
		}
		$outpa['records'] =$outp;
		//$conn->close();

		echo json_encode($outpa);
	}
}

?> 