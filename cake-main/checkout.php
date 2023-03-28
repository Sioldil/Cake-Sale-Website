<?php
ob_start();
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/classes/cart.php");
?>

<?php
$user = $_SESSION['user'];
$class = new Cart();
$cart_totals = $class->total_price($cart);

if (isset($_POST['submit'])) {
    $id_user = $user['CustomerId'];
    $address = $_POST['address'];
    $number_phone = $_POST['number_phone'];
    $note = $_POST['note'];

    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $current_date = new DateTime('now');
    $date_order = $current_date->format("Y-m-d H:i:s");

    $sql = "INSERT INTO oders(CustomerId, Note, order_date, address,number_phone,total_price) VALUES ('$id_user','$note','$date_order','$address','$number_phone','$cart_totals')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $id_order = mysqli_insert_id($conn);
        foreach ($cart as $value) {
            $insert_order_detail = "INSERT INTO `orderdetails`(`Order_Detail_Id`,`ProductId`, `Price`, `Quantity`) VALUES ('$id_order','$value[id]', $value[sellprice], '$value[quantity]')";
            mysqli_query($conn, $insert_order_detail);
        }
        unset($_SESSION['cart']);
        header("location:index.php");
    } else {
        echo '<script language="javascript">';
        echo 'alert("Đặt hàng thất bại!!!")';
        echo '</script>';
    }
}
?>

<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Check Out</h2>
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
    <?php if (isset($_SESSION['user'])) {  ?>
        <div class="container">
            <div class="shop__option">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <form method="post">
                            <div class="form-group">
                                <label for="full_name">User Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $user['Fullname'] ?>" required placeholder="Nguyễn Văn A">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['Email'] ?>" required placeholder="nguyenvana@gmail.com">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required placeholder="quận x, TP.HCM">
                            </div>
                            <div class="form-group">
                                <label for="number_phone">Number Phone</label>
                                <input type="text" class="form-control" id="number_phone" name="number_phone" required placeholder="0123456789">
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea type="text" class="form-control" id="note" name="note" required placeholder="Hàng dễ vỡ xin nhẹ tay !!!"> </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" name="submit">Check Out</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-1 col-md-1">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="table-responsive text-nowrap">
                            <h4 class ="mb-4">Infomation Product Details</h4>
                            <table class="table" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <?php
                                    $stt = 1;
                                    foreach ($cart as $key => $value) : ?>
                                        <tr>
                                            <td><?php echo $stt++ ?></td>
                                            <td><?php echo $value['name'] ?></td>
                                            <td><?php echo $value['quantity'] ?></td>
                                            <td><?php echo $value['sellprice'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td>Total</td>
                                        <td colspan="6" class="text-center bg-infor"><?php echo $cart_totals ?> usd</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Sign in to Purchase</strong>
            <a href="login.php?action=checkout">Login</a>
        </div>
    <?php } ?>
</section>
<!-- Shop Section End -->

<!-- Map End -->
<?php
include($_SERVER["DOCUMENT_ROOT"] . '/cake-main/inc/footer.php');
?>