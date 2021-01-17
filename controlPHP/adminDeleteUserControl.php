<?php
session_start();

require "../commonPHP/databaseConnection.php";

$id = $_GET['id'];

$sql = "DELETE FROM user WHERE id='$id'";
$result = $conn->query($sql);

if($result){
    header("Location: ../admin-users.php?result=deleted");
} else{
    header("Location: ../admin-users.php?result=error");
}