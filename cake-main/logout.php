<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");
    session_start();
    unset($_SESSION['user']);

    header('Location:login.php');
?>