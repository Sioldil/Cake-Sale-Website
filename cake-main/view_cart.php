<?php
include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

$cart = (isset($_SESSION['cart'])) ? $_SESSION['cart'] : [];

// echo "<pre>";
// var_dump($cart);


?>

<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>View Cart</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="./index.php">Home</a>
                    <a href="./list_product.php">Shop</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
        <div class="table-responsive text-nowrap">
          <table class="table" style="text-align: center">
            <thead>
              <tr>
                <th>STT</th>
                <th>Product Name</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Into Money</th>
                <th></th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <?php
              $stt = 1;
              $total_price = 0;
              foreach ($cart as $key => $value) :
                $total_price += $value['sellprice']  * $value['quantity'];
               ?>
                <tr>
                  <td><?php echo $stt++ ?></td>
                  <td><?php echo $value['name'] ?></td>
                  <td>
                    <img src="..//admin//uploads//<?php echo $value['image'] ?>" alt="" width="120">
                  </td>
                  <td>
                    <form action="cart.php">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $value['id'] ?>">
                        <input  type="text" style="width: 10" name="quantity" value="<?php echo $value['quantity']?>">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </form>
                    </td>
                    <td><?php echo $value['sellprice']?></td>
                    <td><?php echo $value['sellprice']  * $value['quantity']?> USD</td>
                  <td>
                    <button type="button" class="btn btn-danger">
                      <a style="color: white" ; href="cart.php?id=<?php echo $value['id']?>&action=delete" onclick="return confirm('You are want delete ?')">Delete</a>
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td>Total: </td>
                <td colspan="6" class="text-center bg-infor"><?php echo $total_price ?> usd</td>
              </tr>
            </tbody> 
          </table>
          <button class="btn btn-success">
            <a style="color: white;" href="checkout.php">Check Out</a>
          </button>
         
        </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<!-- Map End -->
<?php
include($_SERVER["DOCUMENT_ROOT"] . '/cake-main/inc/footer.php');
?>