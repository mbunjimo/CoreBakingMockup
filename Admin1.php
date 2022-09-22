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

<?php

          $adminID = $_SESSION['admin'];

          $query = "SELECT * FROM InternalUsers WHERE IntuserID = {$adminID}";
          $select_user_query = mysqli_query($connection, $query); 
    
          while($row = mysqli_fetch_assoc($select_user_query)){
    
             $db_intuserFname = $row['IntuserFName'];
             $db_intuserLname = $row['IntuserLName'];
             $db_intuserdept = $row['IntuserDepartment'];
             $db_intuserRole = $row['IntuserRole'];
    
          }
    

          //to edit an internal users
          
          if (isset($_POST['submit'])){

            $_SESSION['IntuserIDno'] = $_POST['IntuserIDno'];

            if ( $_SESSION['IntuserIDno'] ) {

              header("Location: /corebankingsys/editintuser.php");

            } else {
              echo "please Enter Internal user ID Edit";
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
      <form action="Admin1.php" method="post">
      <input type="submit" name="logout" class=" btn btn-info pb-3 px-5 mb-2 border-bottom " value="Log out">
      </form>
    </header>

    <div class="p-2 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">welcome, <?php echo $db_intuserFname ?> <?php echo $db_intuserLname ?>;</h1>
        <p class="col-md-8 fs-4">Department: <?php echo $db_intuserdept ?></p>
        <p class="col-md-8 fs-4">Role: <?php echo $db_intuserRole ?> </p>

      </div>
    </div>

    <!--all your internal users -->
    <div class="p-3 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
          <h1 class="display-5 fw-bold">manage internal user's</h1>
        <p class="col-md-8 fs-4">All internal users</p>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th scope="col">Internal user's ID</th>
                  <th scope="col">INTUSER First Name</th>
                  <th scope="col">INTUSER Last Name</th>
                  <th scope="col">INTUSER Department</th>
                  <th scope="col">INTUSER Role</th>
                </tr>
              </thead>
              <tbody>

                <?php
                
                $query = 'SELECT * FROM internalusers';

                $result = mysqli_query($connection, $query);

               mysqli_num_rows($result);

                while( $record = mysqli_fetch_assoc($result)){

                ?>

              <tr>
				          <!--FETCHING DATA FROM EACH
					              ROW OF EVERY COLUMN-->
		            		<td><?php echo $record['IntuserID'];?></td>
				            <td><?php echo $record['IntuserFName'];?></td>
				            <td><?php echo $record['IntuserLName'];?></td>
				            <td><?php echo $record['IntuserDepartment'];?></td>
				            <td><?php echo $record['IntuserRole'];?></td>
			        </tr>
			         <?php
                }
			        ?>
              </tbody>
            </table>
          </div>
  
        </div>
      </div>

      <!-- select Internal user to change its details -->

      <div class="p-2 mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
          
            <h6 class="display-5 pt-5">Enter Internal user's ID:</h6>
            <p class="col-md-8 fs-4">Enter ID to change details</p>
          
          
            <form action="Admin1.php" method="post">
              <div class="input-group mb-3">
                <input type="number" class="form-control" aria-label="The internal users id" name="IntuserIDno">
              </div>
              <!-- <a href="editintuser.php"> -->
                <input class="w-50 btn btn-success btn-lg" type="submit" name="submit" value="submit ID">
              <!-- </a> -->
            </form>

        </div>
      </div>

      <!-- select Internal user to change its details -->

      <!-- create new internal user starts here -->  

      <div class=" mb-4 bg-light rounded-3">
        <div class="container-fluid py-3">
          
            <h6 class="display-5 pt-3">Create a new internal user:</h6>
            <a href="CreateNewIntUser.php">
            <input name="newThread" type="button" class="w-50 btn btn-success btn-lg"  value="create new internal user"/>
            </a>  
        </div>
      </div>

    

      <!-- create new internal user ends here -->


     <footer class="pt-3 mt-4 text-muted border-top">
         &copy; 2021
     </footer>

   </div>
  </main>
 
  </body>
</html>
