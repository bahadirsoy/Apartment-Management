<?php
session_start();

//if (!isset($_POST['addResident'])) header("Location: ../index.php");

require "../commonPHP/databaseConnection.php";

$residentUsername = trim($_POST['residentUsername']);
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$birthDate = trim($_POST['birthDate']);
$tel = trim($_POST['tel']);
$email = trim($_POST['email']);

if (!preg_match("/[A-Za-z0-9]+/", $residentUsername) && !preg_match("/[A-Za-z0-9]+/", $name) && !preg_match("/[A-Za-z0-9]+/", $surname)) {

    header("Location: ../admin-editUser.php?error=invalidChar&residentUsername=$residentUsername&name=$name&surname=$surname&tel=$tel&email=$email");
    exit();
} else if (!isset($residentUsername) || !isset($name) || !isset($surname) || !isset($tel) || $residentUsername === "" || $name === "" || $surname === "" || $tel === "") {

    header("Location: ../admin-editUser.php?error=empty&residentUsername=$residentUsername&name=$name&surname=$surname&tel=$tel&email=$email");
    exit();
}else if(strlen($tel)!=11){

    header("Location: ../admin-editUser.php?error=telLen&residentUsername=$residentUsername&name=$name&surname=$surname&tel=$tel&email=$email");
    exit();
} else {

        $sql = "SELECT id FROM resident WHERE username='$residentUsername'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $residentID = $row['id'];
            $id = $_GET['id'];
            
            $sql = "UPDATE user SET residentID='$residentID' ,name='$name', surname='$surname', birthDate='$birthDate', tel='$tel', email='$email' WHERE id='$id'";
            
            if ($conn->query($sql)) {
                header("Location: ../admin-users.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else if($result->num_rows === 0){

            header("Location: ../admin-editUser.php?error=username&residentUsername=$residentUsername&name=$name&surname=$surname&tel=$tel&email=$email");
            exit();
        }
   
}
