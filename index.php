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
    .main-container {
      background-image: url('https://images2.alphacoders.com/694/thumb-350-694259.jpg');
    }
  </style>
</head>

<body>
  <div class="container-fluid d-flex justify-content-center bg-info main-container" style="height: 100vh;">
    <div class="container-fluid my-auto">
      <div class="row">
        <div class="col-1"></div>

        <div class="col-10">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Sign In</h5>
            </div>

            <form method="POST" action="../ApartmentManager/controlPHP/signInControl.php" class="mx-3">
              <?php 
              
              if(isset($_GET['error'])){
                if($_GET['error'] === "invalidChar"){
                  echo '<div class="alert alert-danger" role="alert">
                  You entered invalid character
                  </div>';
                } else if($_GET['error'] === "empty"){
                  echo '<div class="alert alert-danger" role="alert">
                  Please enter username and password
                  </div>';
                } else if($_GET['error'] === "invalidInfo"){
                  echo '<div class="alert alert-danger" role="alert">
                  Invalid username or password
                  </div>';
                }
              }

              ?>
              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input name="username" type="text" class="form-control" placeholder="username" value="<?php if(isset($_GET['username'])) echo $_GET['username']; ?>" />
              </div>

              <div class="input-group form-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input name="password" type="password" class="form-control" placeholder="password" />
              </div>

              <div class="form-group d-flex justify-content-center">
                <input name="submitButton" type="submit" value="Login" class="btn btn-warning px-5 mt-2" />
              </div>
            </form>
          </div>
        </div>

        <div class="col-1"></div>
      </div>
    </div>
  </div>
</body>

</html>