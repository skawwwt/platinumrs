<?php

require '../../php/dbconnect.php';
session_start();

$function = $connection->real_escape_string($_POST['do']);

if($function == "1"){
    $sql = "SELECT * FROM vacancies ORDER BY vid ASC";
    $result = mysqli_query($connection, $sql);
    if ($result->num_rows > 0){
        $responseArray = array();
        while($array = mysqli_fetch_assoc($result)){
            $responseArray[] = $array;
        }

        echo json_encode($responseArray);
    } else {
        echo "2";
    }
} else if ($function == 2){
    $id = $connection->real_escape_string($_POST['id']);
    $sql = "SELECT * FROM members WHERE id='$id'";
    $result = mysqli_query($connection, $sql);
    if ($result->num_rows > 0){
        $responseArray = array();
        while($array = mysqli_fetch_assoc($result)){
            $responseArray[] = $array;
        }

        echo json_encode($responseArray);
    } else {
        echo "2";
    }
} else if ($function == 3){
  $id = $connection->real_escape_string($_POST['id']);
  $sql = "DELETE FROM vacancies WHERE vid = '$id'";
  if(!(mysqli_query($connection, $sql))){
    echo "2";
  } else {
    echo "1";
  }
} else if ($function == 4){
  $id = $connection->real_escape_string($_POST['id']);
  $sql = "SELECT * FROM vacancies WHERE vid = '$id'";
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
} else if ($function == 5){
  $id = $connection->real_escape_string($_POST['id']);
  $title = $connection->real_escape_string($_POST['title']);
  $description = $connection->real_escape_string($_POST['description']);
  $location = $connection->real_escape_string($_POST['location']);
  $vacEnd = $connection->real_escape_string($_POST['vacEnd']);
  $sql = "UPDATE vacancies SET title = '$title', description = '$description', location = '$location', updated = now(), vacEnd = '$vacEnd' WHERE vid = '$id'";
  if(!(mysqli_query($connection, $sql))){
    echo "2";
  } else {
    echo "1";
  }
} else if ($function == 6){
  $id = $connection->real_escape_string($_POST['id']);
  $sql = "DELETE FROM vacancies WHERE vid = '$id'";
  if(!(mysqli_query($connection, $sql))){
    echo "2";
  } else {
    echo "1";
  }
} else if ($function == 7){
  $title = $connection->real_escape_string($_POST['title']);
  $description = $connection->real_escape_string($_POST['description']);
  $location = $connection->real_escape_string($_POST['location']);
  $vacEnd = $connection->real_escape_string($_POST['vacEnd']);
  $id = $_SESSION['id'];
  $sql = "INSERT INTO vacancies (uid, title, description, location, published, updated, vacEnd) VALUES ('$id', '$title', '$description', '$location', now(), now(), '$vacEnd')";
  if(!(mysqli_query($connection, $sql))){
    echo "2";
  } else {
    echo "1";
  }
} else {
    echo "2";
}

?>
