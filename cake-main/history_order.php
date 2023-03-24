<?php
ob_start();
error_reporting(E_ERROR | E_PARSE);
include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/classes/cart.php");

//kiểm tra người dùng đăng nhập hay chưa ?
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $id_user = $user['CustomerId'];
    $query = "SELECT * FROM `oders` o, orderdetails a, products p 
                where o.OderId = a.Order_Detail_Id and p.ProductId = a.ProductId and o.CustomerId = '$id_user'";
    $data = mysqli_query($conn, $query);
    $order = mysqli_fetch_assoc($data);
}else{
    $user = [];
}
?>

<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Lịch Sử Mua Hàng</h2>
                </div>
                <div class="breadcrumb__text mt-4" >
                    <p>Ngày đặt hàng: <?php echo $order['order_date'] ?> </p>
                </div>
                <p>Trạng thái đơn hàng:
                            <?php if ($order['status'] == 0) { ?>
                                Chưa xử lý
                            <?php } else if ($order['status'] == 1) { ?>
                                Đang xử lý
                            <?php } else if ($order['status'] == 2) { ?>
                                Thành công
                 <?php } ?>
                </p>
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
<?php if (isset($_SESSION['user'])) {  ?>
    <div class="container">
        <div class="row">
        <div class="table-responsive text-nowrap">
          <table class="table" style="text-align: center">
            <thead>
              <tr>
                <th>STT</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <?php
              $stt = 1;
              $total_price = 0;
              foreach ($data as $key => $value) :
                $total_price += $value['Price']  * $value['Quantity'];
               ?>
                <tr>
                  <td><?php echo $stt++ ?></td>
                  <td><?php echo $value['Name'] ?></td>
                  <td>
                    <img src="..//admin//uploads//<?php echo $value['Image'] ?>" alt="" width="120">
                  </td>
                    <td><?php echo $value['Quantity']?></td>
                    <td><?php echo $value['Price']?></td>
                    <td><?php echo $value['Price']  * $value['Quantity']?> USD</td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td>Tổng tiền</td>
                <td colspan="6" ><?php echo $total_price ?> usd</td>
              </tr>
            </tbody> 
          </table>
        </div>
        </div>
    </div>
    <?php } else { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Vui lòng đăng nhập để xem lịch sử mua hàng</strong>
            <a href="login.php">Đăng nhập</a>
        </div>
    <?php } ?>
</section>
<!-- Shop Section End -->

<!-- Map End -->
<?php
include($_SERVER["DOCUMENT_ROOT"] . '/cake-main/inc/footer.php');
?>