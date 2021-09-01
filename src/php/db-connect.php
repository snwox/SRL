<?php
    $HOST="localhost";
    $USER="urls_user";
    $PW="userpassword";
    $DBNAME="urls";
    $conn=mysqli_connect($HOST,$USER,$PW,$DBNAME);
    return $conn;
?>