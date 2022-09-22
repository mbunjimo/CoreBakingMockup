<?php
session_start();
?>

<?php include "db.php"?>

<?php include "logout.php" ?>

<?php

if (isset($_POST['logout'])){
 
  customerLogout();
 
}
?>


<?php

    $accountID = $_SESSION['selectedacc'];

    $queryaccdet = "SELECT * FROM Account WHERE AccID = {$accountID}";

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

?>



<?php if(isset($_POST['withdrawmoney'])){

  // send withdraw money

  $withdrawAmm = $_POST['ammount'];
  $debitorcredit = "CREDIT";
  $transfertype = "WITHDRAW";
  $withdrawdate = date("Y-m-d");
  $withdrawtime = date("h:i:sa");

  $withdrawAmm = mysqli_real_escape_string($connection , $withdrawAmm);

  $withdrawammquery = "INSERT INTO FundsTransfers (Transfer_creditordebit, Transfer_Ammount, Transfer_type, Transfer_account, Transfer_Date, Transfer_Time )
   VALUES ('$debitorcredit', '$withdrawAmm' , '$transfertype', '$db_AccID', '$withdrawdate' , '$withdrawtime')";

  //  BE AWARE OF AUTO INCREMENT

  if(mysqli_query($connection, $withdrawammquery)){
    // echo "Transaction recorded successfully.";

    $newAccbalance = $db_Accbalance - $withdrawAmm;

    $updateaccount = "UPDATE Account SET AccBalance = $newAccbalance WHERE AccID = $accountID";

    if(mysqli_query($connection, $updateaccount)){
      
     header("Location: /corebankingsys/Account.php");
  
  
    } else{
  
      echo "Balanced not updated";
  
    }

  } else{
    // echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    echo "withdraw failed failed";
  }

  // Close connection
  mysqli_close($connection);


}

?>






<!-- this is where we start to write code for send money -->

<?php if(isset($_POST['sendmoney'])){

// send money to differengt account

$ammountsent = $_POST['ammounttosend']; 
$accsendmoney = $_POST['accounttosend']; //include this in the funds transfer database
$senddebitorcredit = "CREDIT";
$sendtransfertype = "DIRECT DEBIT";
$sendtransfertypetwo = "DIRECT CREDIT";
$senddate = date("Y-m-d");
$sendtime = date("h:i:sa");

$ammountsent_1 = mysqli_real_escape_string($connection , $ammountsent);
$accsendmoney_1 = mysqli_real_escape_string($connection , $accsendmoney);

$sendammquery = "INSERT INTO FundsTransfers (Transfer_creditordebit, Transfer_Ammount, Transfer_type, Transfer_account, Transfer_Date, Transfer_Time )
 VALUES ('$senddebitorcredit', '$ammountsent' , '$sendtransfertype', '$accsendmoney', '$senddate ', '$sendtime')";

//  BE AWARE OF AUTO INCREMENT

if(mysqli_query($connection, $sendammquery)){
  // echo "Transaction recorded successfully.";

  $db_Accbalance =($db_Accbalance-$ammountsent_1);

  // echo $db_Accbalance;

  $sendammquerytwo = "INSERT INTO FundsTransfers (Transfer_creditordebit, Transfer_Ammount, Transfer_type, Transfer_account, Transfer_Date, Transfer_Time )
 VALUES ('$senddebitorcredit', '$ammountsent' , '$sendtransfertypetwo', '$db_AccID', '$senddate ', '$sendtime')";
 
   mysqli_query($connection, $sendammquerytwo);
  
  //UPDATE THE BALANCE AFTER WITHDRAW
   
  $updateaccount = "UPDATE Account SET AccBalance = $db_Accbalance WHERE AccID = $accountID";

  if(mysqli_query($connection, $updateaccount)){
    
   header("Location: /corebankingsys/Account.php");


  } else{

    echo "Balanced not updated";

  }

} else{
  echo "sending money failed";
}

// Close connection
mysqli_close($connection);


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
        background-image: url("public/image/cust.jpg");
        background-position: center;
        background-repeat: no-repeat; 
        background-size: cover; 
      }

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
      <a href="/corebankingsys/customer.php" class="d-flex align-items-center text-dark text-decoration-none">
         <img src="./public/image/eco-removebg-preview.png" width="90" height="32">
        <span class="fs-4 text-white ">Account page</span>
      </a>
      <form action="Customer.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-3 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Welcome to your account</h1>
        <p class="col-md-8 fs-4">Account ID: <?php echo $db_AccID  ?></p>
        <p class="col-md-8 fs-4">Account Balance: <?php echo $db_Accbalance ?> </p>

      </div>
    </div>
      <form action="Account.php" method="post">
      <div class="p-3 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
          <h3 class="fw-bold">Withdraw money</h3>

          <div class="col-md-6 p-3">
            <label for="cc-number" class="form-label">Enter amount</label>
            <input type="number" class="form-control" id="cc-number" name="ammount">
          </div>

          <input class="w-50 btn btn-success btn-lg" type="submit" value="Withdraw money" name="withdrawmoney">

        </div>
      </div>


      <!-- code to send money -->

      <div class="p-3 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
          <h3 class="fw-bold">Send money</h3>
          <p class="col-md-8 fs-4">Enter ammount and account to send money</p>

          <div class="col-md-6 p-3">
            <label for="cc-number" class="form-label">Enter Account</label>
            <input type="number" class="form-control" id="cc-number" name="accounttosend">
            <div class="invalid-feedback">
              Account is required
            </div>
          </div>

          <div class="col-md-6 p-3">
            <label for="cc-number" class="form-label">Enter ammount</label>
            <input type="number" class="form-control" id="cc-number" name="ammounttosend">
            <div class="invalid-feedback">
              Ammount is required
            </div>
          </div>

          <input type="submit" class="w-50 btn btn-success btn-lg" name="sendmoney" value="Send money">

        </div>
      </div>
      </form>


      <div class="p-3 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
          <h1 class="display-5 fw-bold">Your account history</h1>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">Transfer ID</th>
                  <th scope="col">Ammount</th>
                  <th scope="col">Transfer type</th>
                  <th scope="col">Account</th>
                  <th scope="col">money in/out</th>
                  <th scope="col">Date&Time</th>
                  <th scope="col">Initiator</th>
                </tr>
              </thead>
              <tbody>
              <?php
                
                $queryfundstransfers = "SELECT * FROM FundsTransfers WHERE Transfer_account = {$db_AccID}";

                $resultfundstransfers = mysqli_query($connection, $queryfundstransfers);

                mysqli_num_rows($resultfundstransfers);

                while( $record = mysqli_fetch_assoc($resultfundstransfers)){

                ?>

              <tr>
				          <!--FETCHING DATA FROM EACH
					              ROW OF EVERY COLUMN-->
		            		<td><?php echo $record['FundsTransfer_ID'];?></td>
				            <td><?php echo $record['Transfer_Ammount'];?></td>
				            <td><?php echo $record['Transfer_type'];?></td>
				            <td><?php echo $record['Transfer_account'];?></td>
				            <td><?php echo $record['Transfer_creditordebit'];?></td>
				            <td><?php echo $record['Transfer_Date'] . " " . $record['Transfer_Time'] ;?></td>
				            <td><?php echo $record['Transfer_initiator'];?></td>
			        </tr>
			         <?php
                }
			        ?>
              </tbody>
            </table>
          </div>
  
        </div>
      </div>


      <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2021
     </footer>
     </div>
</main>


    
  </body>
</html>
