<?php

// function unistr_to_xnstr($str){
//     return preg_replace('/\\\u([a-z0-9]{4})/i', "&#x\\1;", $str);
// }

$id = $_GET['id'];
// $pw = $_GET['pw'];

$con=mysqli_connect("localhost","root","","mimamo");

if (mysqli_connect_errno($con))
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


mysqli_set_charset($con,"utf8");

$sql = "select pw from user where id = '{$id}'";

$res = mysqli_query($con, $sql);

$result = array();

while($row = mysqli_fetch_array($res)){
  echo $row[0];
  // array_push($result,
    // array('id'=>$row[0],'pw'=>$row[2],
    // ));
}


//
//
// $json = json_encode(array("result"=>$result));
// echo unistr_to_xnstr($json);
//
//
mysqli_close($con);

?>
