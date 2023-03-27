<?php
ob_start();
include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");
include($_SERVER['DOCUMENT_ROOT'] . "/classes/cart.php");

include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/PHPMailer-master/src/PHPMailer.php");
include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/PHPMailer-master/src/SMTP.php");
include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/PHPMailer-master/src/Exception.php");

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

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);  //true: enables exceptions
        try {
            $mail->SMTPDebug = 2;  // 0,1,2: chế độ debug. khi mọi cấu hình đều tớt thì chỉnh lại 0 nhé
            $mail->isSMTP();
            $mail->CharSet  = "utf-8";
            $mail->Host = 'smtp.gmail.com';  //SMTP servers
            $mail->SMTPAuth = true; // Enable authentication
            $nguoigui = 'cake.sale.12345@gmail.com';
            $matkhau = 'ndhung123';
            $tennguoigui = 'cake sale';
            $mail->Username = $nguoigui; // SMTP username
            $mail->Password = $matkhau;   // SMTP password
            $mail->SMTPSecure = 'ssl';  // encryption TLS/SSL 
            $mail->Port = 465;  // port to connect to                
            $mail->setFrom($nguoigui, $tennguoigui);
            $to = "16.05.01h@gmail.com"; // nhập email của người nhân
            $to_name = "hung"; // tên người nhận

            $mail->addAddress($to, $to_name); //mail và tên người nhận  
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Gửi thư từ php';
            $noidungthu = "<b>Chào bạn!</b><br>Chúc an lành!";
            $mail->Body = $noidungthu;
            $mail->smtpConnect(array(
                "ssl" => array(
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                    "allow_self_signed" => true
                )
            ));
            $mail->send();
            echo 'Đã gửi mail xong';
        } catch (Exception $e) {
            echo 'Mail không gửi được. Lỗi: ', $mail->ErrorInfo;
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
                    <h2>Thanh Toán</h2>
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
                                <label for="full_name">Họ và tên</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $user['Fullname'] ?>" required placeholder="Nguyễn Văn A">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['Email'] ?>" required placeholder="nguyenvana@gmail.com">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" name="address" required placeholder="quận x, TP.HCM">
                            </div>
                            <div class="form-group">
                                <label for="number_phone">Số điện thoại</label>
                                <input type="text" class="form-control" id="number_phone" name="number_phone" required placeholder="0123456789">
                            </div>
                            <div class="form-group">
                                <label for="note">Ghi chú</label>
                                <textarea type="text" class="form-control" id="note" name="note" required placeholder="Hàng dễ vỡ xin nhẹ tay !!!"> </textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" name="submit"> Thanh toán</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-1 col-md-1">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="table-responsive text-nowrap">
                            <h4>Thông tin chi tiết đơn hàng</h4>
                            <table class="table" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
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
                                        <td>Tổng tiền</td>
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
            <strong>Vui lòng đăng nhập để mua hàng</strong>
            <a href="login.php?action=checkout">Đăng nhập</a>
        </div>
    <?php } ?>
</section>
<!-- Shop Section End -->

<!-- Map End -->
<?php
include($_SERVER["DOCUMENT_ROOT"] . '/cake-main/inc/footer.php');
?>