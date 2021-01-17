<?php

    if(!isset($_SESSION['username'])){
        header("Location: ../index.php");
    }

?>

<style>
body{
    overflow-y: auto !important;
    overflow-x: hidden !important;
}
</style>

<div class="col-3">
    <div class="sidebar">
        <a class="justify-content-center" style="background: black;"><?php echo "Welcome ".$_SESSION['username'] ?></a>
        <a class="active" href="../ApartmentManager/admin-residents.php">Residents</a>
        <a class="active" href="../ApartmentManager/admin-movedResidents.php">Moved residents</a>
        <a class="active" href="../ApartmentManager/admin-users.php">Users</a>
        <a class="active" href="../ApartmentManager/admin-movedUsers.php">Moved users</a>
        <a class="active" href="../ApartmentManager/admin-addResident.php">Add resident</a>
        <a class="active" href="../ApartmentManager/admin-addUser.php">Add user</a>
        <a class="active" href="../ApartmentManager/admin-dues.php">Dues</a>
        <a class="active" href="../ApartmentManager/admin-expenses.php">Expenses</a>
        <a class="active" href="../ApartmentManager/adminAnnouncements.php">Announcements</a>
        <a href="./controlPHP/logoutControl.php" name="logoutButton"> Logout </a>
    </div>
</div>