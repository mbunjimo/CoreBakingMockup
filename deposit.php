<?php
session_start();
?>

<?php include "db.php"?>

<?php include "logout.php" ?>

<?php include "date&time.php" ?>

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
      <form action="deposit.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid">
        <h1 class="display-5 fw-bold">Make a deposit</h1>
        <!-- <p class="col-md-8 fs-4">Internal User ID:</p> -->
      </div>
    </div>

    <div class="p-5 mb-4 bg-light rounded-3">

        <div class="container-fluid py-5">
          <form action="deposit.php" method="post">

            <!-- teller actions -->
          <h1 class="display-5 fw-bold"></h1>
          <h6>Teller user, is the Funds initiator for the funds deposit</h6>

          <select class="form-select form-select-lg mb-3" name="depotype">
            <option value="" disabled selected hidden>Deposit type</option>
            <option value="SELF DEPOSIT">Self deposit</option>
            <option value="OTHER'S DEPOSIT">Other account deposit</option>
            <option value="OTHER'S DEPOSIT">Payment</option>
          </select>
          
          <div class="col-md-6 p-3">
            <label for="cc-number" class="form-label">Account To deposit</label>
            <input type="number" class="form-control" id="cc-number" name="acctodepo" placeholder="" required>
            <div class="invalid-feedback">
              Account is required
            </div>
          </div>

          <div class="col-md-6 p-3">
            <label for="cc-number" class="form-label">Enter ammount</label>
            <input type="number" class="form-control" id="cc-number" name="ammtodepo" placeholder="" required>
            <div class="invalid-feedback">
              Ammount is required
            </div>
          </div>

          <input class="w-50 btn btn-success btn-lg" type="submit" name="deposit" value="Make deposit">
          </form>
          
   
    </div>

     <?php
     
     if (isset($_POST['deposit'])){
        
      $deposittype = $_POST['depotype'];
      $accounttodebit = $_POST['acctodepo'];
      $ammmounttodebit = $_POST['ammtodepo'];      
      $debitorcredit = "DEBIT";
      $depositinitiator = $db_intuserid;
      $depositdate = date("Y-m-d");
      $deposittime = date("h:i:sa");


      $deposittype  = mysqli_real_escape_string($connection , $deposittype);
      $accounttodebit = mysqli_real_escape_string($connection , $accounttodebit);
      $ammmounttodebit = mysqli_real_escape_string($connection , $ammmounttodebit);



      // query to update account
      $queryaccdet = "SELECT * FROM Account WHERE AccID = {$accounttodebit}";

      $select_user_query_acc_det = mysqli_query($connection, $queryaccdet); 
  
      mysqli_num_rows($select_user_query_acc_det);
  
      while( $rowaccdet = mysqli_fetch_assoc($select_user_query_acc_det)){
  
         $db_AccID = $rowaccdet['AccID'];
         $db_AccName= $rowaccdet['AccName'];
         $db_AccType = $rowaccdet['AccType'];
         $db_AccCurrency = $rowaccdet['currency'];
         $db_AccStatus = $rowaccdet['AccStatus'];
         $db_Accbalance = $rowaccdet['AccBalance'];
      }


           // new balnce after deposit
           $newdb_Accbalance = $db_Accbalance + $ammmounttodebit ;
        
            $updateaccount = "UPDATE Account SET AccBalance = $newdb_Accbalance WHERE AccID = $db_AccID";
        
            if(mysqli_query($connection, $updateaccount)){
              
            echo "ammount successfully updated";
            echo "<br>";
          
          
            } else{
          
              echo "Balance not updated, deposit failed";
          
            }


      // query to update fundstransfers
      $depositammquery = "INSERT INTO FundsTransfers (Transfer_creditordebit, Transfer_Ammount, Transfer_type, Transfer_account, Transfer_Date, Transfer_Time, Transfer_initiator)
      VALUES ('$debitorcredit', '$ammmounttodebit' , '$deposittype', '$accounttodebit ','$depositdate', '$deposittime', '$depositinitiator')";
   
   
     if(mysqli_query($connection, $depositammquery)){
       echo "Transaction recorded successfully.";
     }else{
      echo "deposit failed...";
     }

      
}  
     
     ?>

    </div>

    

    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2022
    </footer>
  </div>
</main>


    
  </body>
</html>
