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

    <style>
        html {
            overflow: auto;
        }
    </style>


</head>

<body>
    <div class="container-fluid padding-0">
        <div class="row">

            <?php require "commonPHP/residentSidebar.php" ?>

            <div class="col-9 padding-0 mt-5">



                <?php

                $sql = "SELECT * FROM announcement ORDER BY date DESC";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()) {
                    echo '
                    <div class="alert alert-info" role="alert">'.$row['detail'].'<span class="float-right mr-5 font-weight-bold">Announcement Date: '.$row['date'].'</div>
                    
                    ';
                }

                ?>
                
            </div>
        </div>
    </div>
</body>


</html>