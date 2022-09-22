<?php
session_start();
?>

<?php include "db.php"?>

<?php include "logout.php" ?>

<?php
if (isset($_POST['logout'])){
 
  operationsLogout();
 
}
?>

<!doctype html>
<html lang="en">
  <head>
            <!-- Favicon
    ================================================== -->
    <link rel="icon" type="image/png" href="public/image/ecoicon.png">
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Jumbotron example · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/jumbotron/">

    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      body{
        background-image: url("public/image/password.jpg");
        background-position: center;
        background-repeat: no-repeat; 
        background-size: cover; }

      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
  </head>
  <body>
    
<main>
  <div class="container py-4">
    <header class="pb-3 mb-4 border-bottom d-flex justify-content-between">
      <a href="Operations.php" class="d-flex align-items-center text-dark text-decoration-none">
      <img src="./public/image/eco-removebg-preview.png" width="90" height="32">
        <span class="fs-4 text-white">change password</span>
      </a>
      <form action="IntUserChngpassword.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-3 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">You are changing your password</h1>
        <p class="col-md-8 fs-4"> </p>

      </div>
    </div>

    <form action="Intuserchngpassword.php" method="post">
      <div class="p-3 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
          <p class="col-md-8 fs-4">Enter your current password:</p>

          <div class="col-md-6 p-3">
            <input type="password" class="form-control" id="cc-number" name="oldpassword" required>
            <div class="invalid-feedback">
              Password is required
            </div>
          </div>

          <p class="col-md-8 fs-4">Enter your new password:</p>

          <div class="col-md-6 p-3">
            <input type="password" class="form-control" id="cc-number" name="newpassword1" required>
            <div class="invalid-feedback">
              Password is required
            </div>
          </div>

          <p class="col-md-8 fs-4">Confirm your new password:</p>

          <div class="col-md-6 p-3">
            <input type="password" class="form-control" id="cc-number" name="newpassword2" required>
            <div class="invalid-feedback">
              Password is required
            </div>
          </div>

          <?php

if (isset($_POST['submit'])){

  $oldpassword = $_POST['oldpassword'];
  $newpassword1 =$_POST['newpassword1'];
  $newpassword2 =$_POST['newpassword2'];

  $oldpassword = mysqli_real_escape_string($connection , $oldpassword);
  $newpassword1cln = mysqli_real_escape_string($connection , $newpassword1);
  $newpassword2cln = mysqli_real_escape_string($connection , $newpassword2);

  // learn how to use session in php

  $query = "SELECT * FROM internalusers WHERE IntuserID = 1"; 

  $select_password_query = mysqli_query($connection, $query);

  if(!$select_password_query){
    die("QUERY FAILED".mysqli_error($connection));
  }

  while($row = mysqli_fetch_array($select_password_query)){
    
     $db_userpassword = $row['passwords'];

  }


  // comparison of the old and the new

  if($oldpassword == $db_userpassword){

    if($newpassword1cln == $newpassword2cln){

      $Chngpasswdquery = "UPDATE internalusers SET passwords = '{$newpassword2cln}' WHERE IntuserID = 1";

      if(mysqli_query($connection, $Chngpasswdquery)){
        echo "you have successfully changed your password";

      } else{
        // echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        echo "The user creation failed";
      }

    }else{
      echo "Your new password did not match";
    }

  } else {
    echo "Your Password is incorrect";
  }
}

    ?>

          <input href="#" type="submit" class="w-100 btn btn-lg btn-success" name="submit" value="Submit password">


        </div>
      </div>
    </form>


    



      <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2021
     </footer>
     </div>
</main>


    
  </body>
</html>
