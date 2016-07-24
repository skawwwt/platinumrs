<?php

include '../../php/dbconnect.php';

session_start();

$function = $connection->real_escape_string($_POST['do']);

 if($function == 1){
   $sql = "SELECT * FROM news ORDER BY published DESC";
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

 } else if($function == 2){
   $uid = $connection->real_escape_string($_POST['uid']);
   $sql = "SELECT * FROM members WHERE id = '$uid'";
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
   $id = $connection->real_escape_string($_POST['id']);
   $sql = "SELECT * FROM news WHERE nid = '$id'";
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
 } else if ($function == 4){
   $id = $connection->real_escape_string($_POST['id']);
   $sql = "DELETE FROM news WHERE nid = '$id'";
   if(!(mysqli_query($connection, $sql))){
     echo "2";
   } else {
     echo "1";
   }
 } else if ($function == 5){
   $title = $connection->real_escape_string($_POST['title']);
   $content = $connection->real_escape_string($_POST['content']);
   $id = $_SESSION['id'];
   $sql = "INSERT INTO news (uid, title, content, published) VALUES ('$id', '$title', '$content', now())";
   if(!(mysqli_query($connection, $sql))){
     echo "2";
   } else {
     echo "1";
   }
 } else if ($function == 6){
   $title = $connection->real_escape_string($_POST['title']);
   $content = $connection->real_escape_string($_POST['content']);
   $nid = $connection->real_escape_string($_POST['nid']);
   $sql = "UPDATE news SET title = '$title', content = '$content' WHERE nid = '$nid'";
   if(!(mysqli_query($connection, $sql))){
     echo "2";
   } else {
     echo "1";
   }
 } else {
   echo "2";
 }

 ?>
