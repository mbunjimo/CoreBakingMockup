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

<?php


        $queryintusers = "SELECT * FROM internalusers WHERE IntuserID = {$_SESSION['internaluserID']}";
        
        $select_intuser_query = mysqli_query($connection, $queryintusers); 

        while($row = mysqli_fetch_assoc($select_intuser_query)){

           $db_intuserid = $row['IntuserID'];
           $db_intuserFname = $row['IntuserFName'];
           $db_intuserLname = $row['IntuserLName'];
           $db_intuserdepartment = $row['IntuserDepartment'];
           $db_intuserroles = $row['IntuserRole']; 

        }

    ?>


<!-- use a switch statement to select actions selected by the operations
i.e create customer, transfer funds -->

<!-- change the name of the page to internalusershome.php -->


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
        background-image: url("public/image/bankBackground.jpg");
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
        <span class="fs-4">Operations page</span>
      </a>
      <form action="Customer.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Welcome, <?php echo $db_intuserLname?>.</h1>
        <p class="col-md-8 fs-4">internal user ID: <?php echo $db_intuserid ; ?></p>
        <p class="col-md-8 fs-4">Department: <?php echo $db_intuserdepartment ; ?></p>
      </div>
    </div>

    <!-- internal user department actions start here-->
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Actions</h1>
         <form action="Login.php" method="post">


        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
               <a href="CreateNewCust.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Create a new customer </h4>
              </a>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
              <a href="CreateNewAcc.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Create an account </h4>
              </a>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
              <a href="TransferFunds.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Transfer funds </h4>
              </a>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
              <a href="manageAcc1.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Manage accounts </h4>
              </a>        
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
              <a href="IntUserChngpassword.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Change password </h4>
              </a>  
            </div>
          </div>
        </div>
        </form>

        </div>
      </div>
    <!-- internal user department actions ends here-->


    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2021
    </footer>
  </div>
</main>


    
  </body>
</html>
