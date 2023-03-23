<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/auth_header.php");
    include($_SERVER['DOCUMENT_ROOT'] . "/classes/user_register.php");
?>
<?php
$ad = new user_register();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $insertUser = $ad->insert_user($_POST);
}
?>
<section class="hero">
        <div class="hero__item set-bg" data-setbg="img/hero/hero-1.jpg">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6">
                        <div class="class__sidebar">
                        <h5 style="font-family: Callephane; margin-left: 200px;"><img src="img/logo_2.png" alt="">Register</h5>
                        <form action="register.php" method="post">
                            <input type="text" placeholder="Enter your name" name="Fullname">
                            <input type="text" placeholder="Enter your email" name="Email">
                            <input type="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" name="Password">
                            <button type="submit" class="site-btn">register</button>
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