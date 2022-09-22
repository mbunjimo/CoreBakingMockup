<?php
session_start();
?>

<?php include "db.php" ?>

<?php include "savedfunct.php" ?>

<?php
  
  if (isset($_POST['submit'])){
  
    $CustomerID = $_POST['userID'];
    $password =$_POST['password'];

    $CustomerID = mysqli_real_escape_string($connection , $CustomerID);
    $password = mysqli_real_escape_string($connection , $password);

    $query = "SELECT * FROM Customer WHERE customerID = {$CustomerID}"; //be aware of possible quotation

    $select_user_query = mysqli_query($connection, $query);


    if(!$select_user_query){
      die("QUERY FAILED".mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)){
      
       $db_customerid = $row['customerID'];
       $db_customerpassword = $row['passwords'];

    }


    if ( $CustomerID == $db_customerid ){

      if ( $password == $db_customerpassword ){

        header("Location: /corebankingsys/customer.php");

        $_SESSION['CustomerID'] = $CustomerID;

      } else {
         
       wrongpassword();

      }

    }  else  {

     wrongid();
    
    }

  }
  ?>
<!-- include important things -->


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
    <title>Signin Template · Bootstrap v5.1</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    

    <!-- Bootstrap core CSS -->
<link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

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

    
    <!-- Custom styles for this template -->
    <link href="./public/style.css" rel="stylesheet">
  </head>

  
  <body class="text-center">
    
<main class="form-signin bg-white rounded">
  <form action="CustLogin.php" method="post">
    <img class="mb-4" src="./public/image/eco.jpg" alt="" width="240" height="100">
    <h1 class="h3 mb-3 fw-normal">Ecobank Online Banking System</h1>
    <br>
    <br>
    <p class="h3 mb-3 fw-normal">Login to your account</p>

    <div class="form-floating">
      <input type="number" class="form-control" name="userID" id="floatingInput" placeholder="UserID">
      <label for="floatingInput">User ID</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

    <div class="checkbox mb-3">
      <label>
        <input href="#" type="submit" class="w-100 btn btn-lg btn-primary" name="submit" value="Login">
      </label>
    </div>
    <!-- <a href="./Customer.php">
    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
    </a> -->
    <p class="mt-5 mb-3 text-white">&copy; ecobank core banking system</p>
  </form>
</main>


    
  </body>
</html>
