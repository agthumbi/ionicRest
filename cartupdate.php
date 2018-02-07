<?php

header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
$post=json_decode(file_get_contents("php://input"));

	$id=$post->id;
	$uid=$post->uid;
	$type=$post->type;
		
	 $conn = new PDO("mysql:host=localhost;dbname=makio", "root", "NELLYBELLY");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$id = stripslashes($id);
		$uid = stripslashes($uid);
			$type = stripslashes($type);

		$check="SELECT qty,count(qty) as cqty FROM usercart WHERE uid = '$id' and eid='$uid'";
	
		$result = $conn->prepare($check);
                $result->execute();

               $data=  $result->fetchAll(PDO::FETCH_ASSOC)[0];
			   
			   $qty= $data['qty'];
			    $cqty= $data['cqty'];
			   switch($type)
			   {
				  case 'del':
				  $qty=$qty-1;
				 			  
                  break;
case 'inc':
 $qty=$qty+1;
 
break;
			   }
	

  if( $qty>0)
					  $query="update  usercart set qty='".$qty."' WHERE uid = '$id' and eid='$uid'";  
				  else
				  $query="delete  FROM usercart WHERE uid = '$id' and eid='$uid'";	
			  
			   
				   
	$query1="SELECT count(qty) as cqty FROM usercart WHERE  eid='$uid'";
			$prepStmnt = $conn->prepare($query);
                

			
			if ($prepStmnt->execute()){
				$result = $conn->prepare($query1);
				$result->execute();
			
				 $data=$result->fetchAll(PDO::FETCH_ASSOC)[0];
				$cqty= $data['cqty'];
				//$outp='{"result":{"created": "1", "exists": 0" }';
				$outp['created']='1';
			$outp['exists']=  '0';
			$outp['qty']=$qty;
			$outp['cqty']=$cqty;
			
		
			} 
			echo json_encode($outp);
?>