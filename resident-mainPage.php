<?php
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
            <div class="col-3">
                <div class="sidebar">
                    <a class="active" href="#home">My dues</a>
                    <a class="active" href="#home">Expenses</a>
                    <a href="#contact">Announcements</a>
                    <a href="#about">Log out</a>
                </div>
            </div>

            <div class="col-9">
                <!-- <h2>Dues history</h2>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10/2020</td>
                            <td>Paid</td>
                        </tr>
                        <tr>
                            <td>11/2020</td>
                            <td>Unpaid</td>
                        </tr>
                    </tbody>
                </table> -->
            </div>

        </div>
    </div>

</body>

</html>