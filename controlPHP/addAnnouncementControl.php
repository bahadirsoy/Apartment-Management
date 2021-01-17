<?php
session_start();

//if (!isset($_POST['addResident'])) header("Location: ../index.php");

require "../commonPHP/databaseConnection.php";

$detail = $_POST['detail'];

if(!isset($detail) || $detail === "" || strlen($detail)<1){

    header("Location: ../adminAnnouncements.php?result=emptyBlank");
    exit();
}

$sql = "INSERT INTO `announcement` (`detail`) VALUES ('$detail')";
//exit($sql);
$result = $conn->query($sql);

if($result){
    header("Location: ../adminAnnouncements.php?result=ok");
} else{
    header("Location: ../adminAnnouncements.php?result=error");
}