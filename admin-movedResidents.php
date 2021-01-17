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

                <div class="my-3">
                    <label class="form-check-label" for="search">Search by name</label>
                    <input id="search" type="text" name="search" class="form-control">
                </div>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">UserName</th>
                            <th scope="col">Block</th>
                            <th scope="col">Floor</th>
                            <th scope="col">Owner Name</th>
                            <th scope="col">Move date</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php

                        $sql = "SELECT resident.id AS residentID, username, password, block, floor, name, user.id AS userID, user.tel, isMoved, moveDate FROM resident, user WHERE resident.ownerID = user.id AND resident.isMoved = 1";
                        $result = $conn->query($sql);
                        //$row = $result->fetch_assoc();
                        //exit(print_r($row));
                        while($row = $result->fetch_assoc()) {
                            echo '
                            <tr>
                                <td>'.$row['username'].'</td>
                                <td>'.$row['block'].'</td>
                                <td>'.$row['floor'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['moveDate'].'</td>
                                <td>'. '<a class="btn btn-info" href="../ApartmentManager/admin-editResident.php?id='.$row['residentID'].'&username='.$row['username'].'&password='.$row['password'].'&block='.$row['block'].'&floor='.$row['floor'].'&ownerTel='.$row['tel'].'&isMoved='.$row['isMoved'].'&moveDate='.$row['moveDate'].'">Edit</a>'.'<a class="btn btn-primary ml-4" href="../ApartmentManager/controlPHP/recoverResidentControl.php?id='.$row['residentID'].'">Recover</a>'.'<a class="btn btn-danger ml-4" href="../ApartmentManager/controlPHP/adminDeleteResidentControl.php?id='.$row['residentID'].'">Delete resident and users permanently</a>'.'</td>
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
            //console.log(element.firstElementChild.nextElementSibling.innerHTML);
            element = element.nextElementSibling;
        }
    })

</script>

</html>