<?php

header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
$post = json_decode(file_get_contents("php://input"));

$id = $post->id;
$uid = $post->uid;

$conn = new PDO("mysql:host=localhost;dbname=makio", "root", "NELLYBELLY");
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = stripslashes($id);
$uid = stripslashes($uid);



$check = "delete  FROM usercart WHERE uid = '$id' and eid='$uid'";


$result = $conn->prepare($check);
$result->execute();
?>