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

<!-- this is where we start to write code for send money -->




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
        <span class="fs-4 text-white">Operations page</span>
      </a>
      <form action="TransferFunds.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-2 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Transfer funds</h1>
      </div>
    </div>

    <!-- internal user department actions start here-->
    <form action="TransferFunds.php" method="post">
      <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h6 class="display-5">Set the Debit account</h6>

          <div class="input-group mb-3">
            <input type="number" class="form-control" name="receiveracc">
          </div>

          <h6 class="display-5 pt-3">Set the Credit account</h6>


          <div class="input-group mb-3">
            <input type="number" class="form-control" name="sendingacc">
          </div>
          

          <h6 class="display-5 pt-5">Set transfer ammount:</h6>
          <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control" name="set_ammount">
            <span class="input-group-text">.00</span>
          </div>

          <?php if(isset($_POST['maketransfer'])){

// maketransfer to an account

$receiveracc = $_POST['receiveracc']; 
$sendingacc = $_POST['sendingacc']; //include this in the funds transfer database
$transfermoney = $_POST['set_ammount']; //include this in the funds transfer database
$transferinitiator = $_SESSION['internaluserID'] ;
$transfertime = date("Y-m-d");
$transferdate = date("h:i:sa");

$receiveracc = mysqli_real_escape_string($connection , $receiveracc);
$sendingacc= mysqli_real_escape_string($connection , $sendingacc);
$transfermoney = mysqli_real_escape_string($connection , $transfermoney);

$queryreceiver = "SELECT * FROM Account WHERE AccID = $receiveracc"; //be aware of possible quotation
$querysender = "SELECT * FROM Account WHERE AccID = $sendingacc"; //be aware of possible quotation

$select_account_receiver_query = mysqli_query($connection, $queryreceiver);
$select_account_sender_query = mysqli_query($connection, $querysender);


if(!$select_account_receiver_query){
  die("QUERY FAILED".mysqli_error($connection));
}

if(!$select_account_sender_query){
  die("QUERY FAILED".mysqli_error($connection));
}


while($row = mysqli_fetch_array($select_account_receiver_query)){
  
   $db_receiver_accountID = $row['AccID'];
   $db_receiver_accountName = $row['AccName'];
   $db_receiver_accountBalance = $row['AccBalance'];

}

while($row1 = mysqli_fetch_array($select_account_sender_query)){
  
  $db_sender_accountID_1 = $row1['AccID'];
  $db_sender_accountName_1 = $row1['AccName'];
  $db_sender_accountBalance_1 = $row1['AccBalance'];

}

if ($db_sender_accountBalance_1 >= $transfermoney){

  $db_sender_accountBalance_1 = $db_sender_accountBalance_1 - $transfermoney;
  $db_receiver_accountBalance = $db_receiver_accountBalance + $transfermoney;

  $querytoupdatesender = "UPDATE Account SET AccBalance = $db_sender_accountBalance_1 WHERE AccID = $db_sender_accountID_1";
  if(mysqli_query($connection, $querytoupdatesender)){

    echo "updated senders balance";
    echo "<br>";
   } else{

     echo "sender Balance not updated";
    echo "<br>";

   }


  $querytoupdatereceiver = "UPDATE Account SET AccBalance = $db_receiver_accountBalance WHERE AccID = $db_receiver_accountID";
  if(mysqli_query($connection, $querytoupdatereceiver)){

    echo "updated receiver balance";
    echo "<br>";

   } else{

     echo "Receiver Balance not updated";
    echo "<br>";

   }


  //sender query
  $querysenderfundtransfer = "INSERT INTO FundsTransfers (Transfer_creditordebit, Transfer_Ammount, Transfer_type, Transfer_account, Transfer_Date, Transfer_Time,Transfer_initiator )
  VALUES ('CREDIT', '$transfermoney' , 'DIRECT CREDIT', '$db_receiver_accountID', '$transferdate', '$transfertime', '$transferinitiator')";
  if(mysqli_query($connection, $querysenderfundtransfer)){

    echo "successfully inserted sender transfer details to database";
    echo "<br>";

   } else{

     echo "transfer details not inserted in db";
    echo "<br>";

   }

  //receiver query
  $queryreceiverfundtransfer = "INSERT INTO FundsTransfers (Transfer_creditordebit, Transfer_Ammount, Transfer_type, Transfer_account, Transfer_Date, Transfer_Time, Transfer_initiator)
  VALUES ('DEBIT', '$transfermoney' , 'DIRECT DEBIT', ' $db_sender_accountID_1', '$transferdate', '$transfertime', '$transferinitiator')";
  if(mysqli_query($connection, $queryreceiverfundtransfer)){

    echo "successfully inserted receiver transfer details to database";
    echo "<br>";

   } else{

     echo "transfer details not inserted in db";
    echo "<br>";

   }


 
  if ($querytoupdatesender && $querytoupdatereceiver && $querysenderfundtransfer && $queryreceiverfundtransfer){

    echo "the transfer was successfull";
    echo "<br>";

    
    
  } else {

    echo "Transaction failed";
    echo "<br>";

  }


}else{
  echo "sender does not have enough Funds";
  echo "<br>";

}


// Close connection
mysqli_close($connection);


}

?>













          
        </div>
      </div>
    <!-- internal user department actions ends here-->

    <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid p-3 p">            
          
            <div class="d-grid gap-2 pt-5">
                <input class="btn btn-success fw-bold" type="submit" name="maketransfer">make transfers</button>
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
