<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/auth_header.php");
    include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");
?>
<?php
    if(isset($_POST['submit'])){
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $sql = "SELECT * FROM `customers` where Email = '$email' and Status = 1";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($query);
        $checkEmail = mysqli_num_rows($query);

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $current_time = new DateTime('now');
        $date_login = $current_time->format("Y-m-d H:i:s");

        $err = [];
        
        if($checkEmail == 1){
            $hash_password = md5($password);
            $sql = "SELECT * FROM customers WHERE Password = '$hash_password' LIMIT 1";
            $query = mysqli_query($conn, $sql);
            $checkPassword = mysqli_num_rows($query);
            if($checkPassword == 1){
                $sql = "UPDATE customers set Date_Login = '$date_login' where Email = '$email' and Status = 1";
                $query = mysqli_query($conn, $sql);
                $_SESSION['user'] = $data;
                if(isset($_GET['action'])){
                    $action = $_GET['action'];
                    header('location:'.$action.'.php');
                }else{
                    header('location:index.php');
                }
            }else{
                $err['Password'] = "Mật khẩu không đúng !!!";                
            }
        }else{
            $err['Email'] = "Email không đúng !!!";     
        }
    }
?>

<section class="hero">
        <div class="hero__item set-bg" data-setbg="img/hero/hero-1.jpg">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="class__sidebar">
                        <h5 style="font-family: Callephane; margin-left: 200px;"><img src="img/logo_2.png" alt="">Login</h5>
                        <form method="POST">
                            <input type="text" placeholder="Enter your email" name="Email">
                            <span  class="mt-4 mb-4"><?php echo (isset($err['Email']))? $err['Email'] : ''; ?></span>
                            
                            <input type="password" placeholder="*******" name="Password">
                            <span class="mb-4"><?php echo (isset($err['Password']))? $err['Password'] : ''; ?></span>

                            <button type="submit" name="submit" class="site-btn">Login</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Hero Section End -->

<?php
include($_SERVER["DOCUMENT_ROOT"] . '/cake-main/inc/footer.php');
?>