<?php
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
$post=json_decode(file_get_contents("php://input"));

if(isset($post->n) && isset($post->un)&& isset($post->ps)&& isset($post->ph)&& isset($post->add)&& isset($post->pin) ){
	if( !empty($post->n)  && !empty($post->un)&& !empty($post->ps)&& !empty($post->ph)&& !empty($post->add)&& !empty($post->pin)  ){

		//$conn = new mysqli("localhost", "username", "password", "database");
		 $conn = new PDO("mysql:host=localhost;dbname=makio", "root", "NELLYBELLY");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$name=$post->n;
		$username=$post->un;
		
		$password=$post->ps;
		$rawp=$password;
		$password=md5($password);
		
		$phone=$post->ph;
		$address=$post->add;
		$pincode=$post->pin;
		
		// To protect MySQL injection for Security purpose
		$name = stripslashes($name);
		$username = stripslashes($username);
		$password = stripslashes($password);
		$phone = stripslashes($phone);
		$address = stripslashes($address);
		$pincode = stripslashes($pincode);
		
		/*$name = mysql_real_escape_string($name);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		$phone = mysql_real_escape_string($phone);
		$address = mysql_real_escape_string($address);
		$pincode = mysql_real_escape_string($pincode);*/
		
		$check="SELECT * FROM users WHERE u_id = '$username'";
		//$rs = mysqli_query($conn,$check);
		//$data = mysqli_fetch_array($rs, MYSQLI_NUM);
		$result = $conn->prepare($check);
                $result->execute();

               $data=  $result->fetchAll(PDO::FETCH_ASSOC);
		
		if(count($data) > 0) {
			//$outp='{"result":{"created": "0" , "exists": "1" }';
			$outp['created']='0';
			$outp['exists']='1';
		}
		else{	
			$sql = "INSERT INTO users VALUES ('$name', '$username', '$password', '$phone','$address' ,'$pincode',1 )";		
			$prepStmnt = $conn->prepare($sql);
                

			
			if ($prepStmnt->execute()){
				//$outp='{"result":{"created": "1", "exists": 0" }';
				$outp['created']='1';
			$outp['exists']='0';
			$sendMail=$username;
		$SendName=$name;
		require_once 'alerts.php';
		
			} 
		}
		
		
		echo json_encode($outp);
		//$sendMail=$username;
		//$sendName=$name;
		//require_once 'alerts.php';
		
	}
}





?> 