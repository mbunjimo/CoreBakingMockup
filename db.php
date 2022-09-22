<?php 


$connection = mysqli_connect('localhost', 'root', '' , 'ecobankcbsdb'); 

if ($connection ){
    // echo "we are connected";
}else{
    die ("database connection failed");

}


?>