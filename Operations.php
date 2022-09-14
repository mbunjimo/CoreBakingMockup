<!-- use a switch statement to select actions selected by the operations
i.e create customer, transfer funds -->

<!-- change the name of the page to internalusershome.php -->

<?php
    
    // if (isset($_POST['Create_a_new_customer'])){

    //  header("Location: /corebankingsys/CreateNewCust.php");
  
    // }

    // if (isset($_POST['Create_an_account'])){

    //   header("Location: /corebankingsys/CreateNewAcc.php");

    // }

    // if (isset($_POST['Transfer_funds'])){

    //   header("Location: /corebankingsys/TransferFunds.php");

    // }

    // if (isset($_POST['Manage_accounts'])){

    //   header("Location: /corebankingsys/manageAcc1.php");

    // }

    // if (isset($_POST['Change_password'])){

    //   header("Location: /corebankingsys/chngCustpassword.php");

    // }
    
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
        <span class="fs-4">Operations page</span>
      </a>
    </header>

    <div class="p-5 mb-4 bg-light rounded-3">
      <div class="container-fluid py-3">
        <h1 class="display-5 fw-bold">Welcome Internal User's name</h1>
        <p class="col-md-8 fs-4">internal user ID:</p>
        <p class="col-md-8 fs-4">Department:</p>
      </div>
    </div>

    <!-- internal user department actions start here-->
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold">Actions</h1>
         <form action="Login.php" method="post">


        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
               <a href="CreateNewCust.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Create a new customer </h4>
              </a>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
              <a href="CreateNewAcc.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Create an account </h4>
              </a>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
              <a href="TransferFunds.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Transfer funds </h4>
              </a>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
              <a href="manageAcc1.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Manage accounts </h4>
              </a>        
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 col-lg-4 mb-4">
          <div class="card text-white card-has-bg click-col " >
            <div class=" d-flex flex-column bg-dark">
              <a href="IntUserChngpassword.php" class="card-body card-title mt-0 " style="text-decoration: none; color:white;"> 
              <h4> Change password </h4>
              </a>  
            </div>
          </div>
        </div>
        </form>

        </div>
      </div>
    <!-- internal user department actions ends here-->


    <footer class="pt-3 mt-4 text-muted border-top">
      &copy; 2021
    </footer>
  </div>
</main>


    
  </body>
</html>
