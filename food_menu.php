<?php

session_start();
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//$conn = new mysqli("localhost", "username", "password", "database");
$conn = new PDO("mysql:host=localhost;dbname=makio", "root", "NELLYBELLY");
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


if (!isset($_GET['query'])) {

    $quer = "SELECT p_id,p_name,p_description,p_image_id,p_price,ptype FROM products where p_available=1 ";
} else {

    $quer = $_GET['query'] . " ";
}




//var_dump($_GET);exit;
if (isset($_GET["categorytype"]) && !empty($_GET["categorytype"])) {

    $cat = $_GET["categorytype"];
    $cat = stripslashes($cat);
    //$cat = $conn->real_escape_string($cat);
    $quer = $quer . "and p_categorytype like " . $cat . " ";
}
$query = $quer;



if (isset($_GET["category"]) && !empty($_GET["category"])) {

    $cat = $_GET["category"];
    $cat = stripslashes($cat);
	$p_category=explode('||',$cat);
	$p_c="";
	foreach($p_category as $p_cat){
		if($p_c!='')
			$p_c.=' or ';
		$p_c.=" p_category ='".$p_cat."'";
	}

    //$cat = $conn->real_escape_string($cat);
    $quer = $quer . " and ".$p_c;
}

if (isset($_GET["sort"]) && !empty($_GET["sort"])) {

    $s = $_GET["sort"];
    if ($s == "n") {
        $quer .= "order by p_name";
    } else if ($s == "plh") {
        $quer .= "order by p_price";
    } else if ($s == "phl") {
        $quer .= "order by p_price desc";
    }
}




//$result = $conn->query($query);

$result = $conn->prepare($quer );
$result->execute();

$results = $result->fetchAll(PDO::FETCH_ASSOC);


$outp = "";
for ($i = 0; $i < count($results); $i++) {
    $rs = $results[$i];
    if ($outp != "") {
        $outp .= ",";
    }

    $outp .= '{"p_id":"' . $rs["p_id"] . '",';
    $outp .= '"p_name":"' . $rs["p_name"] . '",';
    $outp .= '"p_description":"' . $rs["p_description"] . '",';
    $outp .= '"p_image_id":"' . $rs["p_image_id"] . '",';
    $outp .= '"p_price":"' . $rs["p_price"] . '"}';
    $ptyep[$rs["ptype"]] = $rs["ptype"];
    // $ptyep .= '{"id":"' . $rs["ptype"] . '",name:"'.$rs["ptype"].'"}';
}
$ct = 1;
$ptype = "";
foreach ($ptyep as $pt) {
    if ($ptype != "") {
        $ptype .= ",";
    }
    $ptype .= '{"id":"' . $pt . '","name":"' . $pt . '"}';
}

/* while($rs = $result->fetch_array(MYSQLI_ASSOC)) {
  if ($outp != "") {$outp .= ",";}
  $outp .= '{"p_id":"'  . $rs["p_id"] . '",';
  $outp .= '"p_name":"'   . $rs["p_name"]        . '",';
  $outp .= '"p_description":"'   . $rs["p_description"]        . '",';
  $outp .= '"p_image_id":"'   . $rs["p_image_id"]        . '",';
  $outp .= '"p_price":"'. $rs["p_price"]     . '"}';
  } */
$outp = '{"query":"' . $query . '","quer":"' . $quer . '","records":[' . $outp . '],"ptype":[' . $ptype . ']}';
//$conn->close();

echo($outp);
?> 