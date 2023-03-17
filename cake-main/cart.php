<?php
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");
session_start();

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$action = (isset($_GET['action'])) ? $_GET['action'] : 'add';

$quantity = (isset($_GET['quantity'])) ? $_GET['quantity'] : 1;

if($quantity <= 0){
    $quantity = 1;
}

$query = "SELECT *from Products where ProductId = '$id'";

$data = mysqli_query($conn,$query);

if($data){
    $product = mysqli_fetch_assoc($data);
}

$item = [
    'id'=>$product['ProductId'],
    'name'=>$product['Name'],
    'image'=>$product['Image'],
    'sellprice'=>$product['SellPrice'],
    'quantity'=>$quantity
];


//add product to carts
if($action == 'add'){
    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity']+=$quantity;
    }else{
        $_SESSION['cart'][$id] = $item;
    }
}

//update cart
if($action == 'update'){
    $_SESSION['cart'][$id]['quantity']=$quantity;
}

//delete product to cart
if($action == 'delete'){
    unset($_SESSION['cart'][$id]);
}



header('location: view_cart.php');



?>