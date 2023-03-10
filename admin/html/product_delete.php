<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }

    $query = "DELETE FROM Products WHERE ProductId = $id";
    $delete = mysqli_query($conn, $query);
    
    if($delete){
        header('location: product_list.php');
    }else{
        echo "xảy ra lỗi khi xóa";
    }


?>