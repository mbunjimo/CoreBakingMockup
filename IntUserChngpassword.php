<?php  include "db.php"?>

<!doctype html>
<html lang="en">
  <head>
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
    <header class="pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
        <span class="fs-4">change password</span>
      </a>
    </header>

    <div class="p-3 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Welcome to your user</h1>
        <p class="col-md-8 fs-4">Internal user's ID: </p>
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