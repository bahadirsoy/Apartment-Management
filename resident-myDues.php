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
            ?>

            <div class="col-9 padding-0">

                <div class="ml-4">
                    <span class="">
                        <input id="showAll" type="radio" name="show" class="form-check-input">
                        <label class="form-check-label" for="showAll">Show all</label>
                    </span>

                    <span class="ml-5">
                        <input id="showPaids" type="radio" name="show" class="form-check-input">
                        <label class="form-check-label" for="showPaids">Show paids only</label>
                    </span>

                    <span class="ml-5">
                        <input id="showNotPaids" type="radio" name="show" class="form-check-input">
                        <label class="form-check-label" for="showNotPaids">Show not paids only</label>
                    </span>
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Dues date</th>
                            <th scope="col">Paid</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                        <?php
                        $id = $_SESSION['id'];

                        $sql = "SELECT user.name, user.surname, dues.id, MONTH(dues.dueDate) AS month, YEAR(dues.dueDate) AS year, dues.isPaid FROM dues, resident, user WHERE dues.residentID = resident.id AND resident.id = user.id AND resident.id = $id";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            $isPaid;
                            if($row['isPaid']){
                                $isPaid = "Yes";
                            } else{
                                $isPaid = "No";
                            }

                            echo '
                            <tr>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['surname'].'</td>
                                <td>'.$row['month'].'-'.$row['year'].'</td>
                                <td>'.$isPaid.'</td>
                            </tr>
                            ';
                        }

                        ?>

                    </tbody>
                </table>



            </div>

        </div>
    </div>

</body>

<script>
    var checkBox1 = document.getElementById("showAll");
    var checkBox2 = document.getElementById("showPaids");
    var checkBox3 = document.getElementById("showNotPaids");

    checkBox1.addEventListener("change", (event) => {
        var tbody = document.querySelector("#tbody");
        var element = tbody.firstChild;
        while (element) {
            element = element.nextElementSibling;
            if (element.lastChild.previousElementSibling.innerHTML === "No") {
                element.style.display = "";
            } else {
                element.style.display = "";
            }
        }
    });

    checkBox2.addEventListener("change", (event) => {
        var tbody = document.querySelector("#tbody");
        var element = tbody.firstChild;
        while (element) {
            element = element.nextElementSibling;
            if (element.lastChild.previousElementSibling.innerHTML === "No") {
                element.style.display = "none";
            } else {
                element.style.display = "";
            }
        }
    });

    checkBox3.addEventListener("change", (event) => {
        var tbody = document.querySelector("#tbody");
        var element = tbody.firstChild;
        while (element) {
            element = element.nextElementSibling;
            if (element.lastChild.previousElementSibling.innerHTML === "No") {
                element.style.display = "";
            } else {
                element.style.display = "none";
            }
        }
    });
</script>

</html>