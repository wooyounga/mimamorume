<?php
  header('Content-type: application/json; charset=utf-8');

  $pdo = createPDO();

  if($_GET['mode'] == "sido"){
    $sql = "SELECT DISTINCT sido FROM address_data";

    $stt = $pdo->prepare($sql);
    $stt->execute();
    $data = $stt->fetchAll();

    foreach ($data as $key) {
      $array_data[] = $key['sido'];
    }

    echo $_GET['callback']."(".json_encode($array_data).")";
  }
  else if($_GET['mode'] == "gugun"){
    $sido = $_GET['index'];
    $sql = "SELECT DISTINCT gugun FROM address_data WHERE sido = '$sido'";

    $stt = $pdo->prepare($sql);
    $stt->execute();
    $data = $stt->fetchAll();

    foreach ($data as $key) {
      $array_data[] = $key['gugun'];
    }

    echo $_GET['callback']."(".json_encode($array_data).")";
  }
  else if($_GET['mode'] == "dong"){
    $sido = $_GET['index1'];
    $gugun = $_GET['index2'];
    $sql = "SELECT DISTINCT dong FROM address_data
    WHERE sido = '$sido' AND gugun = '$gugun'";

    $stt = $pdo->prepare($sql);
    $stt->execute();
    $data = $stt->fetchAll();

    foreach ($data as $key) {
      $array_data[] = $key['dong'];
    }

    echo $_GET['callback']."(".json_encode($array_data).")";
  }

  function createPDO(){
    $hostname = "localhost";
    $dbname = "mimamo";
    $user = "root";
    $pass = "";

    try{
      $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $user, $pass);

      return $pdo;
    }catch(Exception $e){
      print $e;
    }
  }
?>
