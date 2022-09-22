<?php
session_start();
?>

<?php include "db.php"?>

<?php include "logout.php" ?>

<?php
if (isset($_POST['logout1'])){
 
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
      <form action="CreateNewAcc.php" method="post">
      <input type="submit" name="logout1" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-2 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Create a new account</h1>
      </div>
    </div>

    <!-- internal user department actions start here-->
    <form action="CreateNewAcc.php" method="post">
    <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h6 class="display-5">Enter account details;</h6>
          <h4 class="text-danger">Funds should be deposited to the account, by the customer after opening the account;</h4>


          <div class="input-group mb-3 mt-5">
            <span class="input-group-text" id="basic-addon1">Account Name</span>
            <input type="text" class="form-control" name="AccountName" placeholder="person name, business name or organisation name" aria-label="Accname">
          </div>

          <div class="input-group mb-3 mt-5">
            <span class="input-group-text" id="basic-addon1">Enter customer ID</span>
            <input type="text" class="form-control" name="customerID" placeholder="Create a customer first before opening an account " >
          </div>

          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Choose an Account type:</span>
            <!-- <input type="text" class="form-control" placeholder="Last name" aria-label="Lname" aria-describedby="basic-addon1"> -->
            <select id="cars" name="AccountType" class="form-control fw-bold" placeholder="AccountType">
                <option value="savings">SAVINGS ACCOUNT</option>
                <option value="payment">CHECKING ACCOUNT</option>
                <option value="fiat">JUNIOR ACCOUNT</option>
                <option value="fiat">CURRENT ACCOUNT</option>
                <option value="fiat">ISLAMIC ACCOUNT</option>
                <option value="fiat">STUDENT ACCOUNT</option>
                <option value="fiat">FIXED ACCOUNT</option>
                <option value="audi">BUSINESS ACCOUNT</option>
             </select>
          </div>

          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Account currency:</span>
            <!-- <input type="text" class="form-control" placeholder="Last name" aria-label="Lname" aria-describedby="basic-addon1"> -->
            <select id="cars" name="AccountCurrency" class="form-control fw-bold" placeholder="AccountCurrency">
                <option value="TZS">TZS</option>
                <option value="USD">USD</option>
             </select>
          </div>
          
          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Account status:</span>
            <!-- <input type="text" class="form-control" placeholder="Last name" aria-label="Lname" aria-describedby="basic-addon1"> -->
            <select id="cars" name="Accountstatus" class="form-control fw-bold" placeholder="AccountStatus">
                <option value="Active">ACTIVE</option>
                <!-- <option value="Dormant">DORMANT</option> -->
                <!-- <option value="Suspended">SUSPENDED</option> -->
                <option value="on hold">ON HOLD</option>
                <option value="In Active">IN ACTIVE</option>
             </select>
          </div>
          
        </div>

        <?php

if (isset($_POST['submit'])){

  $Accname = $_POST['AccountName'];
  $Acctype =$_POST['AccountType'];
  $Acccurrency =$_POST['AccountCurrency'];
  $AccStatus =$_POST['Accountstatus'];
  $AccCustomerID =$_POST['customerID'];

  $Accname = mysqli_real_escape_string($connection , $Accname);
  $Acctype = mysqli_real_escape_string($connection , $Acctype);
  $Acccurrency = mysqli_real_escape_string($connection , $Acccurrency);
  $AccStatus = mysqli_real_escape_string($connection , $AccStatus);

  $Intuserquery = "INSERT INTO Account (AccName, AccType, currency, AccStatus, AccCustomerID )
   VALUES ('$Accname', '$Acctype' , '$Acccurrency ', '$AccStatus', '$AccCustomerID')";

  //  BE AWARE OF AUTO INCREMENT

  if(mysqli_query($connection, $Intuserquery)){
    echo "Account successfully.";
  } else{
    // echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    echo "The user creation failed";
  }

  // Close connection
  mysqli_close($connection);

}
    
    
    
    ?>

        
      </div>
    <!-- internal user department actions ends here-->


    <!-- Php to enter values in the db -->
   



    <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid p-3 p">
        <h1 class="display-5 fw-bold">Account</h1>
            
          
            <div class="d-grid gap-2 pt-5">
            <input href="#" type="submit" class="w-100 btn btn-lg btn-primary" name="submit" value="Create an account">
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
