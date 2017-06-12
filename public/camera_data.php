<?php
  header("Content-Type: text/html;charset=UTF-8");
  $conn = mysqli_connect("localhost","root","mimamo123","mimamo");
  $data_stream = "'".$_POST['Data1']."'";
  $query = "insert into gps(data) values (".$data_stream.")";
  $result = mysqli_query($conn, $query);

  if($result)
    echo "1";
  else {
    echo "-1";
  }

  mysqli_close($conn);
?>
