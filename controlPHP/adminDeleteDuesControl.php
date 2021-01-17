<?php
session_start();

require "../commonPHP/databaseConnection.php";

$id = $_GET['id'];

$sql = "DELETE FROM dues WHERE id='$id'";
$result = $conn->query($sql);

if($result){
    header("Location: ../admin-dues.php?result=deleted");
} else{
    header("Location: ../admin-dues.php?result=error");
}