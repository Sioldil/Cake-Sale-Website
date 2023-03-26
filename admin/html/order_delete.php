<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }

    $query = "DELETE from  oders  WHERE OderId = $id";
    $delete = mysqli_query($conn, $query);
    
    if($delete){
        echo '<script language="javascript">';
        echo 'alert("Đặt hàng thất bại!!!")';
        echo '</script>';
        header('location: order_list.php');
    }else{
        echo "xảy ra lỗi khi xóa";
    }


?>