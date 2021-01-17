<?php

if(!isset($_POST['submitButton'])) header("Location: ../index.php");

require "../commonPHP/databaseConnection.php";

$username=trim($_POST['username']);
$password=trim($_POST['password']);

if (!isset($username) || !isset($password) || $username==="" || $password==="") {

  header("Location: ../index.php?error=empty&username=".$username);
  exit();

}else if(!preg_match('/^[a-z0-9 .\-]+$/i', $username)){

  header("Location: ../index.php?error=invalidChar&username=".$username);
  exit();

} else{

  // prepare and bind
  $stmt = $conn->prepare("SELECT * FROM resident WHERE username = ?");
  $stmt->bind_param("s", $username);

  // set parameters and execute
  $username=trim($_POST['username']);
  $password=trim($_POST['password']);

  //execute sql
  $stmt->execute();
  $result = $stmt->get_result();
  $row=$result->fetch_assoc();
  
  if($result->num_rows === 0 || !password_verify($password, $row['password'])){
    header("Location: ../index.php?error=invalidInfo&username=".$username);
    exit();
  }else if($result->num_rows === 1 && password_verify($password, $row['password'])){
    
    //Valid info start session
    session_start();
    //$row=$result->fetch_assoc();
    $_SESSION['id']=$row['id'];
    $_SESSION['username']=$row['username'];
    $_SESSION['password']=$row['password'];
    $_SESSION['block']=$row['block'];
    $_SESSION['floor']=$row['floor'];
    $_SESSION['ownerID']=$row['ownerID'];
    $_SESSION['isAdmin']=$row['isAdmin'];

    if($_SESSION['isAdmin'] === 0) header("Location: ../resident-myDues.php");
    if($_SESSION['isAdmin'] === 1) header("Location: ../admin-residents.php");
  } else{
    echo $result->num_rows." rows";
  }

  //close
  $stmt->close();
  $conn->close();
}

