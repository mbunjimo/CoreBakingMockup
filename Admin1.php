<?php
session_start();
?>

<?php  include "db.php" 

?>

<?php
          
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
    <header class="pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
        <span class="fs-4">Administrator's page</span>
      </a>
    </header>

    <div class="p-2 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Admin details;</h1>
        <p class="col-md-8 fs-4">Admin name: </p>
        <p class="col-md-8 fs-4">Internal user's ID: </p>

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

                echo mysqli_num_rows($result);

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
