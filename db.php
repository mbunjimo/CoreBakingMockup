<?php 


$connection = mysqli_connect('localhost', 'root', '' , 'ecobankcorebankingsystem'); 

if ($connection ){
    // echo "we are connected";
}else{
    die ("database connection failed");

}


?>