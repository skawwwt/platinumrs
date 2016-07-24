<?php

session_start();

if ($_SESSION['type'] == "Admin"){
    echo 1;
} else {
    echo 2;
}

?>