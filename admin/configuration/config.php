<?php 
$server = "localhost";
$user = "root";
$password = "";
$dbname = "marketplace";

$conn = mysqli_connect($server, $user, $password, $dbname);

if(!$conn){
    echo mysqli_connect_error($conn);
};

?>