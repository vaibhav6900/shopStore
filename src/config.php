<?php
// DB CONNECTION
$conn= new mysqli('localhost','root','','store');
if($conn->connect_error)
{
    echo $conn->connect_error;
}


?>