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

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container-fluid {
            padding: 0px;
        }

        .sidebar {
            background: #A9A9A9;
            height: 100vh;
            position: sticky;
        }

        .sidebar a {
            display: flex;
            text-decoration: none;
            color: white;
            background: #696969;
            padding-bottom: 0.4rem;
            padding-top: 0.4rem;
        }

        .sidebar a:hover {
            background: white;
            color: #696969;
        }

        .sidebar a ul a {
            list-style-type: circle !important;
        }
    </style>

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php
                require "commonPHP/residentSidebar.php";
                
                $id = $_SESSION['id'];

                $sql = "SELECT * FROM resident, user WHERE resident.id='$id' AND user.residentID = resident.id";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

            ?>

            <div class="col-9 padding-0">
                <h2>Resident Profile</h2>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="<?php echo $row['username'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="block">Block</label>
                    <input type="text" class="form-control" id="block" placeholder="<?php echo $row['block'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="floor">Floor</label>
                    <input type="text" class="form-control" id="floor" placeholder="<?php echo $row['floor'] ?>" readonly>
                </div>

                <h2 class="mt-5">User Profile</h2>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="<?php echo $row['name'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="surname">Surname</label>
                    <input type="text" class="form-control" id="surname" placeholder="<?php echo $row['surname'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="birthDate">BirthDate</label>
                    <input type="text" class="form-control" id="birthDate" placeholder="<?php echo $row['birthDate'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="tel">Tel</label>
                    <input type="text" class="form-control" id="tel" placeholder="<?php echo $row['tel'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" class="form-control" id="email" placeholder="<?php echo $row['email'] ?>" readonly>
                </div>
            </div>

        </div>
    </div>

</body>

</html>