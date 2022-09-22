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

        
        //   selecting the userr from his/her ID
        //   $query = "SELECT * FROM internalusers WHERE IntuserID = {$intuserID}";

        // hapa nimekwama

      $query = "SELECT * FROM Account WHERE AccID = {$_SESSION['AccountIDno']}";
      $select_user_query = mysqli_query($connection, $query); 

      while($row = mysqli_fetch_assoc($select_user_query)){

         $db_AccName = $row['AccName'];
         $db_AccType = $row['AccType'];
         $db_currency = $row['currency'];
         $db_AccStatus = $row['AccStatus'];
         $db_AccID = $row['AccID']; 

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
        <span class="fs-4 text-white">account management page</span>
      </a>
      <form action="manageAcc2.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-2 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Change accounts details</h1>
        <p class="col-md-8 fs-4">AccountID: <?php echo $db_AccID  ?></p>
        <p class="col-md-8 fs-4">Account Name: <?php echo $db_AccName ?></p>

      </div>
    </div>

    <!-- internal user department actions start here-->
    <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h6 class="display-5">fill in the form below, accurately;</h6>

          <form action="manageAcc2.php" method="post">
          <div class="input-group mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Change a Account type:</span>
            <!-- <input type="text" class="form-control" placeholder="Last name" aria-label="Lname" aria-describedby="basic-addon1"> -->
            <select id="cars" name="acctype" class="form-control fw-bold"  placeholder="">
                <option value="" disabled selected hidden><?php echo $db_AccType; ?></option>
                <option value="SAVINGS ACCOUNT">SAVINGS ACCOUNT</option>
                <option value="CHECKING ACCOUNT">CHECKING ACCOUNT</option>
                <option value="JUNIOR ACCOUNT">JUNIOR ACCOUNT</option>
                <option value="CURRENT ACCOUNT">CURRENT ACCOUNT</option>
                <option value="ISLAMIC ACCOUNT">ISLAMIC ACCOUNT</option>
                <option value="STUDENT ACCOUNT">STUDENT ACCOUNT</option>
                <option value="FIXED ACCOUNT">FIXED ACCOUNT</option>
                <option value="BUSINESS ACCOUNT">BUSINESS ACCOUNT</option>
             </select>
          </div>
          
          <div class="input-group pb-5 mb-3 mt-2">
            <span class="input-group-text" id="basic-addon1">Change Account status:</span>
            <select id="cars" name="accstatus" class="form-control fw-bold">
                <option value="" disabled selected hidden><?php echo $db_AccStatus;?></option>
                <option value="ACTIVE">ACTIVE</option>
                <option value="DORMANT">DORMANT</option>
                <option value="SUSPENDED">SUSPENDED</option>
                <option value="ON HOLD">ON HOLD</option>
                <option value="IN ACTIVE">IN ACTIVE</option>
             </select>
          </div>
           
          <input type="submit" name="changedetails" value="Change account deatails" class="w-100 btn btn-success btn-lg">

          </form>


          <?php

           //insert new account details

           if (isset($_POST['changedetails'])){

            if ($_POST['acctype'] && $_POST['accstatus']){
  
            $presentacctype = $_POST['acctype'];
            $presentaccstatus =$_POST['accstatus'];
        
            $presentacctype = mysqli_real_escape_string($connection , $presentacctype);
            $presentaccstatus = mysqli_real_escape_string($connection , $presentaccstatus);

        
            $Intuserqueryyy = "UPDATE Account SET AccType = '$presentacctype', AccStatus = ' $presentaccstatus' WHERE AccID = {$db_AccID}";
        
            //  BE AWARE OF AUTO INCREMENT
        
            if(mysqli_query($connection, $Intuserqueryyy)){
              echo "Records inserted successfully." . "<br>" . "please refresh this page";
            } else{
              // echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
              echo "The user creation failed";
            }
            
            // Close connection
            mysqli_close($connection);
            }

            else{
              echo "<h3>please input both details</h3>";
            }

          }
        
          
          
          
          ?>

          
        </div>
      </div>
    <!-- internal user department actions ends here-->

    <div class="p-3 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
          <h1 class="display-5 fw-bold">Account's history</h1>
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
                
                $queryfundstransfers = "SELECT * FROM FundsTransfers WHERE Transfer_account = {$db_AccID} ";

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
