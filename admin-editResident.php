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
                    <h2>Edit resident</h2>

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
                        }  else if($_GET['error'] === "invalidTel"){
                        echo '<div class="alert alert-danger" role="alert">
                        No such tel
                        </div>';
                        }
                    }

                    ?>

                    <form method="POST" action="controlPHP/editResidentControl.php?id=<?php echo $_GET['id']; ?>&isMoved=<?php echo $_GET['isMoved'] ?>">

                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['username'])) echo $_GET['username'] ?>" name="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" value="<?php if(isset($_GET['password'])) echo $_GET['password'] ?>" name="password">
                        </div>
                        <div class="form-group">
                            <label for="block">Block:</label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['block'])) echo $_GET['block'] ?>" name="block">
                        </div>
                        <div class="form-group">
                            <label for="floor">Floor:</label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['floor'])) echo $_GET['floor'] ?>" name="floor">
                        </div>
                        <div class="form-group">
                            <label for="ownerTel">Owner Tel:</label>
                            <input type="text" class="form-control" value="<?php if(isset($_GET['ownerTel'])) echo $_GET['ownerTel'] ?>" name="ownerTel">
                        </div>
                        <?php
                        if(isset($_GET['isMoved'])){
                            if($_GET['isMoved']==1){
                                $moveDate = $_GET['moveDate'];
    
                                echo '
                                <div class="form-group">
                                    <label for="moveDate">Move date:</label>
                                    <input type="date" class="form-control" value="'.$moveDate.'" name="moveDate">
                                </div>
                                ';
                            }
                        }
                        ?>
                        <input value="Edit resident" name="addResident" class="btn btn-success" type="submit"></input>
                    </form>
                </div>

                
            </div>
        </div>
    </div>
</body>

</html>