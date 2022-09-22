<?php


function customerLogout() {
    
    session_destroy();

    
        header("Location: /corebankingsys/CustLogin.php");


  }

  function operationsLogout() {
    
    session_destroy();

    
        header("Location: /corebankingsys/Login.php");
  

  }

?>