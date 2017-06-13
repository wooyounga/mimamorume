<?php
//  echo $_POST['Data1'];
//  $judge = null;
//
//  $sql = "INSERT INTO camera_data VALUES ('{$_POST['Data1']}')";
//
//  $st = $pdo->prepare($sql);
//  $result = $st->execute();
//
//  if($result)
//    echo "1";
//  else {
//    echo "-1";
//  }
//
//  function createPDO(){
//    $host = "localhost";
//    $db = "mimamo";
//    $user = "root";
//    $pass = "";
//
//    try{
//        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
//    }
//    catch(Exception $e) {
//        echo$e->getMessage();
//    }
//
//    return $pdo;
//  }

  error_reporting(E_ALL);

  $address = "210.101.247.125"; // 접속할 IP //
  $port = 5007; // 접속할 PORT //
  $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP); // TCP 통신용 소켓 생성 //
  if ($socket === false) {
      echo "socket_create() 실패! 이유: " . socket_strerror(socket_last_error()) . "\n";
  } else {
      echo "socket 성공적으로 생성.\n";
  }

  $result = socket_connect($socket, $address, $port); // 소켓 연결 및 $result에 접속값 지정 //
  if ($result === false) {
      echo "socket_connect() 실패.\nReason: ($result) " . socket_strerror(socket_last_error($socket)) . "\n";
  } else {
      echo "다음 주소로 연결 성공 : $address.\n";
  }
  $i = "clicked"; //보내고자 하는 전문 //

  socket_write($socket, $i, strlen($i)); // 실제로 소켓으로 보내는 명령어 //
  $input = socket_read($socket, 1024) or die("Could not read from Socket\n");

  echo $input; //REQUEST 정보 출력//
  socket_close($socket);
?>
