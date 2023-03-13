<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

    if(isset($_GET['id'])){
      $id = $_GET['id'];
    }

    $query = "DELETE FROM Contacts WHERE ContactId = $id";
    $delete = mysqli_query($conn, $query);
    
    if($delete){
        header('location: contact_list.php');
    }else{
        echo "xảy ra lỗi khi xóa";
    }

?>