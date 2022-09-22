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
      <form action="CreateNewCust.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-2 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Create a new customer</h1>
      </div>
    </div>

    <!-- internal user department actions start here-->
    <form action="CreateNewCust.php" method="post">
    <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h6 class="display-5">fill in the form below, accurately;</h6>


          <div class="input-group mb-3 mt-5">
            <span class="input-group-text" id="basic-addon1">First Name</span>
            <input type="text" class="form-control" name="Firstname" placeholder="First name" aria-label="Fname" aria-describedby="basic-addon1">
          </div>

          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Last Name</span>
            <input type="text" class="form-control" name="Lastname" placeholder="Last name" aria-label="Lname" aria-describedby="basic-addon1">
          </div>
          
          <div class="input-group mb-3">
          <span class="input-group-text" id="basic-addon1">Email</span>
            <input type="text" class="form-control" name="customeremail" placeholder="example@ecobank.com" aria-label="Customer's email" aria-describedby="basic-addon2">
          </div>

          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Phone number</span>
            <input type="text" class="form-control" placeholder="Phone number i.e +255748531480" name="phoneno" aria-label="Fname" aria-describedby="basic-addon1">
          </div>
          
        </div>
        
      </div>
    <!-- internal user department actions ends here-->


   <!-- inserting data into the database -->



    <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid p-3 p">
        <h1 class="display-5 fw-bold">Submit details</h1>
            
          
        <div class="d-grid gap-2 pt-5">
            <input href="#" type="submit" class="w-100 btn btn-lg btn-primary" name="submit" value="Create customer">
              </div>
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
