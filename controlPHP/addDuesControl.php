<?php
session_start();

//if (!isset($_POST['addResident'])) header("Location: ../index.php");

require "../commonPHP/databaseConnection.php";

$residentUsername = trim($_POST['residentUsername']);
$month = trim($_POST['month']);
$year = trim($_POST['year']);
$paid = trim($_POST['paid']);

$sql = "SELECT * FROM resident, dues WHERE resident.id = dues.residentID AND dues.dueDate = '$year-$month-01' AND resident.username = '$residentUsername'";
$result = $conn->query($sql);

if(mysqli_num_rows($result) != 0){
    $row = $result->fetch_assoc();
    $id = $row['id'];

    $sql = "UPDATE dues SET isPaid = '$paid' WHERE id = '$id'";
    $result = $conn->query($sql);
    
    if($result){
        header("Location: ../admin-dues.php?result=updated");
    } else{
        echo "error";
    }

} else if(mysqli_num_rows($result) == 0){
    $sql = "SELECT * FROM resident WHERE resident.username = '$residentUsername'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $residentID = $row['id'];

    $sql = "INSERT INTO `dues` (`id`, `residentID`, `dueDate`, `isPaid`) VALUES (NULL, '$residentID', '$year-$month-01', '$paid')";
    //exit($sql);
    $result = $conn->query($sql);

    if($result){
        header("Location: ../admin-dues.php?result=inserted");
    } else{
        echo "sql error";
    }

} else{
    echo "error iasdasd";
}
