<?php
$con=mysqli_connect('localhost','root','database','pos_system');
if($con){
    echo " ";
}else {
    die(mysqli_error("Error"+$con));
}
?>