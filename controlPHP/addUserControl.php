<?php
session_start();

if (!isset($_POST['addResident'])) header("Location: ../index.php");

require "../commonPHP/databaseConnection.php";

$name = mysqli_real_escape_string($conn, trim($_POST['name']));
$surname = mysqli_real_escape_string($conn, trim($_POST['surname']));
$birthdate = mysqli_real_escape_string($conn, trim($_POST['birthdate']));
$tel = mysqli_real_escape_string($conn, trim($_POST['tel']));
$email = mysqli_real_escape_string($conn, trim($_POST['email']));
$residentUsername = mysqli_real_escape_string($conn, trim($_POST['residentUsername']));

if(!isset($name) || !isset($surname) || !isset($tel) || !isset($email) || !isset($residentUsername) || $name === "" || $surname === "" || $tel === "" || $email === "" || $residentUsername === ""){
    header("Location: ../admin-addUser.php?error=empty&name=$name&surname=$surname&tel=$tel&email=$email&residentUsername=$residentUsername");
    exit();
} elseif(!preg_match('/^[0-9]*$/', $tel) && strlen($tel)!==11){
    header("Location: ../admin-addUser.php?error=invalidTel&name=$name&surname=$surname&tel=$tel&email=$email&residentUsername=$residentUsername");
    exit();
}


$sql = "SELECT id FROM resident WHERE username='$residentUsername'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $residentID = $row['id'];

    $sql = "INSERT INTO `user` (`id`, `residentID`, `name`, `surname`, `birthdate`, `tel`, `email`) VALUES (NULL, '$residentID', '$name', '$surname', '$birthdate', '$tel', '$email')";

    if ($conn->query($sql)) {
        header("Location: ../admin-users.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} else {
    header("Location: ../admin-addUser.php?error=invalidResidentUsername&name=$name&surname=$surname&tel=$tel&email=$email&residentUsername=$residentUsername");
    exit();
}
