<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");
    unset($_SESSION['user']);
   // unset($_SESSION['cart']);

    header('Location:login.php');
?>