<?php include "db.php"?>

<?php
  
  if (isset($_POST['submit'])){
  
    $userID = $_POST['userID'];
    $password =$_POST['password'];


    $userID = mysqli_real_escape_string($connection , $userID);
    $password = mysqli_real_escape_string($connection , $password);

    $query = "SELECT * FROM internalusers WHERE IntuserID = {$userID}"; //be aware of possible quotation

    $select_user_query = mysqli_query($connection, $query);


    if(!$select_user_query){
      die("QUERY FAILED".mysqli_error($connection));
    }

    while($row = mysqli_fetch_array($select_user_query)){
      
       $db_userid = $row['IntuserID'];
       $db_userpassword = $row['passwords'];
       $db_roles = $row['IntuserRole'];

    }

    if ( $userID !== $db_userid && $password !== $db_userpassword ){

      header("Location: /corebankingsys/login.php");
    
    } else if ( $userID == $db_userid && $password == $db_userpassword && $db_roles !== 'ADMINISTRATOR' ) {

      header("Location: /corebankingsys/operations.php");

    }  else if ( $userID == $db_userid && $password == $db_userpassword && $db_roles == 'ADMINISTRATOR') {

      header("Location: /corebankingsys/Admin1.php");
    
    }

  }
  ?>
<!-- include important things -->


<!doctype html>
<html lang="en">
  <head>
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
    
<main class="form-signin">
  <form action="Login.php"<?php
          
          if (isset($_POST['submit'])){

            $_SESSION['IntuserIDno'] = $_POST['IntuserIDno'];

            if ( $_SESSION['IntuserIDno'] ) {

              header("Location: /corebankingsys/editintuser.php");

            } else {
              echo "please Enter Internal user ID Edit";
            }
                
          }
          
          ?>
 method="post">
    <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Welcome</h1>

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
    <p class="mt-5 mb-3 text-muted">&copy; ecobank core banking system</p>
  </form>
</main>


    
  </body>
</html>
