<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/auth_header.php");
    include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");
    session_start();
?>
<?php
    if(isset($_POST['submit'])){
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        $sql = "SELECT * FROM customers where Email = '$email'";
        $query = mysqli_query($conn, $sql);
        $data = mysqli_fetch_assoc($query);
        $checkEmail = mysqli_num_rows($query);
        if($checkEmail == 1){
            $hash_password = md5($password);
            $sql = "SELECT * FROM customers where password = '$hash_password'";
            $result = mysqli_query($conn, $sql);
            if($result){
                $_SESSION['user'] = $data;
                if(isset($_GET['action'])){
                    $action = $_GET['action'];
                    header('location:'.$action.'.php');
                }else{
                    header('location:index.php');
                }
            }else{
                echo "<script>alert(`Mật khẩu không đúng !`) </script>";
                header('location:login.php');
            }
        }else{
            echo "<script>alert(`Email không đúng !`) </script>";
            header('location:login.php');
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
                            <input type="password" placeholder="*******" name="Password">
                            <button type="submit" name="submit" class="site-btn">login</button>
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