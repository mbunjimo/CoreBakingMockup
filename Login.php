<?php
session_start();
?>

<?php include "db.php"?>


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
        background-image: url("public/image/bankBackground.jpg");
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
    
<main class="form-signin">
  <div style="background: white;" class="p-3">
  <form action="Login.php"method="post">
  <img class="mb-4" src="./public/image/eco.jpg" alt="" width="240" height="100">
    <h1 class="h3 mb-3 fw-normal">Corebanking system internal user's login</h1>
    <br>
    <br>
    <h1 class="h3 mb-3 fw-normal">Welcome</h1>

    <div class="form-floating">
      <input type="number" class="form-control" name="userID" id="floatingInput" placeholder="UserID">
      <label for="floatingInput">User ID</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>

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
    
    } else if ( $userID == $db_userid && $password == $db_userpassword && $db_roles == 'INTERNAL USER' ) {

      $_SESSION['internaluserID'] = $db_userid;

      header("Location: /corebankingsys/operations.php");

    } else if ( $userID == $db_userid && $password == $db_userpassword && $db_roles == 'TELLER' ) {

      $_SESSION['TellerID'] = $db_userid;

      header("Location: /corebankingsys/teller.php");

    }  else if ( $userID == $db_userid && $password == $db_userpassword && $db_roles == 'ADMINISTRATOR') {

      $_SESSION['admin'] = $db_userid;

      header("Location: /corebankingsys/Admin1.php");
    
    } else {
      
      echo "Login failed";
    }

  } else{

    echo "To login, press submit";
  }
  ?>
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
  </div>
</main>


    
  </body>
</html>
