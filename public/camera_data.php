<?php
  $pdo = createPDO();

  $sql = "INSERT INTO camera_data VALUES ('{$_POST['Data1']}')";

  $st = $pdo->prepare($sql);
  $result = $st->execute();

  if($result)
    echo "1";
  else {
    echo "-1";
  }

  function createPDO(){
    $host = "localhost";
    $db = "mimamo";
    $user = "root";
    $pass = "";

    try{
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    }
    catch(Exception $e) {
        echo$e->getMessage();
    }

    return $pdo;
  }
?>
