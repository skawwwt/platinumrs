<?php

require 'dbconnect.php';

session_start();

$email = $connection->real_escape_string($_POST['email']);
$password = $connection->real_escape_string($_POST['password']);
$sql = "SELECT * FROM members WHERE email = '$email'";
$result = mysqli_query($connection, $sql);
$numrows = 0;

if($result->num_rows == 1){
    while($row = $result->fetch_assoc()){
        $id = $row['id'];
		$hash = $row['pword'];
		$firstname = $row['firstname'];
		$surname = $row['surname'];
        $email = $row['email'];
		$type = $row['type'];
		$status = $row['status'];
        $attempts = $row['attemptLog'];
        $busName = $row['busName'];

		if (password_verify($password, $hash)){
            if($status == "0"){
                echo 0;
            } else if ($status == "1"){
                $_SESSION['id'] = $id;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['surname'] = $surname;
                $_SESSION['email'] = $email;
                $_SESSION['type'] = $type;
                $_SESSION['status'] = $status;
                $_SESSION['busName'] = $busName;
                $sql = "UPDATE members SET attemptLog = '0', lastLogin = now() WHERE email ='$email'";
                mysqli_query($connection, $sql);
            if($type == "Admin"){
                echo 1;
            } else if ($type == "Internal"){
                echo 2;
            } else if ($type == "External"){
                echo 3;
            }
            } else if ($status == "2"){
                $attempts = $attempts + 1;
                $sql = "UPDATE members SET attemptLog = '$attempts' WHERE email = '$email'";
                mysqli_query($connection, $sql);
                echo 102;
            }
            
		} else {
			$attempts = $attempts + 1;
            $sql = "UPDATE members SET attemptLog = '$attempts' WHERE email = '$email'";
            mysqli_query($connection, $sql);
            if ($attempts >= 5){
                $sql = "UPDATE members SET status = '2' WHERE email = '$email'";
                mysqli_query($connection, $sql);
                echo 102;
            } else {
                echo 101; 
            }
            
		};
	}
} else {
    echo 100;
}

?>