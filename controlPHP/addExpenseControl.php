<?php
session_start();

//if (!isset($_POST['addResident'])) header("Location: ../index.php");

require "../commonPHP/databaseConnection.php";

$topic = $_POST['topic'];
$details = $_POST['details'];
$price = $_POST['price'];
$month = $_POST['month'];
$year = $_POST['year'];

if(!isset($topic) || !isset($details) || !isset($price) || $topic === "" || $details === "" || $price === "" || strlen($topic)<1 || strlen($details)<1 || strlen($price)<1){

    header("Location: ../admin-expenses.php?result=emptyBlank");
    exit();
}

$sql = "INSERT INTO `expense` (`id`, `topic`, `detail`, `price`, `expenseDate`) VALUES (NULL, '$topic', '$details', '$price', '$year-$month-01')";
$result = $conn->query($sql);

if($result){
    header("Location: ../admin-expenses.php?result=ok");
} else{
    header("Location: ../admin-expenses.php?result=error");
}