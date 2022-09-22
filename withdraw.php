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

        $sess_intuserID = $_SESSION['TellerID'];

        $queryintusers = "SELECT * FROM internalusers WHERE IntuserID = {$sess_intuserID}";
        $select_intuser_query = mysqli_query($connection, $queryintusers); 

        while($row = mysqli_fetch_assoc($select_intuser_query)){

           $db_intuserid = $row['IntuserID'];
           $db_intuserFname = $row['IntuserFName'];
           $db_intuserLname = $row['IntuserLName'];
           $db_intuserdepartment = $row['IntuserDepartment'];
           $db_intuserroles = $row['IntuserRole']; 

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
        background-image: url("public/image/teller.jpg");
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
      <a href="teller.php" class="d-flex align-items-center text-dark text-decoration-none">
        <img src="./public/image/eco-removebg-preview.png" width="90" height="32">
        <span class="fs-4 text-white">Teller's page</span>
      </a>
      <form action="withdraw.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid">
        <h1 class="display-5 fw-bold">Issue a Withdraw</h1>
        <!-- <p class="col-md-8 fs-4">Internal User ID:</p> -->
      </div>
    </div>

    <div class="p-5 mb-4 bg-light rounded-3">
      <form action="withdraw.php"method="post">
        <div class="container-fluid py-5">

            <!-- teller actions -->
          <h1 class="display-5 fw-bold"></h1>
          <h6>Teller user, is the Funds initiator for the funds Withdraw</h6>
          
          <div class="col-md-6 p-3">
            <label for="cc-number" class="form-label">Transfer ID</label>
            <input type="number" name="TransferID" class="form-control" id="cc-number" placeholder="" required>
            <div class="invalid-feedback">
              Account is required
            </div>
          </div>

          <input class="w-50 btn btn-success btn-lg" type="submit" name="withdraw" value="Confirm">
          
   
        </div>
    </form>

    <?php
    
    if (isset($_POST['withdraw'])){
        
           $tellerTransID = $_POST['TransferID'];
                
           $queryfundstransfers = "SELECT * FROM FundsTransfers WHERE FundsTransfer_ID = $tellerTransID";

           $resultfundstransfers = mysqli_query($connection, $queryfundstransfers);

           while( $record = mysqli_fetch_assoc($resultfundstransfers)){

            $db_fundstransferID = $record['FundsTransfer_ID'];
            $transferamm = $record['Transfer_Ammount'];
            $transftype = $record['Transfer_type'];
            $record['Transfer_account'];
            $record['Transfer_creditordebit'];
            $record['Transfer_Date'] . " " . $record['Transfer_Time'];
            $record['Transfer_initiator'];
            $Initiator = $record['Transfer_initiator'];
      
            }
            
            if($Initiator == 0 && $transftype == 'WITHDRAW'){

            if($db_fundstransferID == $tellerTransID){

              $initiatorvalue = $db_intuserid;

              $updateaccount = "UPDATE FundsTransfers SET Transfer_initiator = $initiatorvalue WHERE FundsTransfer_ID = $db_fundstransferID";

               if(mysqli_query($connection, $updateaccount)){
      
                  echo "successully updated databse, please give the customer the " . $transferamm . " ammount in cash";
  
  
              } else{
  
                echo "failed database update";
  
              }

            } else {

              echo "the transaction is not cashed out";
            }
          }

          else {

            echo "the transaction is already cashed out";
          }
  
      
    
    }  
    
    ?>



    </div>

   

    

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2021
    </footer>
  </div>
 </main>


    
  </body>
</html>
