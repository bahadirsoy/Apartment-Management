<?php

    require "commonPHP/databaseConnection.php";
    session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!--Meta-->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous" />

    <!--Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />

    <!--Title-->
    <title>Index</title>

    <!--Common CSS-->
    <link rel="stylesheet" href="commonCSS/sidebar.css" />


</head>

<body>
    <div class="container-fluid padding-0">
        <div class="row">
            
        <?php require "commonPHP/adminSidebar.php" ?>

            <div class="col-9 padding-0">
                
                <div class="container">
                    <h2>Add user</h2>
                    <form method="POST" action="controlPHP/addUserControl.php">

                    <?php 
              
                    if(isset($_GET['error'])){
                        if($_GET['error'] === "empty"){
                        echo '<div class="alert alert-danger" role="alert">
                        Please fill all blanks
                        </div>';
                        } else if($_GET['error'] === "invalidResidentUsername"){
                        echo '<div class="alert alert-danger" role="alert">
                        Resident username is incorrect
                        </div>';
                        } else if($_GET['error'] === "invalidTel"){
                        echo '<div class="alert alert-danger" role="alert">
                        Please enter valid tel (Tel number contains 11 numbers)
                        </div>';
                        } 
                    }

              ?>

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($_GET['name'])) echo $_GET['name']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="surname">Surname:</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="<?php if(isset($_GET['surname'])) echo $_GET['surname']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="birthdate">Birthdate:</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate">
                        </div>
                        <div class="form-group">
                            <label for="tel">Tel:</label>
                            <input type="text" class="form-control" id="tel" name="tel" value="<?php if(isset($_GET['tel'])) echo $_GET['tel']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_GET['email'])) echo $_GET['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="residentUsername">Resident username:</label>
                            <input type="text" class="form-control" id="residentUsername" name="residentUsername" value="<?php if(isset($_GET['residentUsername'])) echo $_GET['residentUsername']; ?>">
                        </div>
                        <button name="addResident" class="btn btn-success" type="submit">Add user</button>
                    </form>
                </div>

                
            </div>
        </div>
    </div>
</body>

</html>