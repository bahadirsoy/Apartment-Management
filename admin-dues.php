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

                <div class="my-3">
                    <label class="form-check-label" for="search">Search by name</label>
                    <input id="search" type="text" name="search" class="form-control">
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Due date</th>
                            <th scope="col">Paid</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                        <?php

                        $sql = "SELECT user.name, user.surname, dues.id, MONTH(dues.dueDate) AS month, YEAR(dues.dueDate) AS year, dues.isPaid FROM dues, resident, user WHERE dues.residentID = resident.id AND resident.ownerID = user.id ORDER BY dues.dueDate DESC";
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
                                <td>'.'<a class="btn btn-danger" href="controlPHP/adminDeleteDuesControl.php?id='.$row['id'].'">Delete</a>'.'</td>
                            </tr>
                            ';
                        }

                        ?>

                    </tbody>
                </table>

                <div class="container mt-5">

                    <?php 
                
                    if(isset($_GET['result'])){
                        if($_GET['result'] === "updated"){
                        echo '<div class="alert alert-info" role="alert">
                        Dues updated successefully
                        </div>';
                        } else if($_GET['result'] === "inserted"){
                        echo '<div class="alert alert-success" role="alert">
                        New dues entered successfully
                        </div>';
                        } else if($_GET['result'] === "deleted"){
                        echo '<div class="alert alert-info" role="alert">
                        Dues deleted
                        </div>';
                        } else if($_GET['result'] === "error"){
                        echo '<div class="alert alert-danger" role="alert">
                        Error
                        </div>';
                        } 
                    }

                    ?>

                    <h2>Add/Edit dues</h2>
                    <form method="POST" action="controlPHP/addDuesControl.php">

                        <div class="form-group">
                            <label for="residentUsername">Resident username</label>
                            <select class="form-control" name="residentUsername" id="residentUsername">
                                <?php

                                $sql = "SELECT username FROM resident";
                                $result = $conn->query($sql);
                                while($row = $result->fetch_assoc()) {
                                    echo '
                                    <option value='.$row['username'].'>'.$row['username'].'</option>
                                    ';
                                }

                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="month">Month</label>
                            <select class="form-control" name="month" id="month">
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="year">Year</label>
                            <select class="form-control" name="year" id="year">
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="v">Paid</label>
                            <select class="form-control" name="paid" id="paid">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>

                        <button name="addResident" class="btn btn-success" type="submit">Add dues</button>
                    </form>
                </div>

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
        var element = tbody.firstElementChild;
        while (element) {
            if (element.lastChild.previousElementSibling.previousElementSibling.innerHTML === "No") {
                element.style.display = "";
            } else {
                element.style.display = "";
            }
            element = element.nextElementSibling;
        }
    });

    checkBox2.addEventListener("change", (event) => {
        var tbody = document.querySelector("#tbody");
        var element = tbody.firstElementChild;
        while (element) {
            if (element.lastChild.previousElementSibling.previousElementSibling.innerHTML === "No") {
                element.style.display = "none";
            } else {
                element.style.display = "";
            }
            element = element.nextElementSibling;
        }
    });

    checkBox3.addEventListener("change", (event) => {
        var tbody = document.querySelector("#tbody");
        var element = tbody.firstElementChild;
        while (element) {
            if (element.lastChild.previousElementSibling.previousElementSibling.innerHTML === "No") {
                element.style.display = "";
            } else {
                element.style.display = "none";
            }
            element = element.nextElementSibling;
        }
    });

    var searchByName = document.getElementById("search");

    searchByName.addEventListener("input", (event)=>{
        var tbody = document.querySelector("#tbody");
        var element = tbody.firstElementChild;
        while(element){
            if(element.firstElementChild.innerHTML.toLowerCase().includes(searchByName.value.toLowerCase())){
                //console.log(element.firstElementChild.innerHTML);
                //console.log(searchByName.value);
                element.style.display = "";
            } else{
                //console.log(element);
                element.style.display = "none";
            }
            element = element.nextElementSibling;
        }
    })
</script>

</html>