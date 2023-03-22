<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");
    session_start();
    $user = $_SESSION['user'];
    $email = $user['Email'];

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_time = new DateTime('now');
    $date_logout = $current_time->format("Y-m-d H:i:s");

    $sql = "UPDATE customers set Date_Logout = '$date_logout' where Email = '$email'";
    $query = mysqli_query($conn, $sql);

    unset($_SESSION['user']);
    session_destroy();

    header('Location:login.php');
?>