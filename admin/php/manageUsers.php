<?php

require '../../php/dbconnect.php';

$id = $connection->real_escape_string($_POST['id']);
$function = $connection->real_escape_string($_POST['do']);

if($function == 1){
    $sql = "DELETE FROM members WHERE id = '$id'";
    mysqli_query($connection, $sql);
    echo "1";
} else if ($function == 2){
    $sql = "UPDATE members SET status = '2' WHERE id = '$id'";
    mysqli_query($connection, $sql);
    echo "1";
} else if ($function == 3){
    $sql = "UPDATE members SET status = '1', attemptLog = '0' WHERE id = '$id'";
    mysqli_query($connection, $sql);
    echo "1";
} else if ($function == 4){
    $sql = "SELECT * FROM members WHERE id = '$id'";
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
    $firstname = $connection->real_escape_string($_POST['firstname']);
    $surname = $connection->real_escape_string($_POST['surname']);
    $email = $connection->real_escape_string($_POST['email']);
    $type = $connection->real_escape_string($_POST['type']);
    $busname = $connection->real_escape_string($_POST['busname']);

    $sql = "UPDATE members SET firstname = '$firstname', surname = '$surname', email = '$email', type = '$type', busName = '$busname' WHERE id = '$id'";
    if(!(mysqli_query($connection, $sql))){
        echo "2";
    } else {
        echo "1";
    }
} else if ($function == 6){
    $firstname = $connection->real_escape_string($_POST['firstname']);
    $surname = $connection->real_escape_string($_POST['surname']);
    $email = $connection->real_escape_string($_POST['email']);
    $type = $connection->real_escape_string($_POST['type']);
    $busname = $connection->real_escape_string($_POST['busname']);
    $pCode = randomStr();

    $sql = "INSERT INTO members (firstname, surname, email, pword, type, status, attemptLog, pCode, busName, lastLogin) VALUES ('$firstname', '$surname', '$email', 'nohash', '$type', '0', '0', '$pCode', '$busname', now())";
    if(!(mysqli_query($connection, $sql))){
        echo "2";
    } else {
        //implement code to create team row in db if user is internal or admin

        //implement code to send email verification for new user to use to set password using pCode
        echo "1";
    }


} else if ($function == 7){
  $email = $connection->real_escape_string($_POST['email']);
  $sql = "SELECT id FROM members WHERE email ='$email' LIMIT 1";
  $result = mysqli_query($connection, $sql);
  if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
      $uid = $row["id"];
    }
    $sql = "INSERT INTO team (uid, caption, phone, picture, published) VALUES ('$uid', '', '', 'default.jpg', '0')";
    if(!(mysqli_query($connection, $sql))){
      echo "2";
    } else {
      echo "1";
    }
  } else {
    echo "2";
  }
} else {
    echo "2";
}


function randomStr(){
    $bytes = openssl_random_pseudo_bytes(4, $cstrong);
    $hex   = bin2hex($bytes);

    return $hex;
}


?>
