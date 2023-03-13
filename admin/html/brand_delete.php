<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }

    $query = "UPDATE  Brands set Status = 0  WHERE BrandId = $id";
    $delete = mysqli_query($conn, $query);
    
    if($delete){
        header('location: brand_list.php');
    }else{
        echo "xảy ra lỗi khi xóa";
    }


?>