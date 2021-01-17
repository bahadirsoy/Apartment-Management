<?php
session_start();

require "../commonPHP/databaseConnection.php";

$id = $_GET['id'];

$sql = "DELETE FROM expense WHERE id='$id'";
$result = $conn->query($sql);

if($result){
    header("Location: ../admin-expenses.php?result=deleted");
} else{
    header("Location: ../admin-expenses.php?result=error");
}