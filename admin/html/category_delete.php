<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }

    $query = " UPDATE Category SET status = 0 WHERE CategoryId = '$id'";
    $delete = mysqli_query($conn, $query);
    
    if($delete){
        header('location: category_list.php');
    }else{
        echo "xảy ra lỗi khi xóa";
    }


?>