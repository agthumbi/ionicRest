<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$data = array();



//$conn = new mysqli("localhost", "username", "password", "database");
$conn = new PDO("mysql:host=localhost;dbname=makio", "root", "NELLYBELLY");
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$eid = $_GET["userid"];
//$password=$_GET["p"];
//$password=md5($password);
// To protect MySQL injection for Security purpose
//$username = stripslashes($username);
//$password = stripslashes($password);
//$username = $conn->real_escape_string($username);
//$password = $conn->real_escape_string($password);


$query = "SELECT *  from  usercart where eid='$eid'";
//$result = $conn->query($query);
$result = $conn->prepare($query);
$result->execute();

// $data=  $result->fetchAll(PDO::FETCH_ASSOC);
// var_dump($data);exit;
$outp = "";

if ($rs = $result->fetchAll(PDO::FETCH_ASSOC)) {
    if ($outp != "") {
        $outp .= ",";
    }
    for ($i = 0; $i < count($rs); $i++) {
        $outp['id'] = $rs[$i]["uid"];
        $outp['image'] = $rs[$i]["image"];
        $outp['name'] = $rs[$i]["name"];
        $outp['price'] = $rs[$i]["price"];
        $outp['qty'] = $rs[$i]["qty"];
        $outpa[] = $outp;
    }
    $data['records'] = $outpa;
}

//$conn->close();

echo json_encode($data);
?> 