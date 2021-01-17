<?php

    require "commonPHP/databaseConnection.php";
    session_start();

    $currentDues = 150;
    $selectedYear = date("Y");

    if(isset($_POST['year'])){
        $selectedYear = $_POST['year'];
    }

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

            <?php require "commonPHP/adminSidebar.php" ?>

            <div class="col-9 padding-0">

                <div>
                    <div class="alert alert-info py-4" role="alert">
                        Administrators have collected <?php

                        $sql = "SELECT COUNT(*) AS totalDues FROM dues WHERE YEAR(dues.dueDate) = '$selectedYear' AND dues.isPaid = 1";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();

                        echo $row['totalDues'] * $currentDues;

                        ?>$ this year. They spent <?php
                        
                        $sql = "SELECT SUM(expense.price) AS totalExpense FROM expense WHERE YEAR(expenseDate) = '$selectedYear'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        
                        echo $row['totalExpense'];
                        
                        ?>$.
                    </div>
                </div>

                <div class="form-group">
                    <form action="./admin-expenses.php" method="POST" id="form" name="form">
                        <label for="year">Select year:</label>
                        <select class="form-control" name="year" id="year">
                            <option value="" disabled selected="true">SELECT YEAR</option>
                            <option value="2021">2021</option>
                            <option value="2020">2020</option>
                        </select>
                    </form>
                </div>


                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Topic</th>
                            <th scope="col">Details</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                        <?php

                        $sql = "SELECT * FROM expense WHERE YEAR(expenseDate) = '$selectedYear'";
                        $result = $conn->query($sql);

                        while($row = $result->fetch_assoc()) {
                            echo '
                            <tr>
                                <td>'.$row['topic'].'</td>
                                <td>'.$row['detail'].'</td>
                                <td>'.$row['price'].'</td>
                                <td>'.$row['expenseDate'].'</td>
                                <td>'.'<a class="btn btn-danger" href="controlPHP/adminDeleteExpenseControl.php?id='.$row['id'].'">Delete</a>'.'</td>
                            </tr>
                            ';
                        }

                        ?>

                    </tbody>
                </table>

                <?php 
                
                    if(isset($_GET['result'])){
                        if($_GET['result'] === "ok"){
                        echo '<div class="alert alert-success" role="alert">
                        Expense has been added successfully
                        </div>';
                        } else if($_GET['result'] === "error"){
                        echo '<div class="alert alert-danger" role="alert">
                        Error
                        </div>';
                        } else if($_GET['result'] === "emptyBlank"){
                        echo '<div class="alert alert-danger" role="alert">
                        Please fill all blanks
                        </div>';
                        } else if($_GET['result'] === "deleted"){
                        echo '<div class="alert alert-danger" role="alert">
                        Deleted
                        </div>';
                        } 
                    }

                    ?>

                <h2 class="mt-5">Add expense</h2>
                <form method="POST" action="controlPHP/addExpenseControl.php">

                    <div class="form-group">
                        <label for="topic">Topic</label>
                        <input type="text" class="form-control" id="topic" name="topic" placeholder="Topic">
                    </div>

                    <div class="form-group">
                        <label for="details">Details</label>
                        <input type="text" class="form-control" id="details" name="details" placeholder="Details">
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="Price">
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

                    <button name="addResident" class="btn btn-success" type="submit">Add expense</button>
                </form>

            </div>
        </div>
    </div>
</body>

<script>
    var form = document.getElementById("form");
    var year = document.getElementById("year");

    console.log(form);
    console.log(year);

    year.addEventListener("change", (e) => {
        form.submit();
        e.preventDefault();
    })
</script>

</html>