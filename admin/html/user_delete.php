<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }

    $query = "UPDATE Customers SET status = 0 WHERE CustomerId = $id";
    $delete = mysqli_query($conn, $query);
    
    if($delete){
        header('location: user_list.php');
    }else{
        echo "xảy ra lỗi khi xóa";
    }


?>