<?php
session_start();
?>

<?php  include "db.php" 

?>

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
      <a href="Admin1.php" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="./public/image/eco-removebg-preview.png" width="90" height="32">
        <span class="fs-4">Administrator's page</span>
      </a>
      <form action="CreateNewIntUser.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-2 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Create a internal user</h1>
      </div>
    </div>

    <!-- internal user department actions start here-->
    <form action="CreateNewIntUser.php" method="post">
         <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h6 class="display-5">fill in the form below, accurately;</h6>

          <div class="input-group mb-3 mt-5">
            <span class="input-group-text" id="basic-addon1">First Name</span>
            <input type="text" name="Fname" class="form-control" placeholder="First name" aria-label="Fname" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Last Name</span>
            <input type="text" name="Lname" class="form-control" placeholder="Last name" aria-label="Lname" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">password</span>
            <input type="text" name="password" class="form-control" placeholder="password" aria-label="Lname" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Department</span>
            <input type="text" name="Department" class="form-control" placeholder="Department" aria-label="Lname" aria-describedby="basic-addon1">
          </div>
          
          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Select Internal user's role</span>
            <!-- <input type="text" class="form-control" placeholder="Last name" aria-label="Lname" aria-describedby="basic-addon1"> -->
            <select id="Introles" name="Introles" class="form-control fw-bold" placeholder="AccountType">
                <option value="INTERNAL USER">INTERNAL USER</option>
                <option value="TELLER">TELLER</option>
                <option value="ADMINISTRATOR">ADMINISTRATOR</option>
             </select>
          </div>

        </div>
        </div>
    

         <!-- internal user department actions ends here-->

    

         <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid p-3 p">
        <h1 class="display-5 fw-bold">Submit details</h1>
            
            <div class="d-grid gap-2 pt-5">
                <input type="submit" class="btn btn-success" name="submit" value="submit customer details">
              </div>
        </div>
        </div>
      </form>



    <!-- php to insert the values into the database starts here -->

    <?php

    if( $_SESSION['admin']){

      
      

      $adminID = $_SESSION['admin'];
    
      if (isset($_POST['submit'])){
  
        $firstname = $_POST['Fname'];
        $lastname =$_POST['Lname'];
        $password =$_POST['password'];
        $department =$_POST['Department'];
        $introles =$_POST['Introles'];
  
        $firstname = mysqli_real_escape_string($connection , $firstname);
        $lastname = mysqli_real_escape_string($connection , $lastname);
        $password = mysqli_real_escape_string($connection , $password);
        $department = mysqli_real_escape_string($connection , $department);
        $introles = mysqli_real_escape_string($connection , $introles);
  
        $Intuserquery = "INSERT INTO internalusers (IntuserFName, IntuserLName, passwords , IntuserDepartment, IntuserRole )
         VALUES ('$firstname', '$lastname' , '$password', '$department', '$introles')";
  
        //  BE AWARE OF AUTO INCREMENT
  
        if(mysqli_query($connection, $Intuserquery)){
          echo "Records inserted successfully.";
        } else{
          // echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
          echo "The user creation failed";
        }
  
        // Close connection
        mysqli_close($connection);
  
      }



    } else {

         error_reporting(0);

         echo "you are not logged in";
      }


    

    ?>

    <!-- php to insert the values into the database starts here -->




    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2021
    </footer>
  </div>
</main>


    
  </body>
</html>
