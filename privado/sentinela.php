<?php 

if (isset($_SESSION['login'])) {
    $loginSent = "valido";
}else {
    header("location: ../index.php");
}