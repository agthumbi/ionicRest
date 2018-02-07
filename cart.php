<?php

header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
$post = json_decode(file_get_contents("php://input"));



$id = $post->id;
$image = $post->image;

$name = $post->name;
$price = $post->price;
$qty = $post->qty;
$uid = $post->uid;
$conn = new PDO("mysql:host=localhost;dbname=makio", "root", "NELLYBELLY");
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$id = stripslashes($id);
$image = stripslashes($image);
$name = stripslashes($name);
$price = stripslashes($price);
$qty = stripslashes($qty);
$uid = stripslashes($uid);

//$id = mysql_real_escape_string($id);
//$image = mysql_real_escape_string($image);
//$name = mysql_real_escape_string($name);
//$price = mysql_real_escape_string($price);
//$qty = mysql_real_escape_string($qty);

if (!empty($uid)) {
    $check = "SELECT * FROM usercart WHERE uid = '$id' and eid='$uid'";

    $result = $conn->prepare($check);
    $result->execute();

    $data = $result->fetchAll(PDO::FETCH_ASSOC);

    if (count($data) > 0) {
        //$outp='{"result":{"created": "0" , "exists": "1" }';
        $outp['created'] = '0';
        $outp['exists'] = '1';
    } else {
        $sql = "INSERT INTO usercart VALUES ('$id', '$name', '$image', '$price','$qty','$uid'  )";
        $prepStmnt = $conn->prepare($sql);



        if ($prepStmnt->execute()) {
            //$outp='{"result":{"created": "1", "exists": 0" }';
            $outp['created'] = '1';
            $outp['exists'] = '0';
        }
    }
}
?>