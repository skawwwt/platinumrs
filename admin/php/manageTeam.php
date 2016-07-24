<?php

require '../../php/dbconnect.php';

$function = $connection->real_escape_string($_POST['do']);

if($function == 1){
  $sql = "SELECT * FROM team ORDER BY uid ASC";
  $result = mysqli_query($connection, $sql);
  if($result->num_rows > 0){
    $responseArray = array();
    while($array = mysqli_fetch_assoc($result)){
        $responseArray[] = $array;
    }

    echo json_encode($responseArray);
  } else {
    echo "2";
  }
} else if ($function ==2){
  $uid = $connection->real_escape_string($_POST['uid']);
  $sql = "SELECT * FROM team WHERE uid = '$uid'";
  $result = mysqli_query($connection, $sql);
  if($result->num_rows > 0){
    $responseArray = array();
    while($array = mysqli_fetch_assoc($result)){
        $responseArray[] = $array;
    }

    echo json_encode($responseArray);
  } else {
    echo "2";
  }
} else if ($function == 3){
  $uid = $connection->real_escape_string($_POST['uid']);
  $caption = $connection->real_escape_string($_POST['caption']);
  $phone = $connection->real_escape_string($_POST['phone']);
  $published = $connection->real_escape_string($_POST['pubStat']);
  $sql = "UPDATE team SET caption = '$caption', phone = '$phone', published = '$published' WHERE uid = '$uid'";
  $result = mysqli_query($connection, $sql);
  if (!($result)){
    echo 2;
  } else {
    echo 1;
  }
} else {
  echo "2";
}

 ?>
