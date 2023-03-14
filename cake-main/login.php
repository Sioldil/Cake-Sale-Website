<?php
    include ($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/auth_header.php");
    include ($_SERVER['DOCUMENT_ROOT'] . "/classes/user_login.php");
?>
<?php
  $class = new user_login();
  if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $login_check = $class -> login_user($Email,$Password);
  }
?>

<section class="hero">
        <div class="hero__item set-bg" data-setbg="img/hero/hero-1.jpg">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="class__sidebar">
                        <h5 style="font-family: Callephane; margin-left: 200px;"><img src="img/logo_2.png" alt="">Login</h5>
                        <form action="login.php" method="post">
                            <input type="text" placeholder="Enter your email" name="Email">
                            <input type="password" placeholder="*******" name="Password">
                            <button type="submit" class="site-btn">login</button>
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