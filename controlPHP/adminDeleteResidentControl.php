<?php
session_start();

require "../commonPHP/databaseConnection.php";

$id = $_GET['id'];

$sql = "DELETE FROM dues WHERE residentID = '$id'";
$result = $conn->query($sql);

$sql = "DELETE FROM user WHERE residentID = '$id'";
$result = $conn->query($sql);

if($result){
    $sql = "DELETE FROM resident WHERE id = '$id'";
    $result = $conn->query($sql);

if($result){
    header("Location: ../admin-movedResidents.php?result=deleted");
} else{
    header("Location: ../admin-movedResidents.php?result=error");
}
} else{
    header("Location: ../admin-movedResidents.php?result=error");
}





