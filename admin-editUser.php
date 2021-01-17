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
                    <h2>Edit user</h2>

                    <?php 
                
                    if(isset($_GET['error'])){
                        if($_GET['error'] === "invalidChar"){
                        echo '<div class="alert alert-danger" role="alert">
                        Invalid charachters has been used
                        </div>';
                        } else if($_GET['error'] === "empty"){
                        echo '<div class="alert alert-danger" role="alert">
                        Empty input
                        </div>';
                        }  else if($_GET['error'] === "telLen"){
                        echo '<div class="alert alert-danger" role="alert">
                        Tel consists 11 digits 
                        </div>';
                        } else if($_GET['error'] === "username"){
                        echo '<div class="alert alert-danger" role="alert">
                        No such username 
                        </div>';
                        }
                    }

                    ?>

                    <form method="POST" action="controlPHP/editUserControl.php?id=<?php echo $_GET['id']; ?>">

                        <div class="form-group">
                            <label for="residentUsername">Resident username:</label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['residentUsername'])) echo $_GET['residentUsername'] ?>" name="residentUsername" id="residentUsername">
                        </div>

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['name'])) echo $_GET['name'] ?>" name="name" id="name">
                        </div>

                        <div class="form-group">
                            <label for="surname">Surname:</label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['surname'])) echo $_GET['surname'] ?>" name="surname" id="surname">
                        </div>

                        <div class="form-group">
                            <label for="birthDate">BirthDate:</label>
                            <input type="date" class="form-control" value="<?php if(isset($_GET['birthDate'])) echo $_GET['birthDate'] ?>" name="birthDate" id="birthDate">
                        </div>

                        <div class="form-group">
                            <label for="tel">Tel:</label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['tel'])) echo $_GET['tel'] ?>" name="tel" id="tel">
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['email'])) echo $_GET['email'] ?>" name="email" id="email">
                        </div>
                       
                        <button name="addResident" class="btn btn-success" type="submit">Edit user</button>
                    </form>
                </div>

                
            </div>
        </div>
    </div>
</body>

</html>