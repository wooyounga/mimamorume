<?php

function unistr_to_xnstr($str){
    return preg_replace('/\\\u([a-z0-9]{4})/i', "&#x\\1;", $str);
}

$con=mysqli_connect("localhost","root","mimamo123","mimamo");

if (mysqli_connect_errno($con))
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


mysqli_set_charset($con,"utf8");


$res = mysqli_query($con,"select * from user");

$result = array();

while($row = mysqli_fetch_array($res)){
  array_push($result,
    array('id'=>$row[0],'pw'=>$row[2],
    ));
}


$json = json_encode(array("result"=>$result));
echo unistr_to_xnstr($json);


mysqli_close($con);

?>
