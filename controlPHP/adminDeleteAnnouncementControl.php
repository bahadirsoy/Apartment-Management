<?php
session_start();

require "../commonPHP/databaseConnection.php";

$id = $_GET['id'];

$sql = "DELETE FROM announcement WHERE id='$id'";
$result = $conn->query($sql);

if($result){
    header("Location: ../adminAnnouncements.php?result=deleted");
} else{
    header("Location: ../adminAnnouncements.php?result=error");
}