<?php
session_start();

//if (!isset($_POST['addResident'])) header("Location: ../index.php");

require "../commonPHP/databaseConnection.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$block = trim($_POST['block']);
$floor = trim($_POST['floor']);
$ownerTel = trim($_POST['ownerTel']);

if (!preg_match("/[A-Za-z0-9]+/", $username) && !preg_match("/[A-Za-z0-9]+/", $password)) {

    header("Location: ../admin-editResident.php?error=invalidChar&username=$username&block=$block&floor=$floor&ownerTel=$ownerTel");
    exit();
} else if (!isset($username) || !isset($password) || !isset($block) || !isset($floor) || $username === "" || $password === "" || $block === "" || $floor === "") {

    header("Location: ../admin-editResident.php?error=empty&username=$username&block=$block&floor=$floor&ownerTel=$ownerTel");
    exit();
} else {

    if (isset($ownerTel)) {
        $sql = "SELECT id FROM user WHERE tel='$ownerTel'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            if ($_GET['isMoved']==0) {

                $row = $result->fetch_assoc();
                $ownerID = $row['id'];
                $id = $_GET['id'];

                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE resident SET username='$username', password='$hashedPass', block='$block', floor='$floor', ownerID='$ownerID' WHERE id='$id'";

                if ($conn->query($sql)) {
                    header("Location: ../admin-residents.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            } else{
                $moveDate = $_POST['moveDate'];

                $row = $result->fetch_assoc();
                $ownerID = $row['id'];
                $id = $_GET['id'];

                $hashedPass = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE resident SET username='$username', password='$hashedPass', block='$block', floor='$floor', ownerID='$ownerID', moveDate='$moveDate' WHERE id='$id'";

                if ($conn->query($sql)) {
                    header("Location: ../admin-movedResidents.php?result=updated");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            }
        } else if ($result->num_rows === 0) {

            header("Location: ../admin-editResident.php?error=invalidTel&username=$username&block=$block&floor=$floor&ownerTel=$ownerTel");
            exit();
        }
    } else {
        $id = $_GET['id'];
        $sql = "UPDATE resident SET username='$username', password='$password', block='$block', floor='$floor' WHERE id='$id'";

        if ($conn->query($sql)) {
            header("Location: ../admin-residents.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}
