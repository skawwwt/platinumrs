<?php

require '../../php/dbconnect.php';

$sql = "SELECT * FROM members ORDER BY firstname ASC";
$result = mysqli_query($connection, $sql);

if($result->num_rows >0){
    $responseArray = array();
    while($array = mysqli_fetch_assoc($result)){
        $responseArray[] = $array;
    }
    
    echo json_encode($responseArray);
} else {
    echo "Users Found";
}



?>