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

      // pulling the customers from the databases

      $query = "SELECT * FROM Customer WHERE CustomerID = {$_SESSION['CustomerID']}";
      $select_user_query = mysqli_query($connection, $query); 

      while($row = mysqli_fetch_assoc($select_user_query)){

         $db_customerid = $row['customerID'];
         $db_custFname = $row['custFName'];
         $db_custLname = $row['custLName'];
         $db_custEmail = $row['email'];

      }

    ?>


<?php

  if (isset($_POST['submitacc'])){

   if ( $_SESSION['selectedacc'] ) {

    header("Location: /corebankingsys/Account.php");

  } else {
    echo "You need to select an account to enter this page";
  }
      
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
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>



      /* style to put a background on the page */


       /* body{
        background-image: url("public/image/bankBackground.jpg");
        background-position: center; 
        background-repeat: no-repeat;
        background-size: cover;
      } */

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
      <a href="/corebankingsys/customer.php" class="g-col-6 d-flex align-items-center text-dark text-decoration-none">
        <img src="./public/image/eco.jpg" width="90" height="32">
        <span class="fs-4">Customer page</span>
      </a>
      <form action="Customer.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">Welcome <?php echo $db_custFname ?>,</h1>
        <p class="col-md-8 fs-4">full name: <?php echo $db_custFname ?> <?php echo $db_custLname ?> </p>
        <p class="col-md-8 fs-4">Your customer ID: <?php echo $db_customerid ?></p>
        <p class="col-md-8 fs-4">Your Registered email: <?php echo $db_custEmail ?></p>
        <br>
        <br>
        <h4 class="col-md-8 fs-4 text-success">Select the account your want to use;</h4>
      </div>
    </div>

    <!--all customers accounts -->
    <div class="p-3 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
          <h1 class="display-5 fw-bold">Select the account you want to access</h1>
        <p class="col-md-8 fs-4">all your accounts;</p>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">Account ID</th>
                  <th scope="col">Account Name</th>
                  <th scope="col">Account type</th>
                  <th scope="col">Account Status</th>
                </tr>
              </thead>
              <tbody>

                <?php
                
                // pulling the customers accounts from the database

                $queryacc = "SELECT * FROM Account WHERE AccCustomerID = {$_SESSION['CustomerID']}";

                $select_user_query_acc = mysqli_query($connection, $queryacc); 

                mysqli_num_rows($select_user_query_acc);

                while( $rowacc = mysqli_fetch_assoc($select_user_query_acc)){

                ?>
              <form action="Customer.php" method="post">
              <tr>
				          <!--FETCHING DATA FROM EACH ROW OF EVERY COLUMN-->
		            		<td><?php echo $db_AccID = $rowacc['AccID'];?></td>   
		            		<td><input type="submit" name="submitacc" value="<?php echo $db_AccName= $rowacc['AccName'];?>"></td>   
				            <td><?php echo $db_AccType = $rowacc['AccType'];?></td>
				            <td><?php echo $db_AccStatus = $rowacc['AccStatus'];?></td>
			        </tr>
              </form>
			         <?php
                
                // the session variable has to be created here so as to avoid error to detect $db_AccID

                $_SESSION['selectedacc'] = $db_AccID;
                
                }
			        ?>
              </tbody>
            </table>
          </div>
  
        </div>
      </div>

      <?php


      
      
      ?>

      <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Change your password</h1>
          <p class="col-md-8 fs-4">Click here to change your password </p>

          <div class="d-grid gap-2 pt-5">
            <a href="custchngpassword.php" class="btn btn-success" type="button">Change password</a>
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
