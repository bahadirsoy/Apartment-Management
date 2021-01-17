<?php
session_start();

//if (!isset($_POST['addResident'])) header("Location: ../index.php");

require "../commonPHP/databaseConnection.php";

$id = $_GET['id'];

$sql = "UPDATE resident SET isMoved=0, moveDate=NULL WHERE id='$id'";
//exit($sql);
$result = $conn->query($sql);

if($result){
    header("Location: ../admin-residents.php?result=recovered");
} else{
    header("Location: ../admin-resident.php?result=error");
}