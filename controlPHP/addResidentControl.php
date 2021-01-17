<?php
session_start();

if (!isset($_POST['addResident'])) header("Location: ../index.php");

require "../commonPHP/databaseConnection.php";

$username = trim($_POST['username']);
$password = trim($_POST['password']);
$block = trim($_POST['block']);
$floor = trim($_POST['floor']);

if (!isset($username) || !isset($password) || !isset($block) || !isset($floor) || $username === "" || $password === "" || $block === "" || $floor === "") {

  header("Location: ../admin-addResident.php?error=empty&username=$username&block=$block&floor=$floor");
  exit();
} else if (!preg_match("/[A-Za-z0-9]+/", $username) && !preg_match("/[A-Za-z0-9]+/", $password) && !preg_match("/[A-Za-z0-9]+/", $block) && !preg_match("/[A-Za-z0-9]+/", $floor)) {

  header("Location: ../admin-addResident.php?error=invalidChar&username=$username&block=$block&floor=$floor");
  exit();
} else if (strlen($username) < 5 || strlen($username) > 15 || strlen($password) < 5 || strlen($password) > 15) {

  header("Location: ../admin-addResident.php?error=invalidLen&username=$username&block=$block&floor=$floor");
  exit();
} else if (strlen($block) > 2) {

  header("Location: ../admin-addResident.php?error=invalidBlock&username=$username&block=$block&floor=$floor");
  exit();
} else {

  $sql = "SELECT * FROM resident WHERE username='$username'";
  $result = $conn->query($sql);
  
  if ($result->num_rows > 0) {
    header("Location: ../admin-addResident.php?error=usernameExist&username=$username&block=$block&floor=$floor");
    exit();
  } elseif ($result->num_rows === 0) {
    $hashedPass=password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `resident` (`id`, `username`, `password`, `block`, `floor`, `ownerID`, `isAdmin`) VALUES (NULL, '$username', '$hashedPass', '$block', $floor, NULL, 0)";

    if ($conn->query($sql)) {
      header("Location: ../admin-residents.php");
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  }
}
