<?php
include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/header.php");

include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT *FROM Products p, Category c where p.status = 1 and c.status = 1
     and c.CategoryId = p.CategoriId and CategoryId = '$id'";
    $Products = mysqli_query($conn, $query);

 
    $query2 = "SELECT *FROM  Category where status = 1";
    $Category = mysqli_query($conn, $query2);

    $query3 = "SELECT *FROM  Category where status = 1 and CategoryId = '$id'  ";
    $test = mysqli_query($conn, $query3);

    $data = mysqli_fetch_assoc($test);

}

?>

<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__text">
                    <h2>Shop</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="breadcrumb__links">
                    <a href="./index.html">Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="shop__option">
            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <div class="shop__option__search">
                        <form action="" method="GET">
                            <select name="id_category" id="id_category" onchange="location = this.value;">
                                <option value=""><?php echo $data['CategoryName'] ?></option>
                                <?php foreach ($Category as $key => $value) { ?>
                                    <option value='list_product_by_category.php?id=<?php echo $value["CategoryId"] ?>'>
                                        <?php echo $value["CategoryName"] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <input type="text" placeholder="Search">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="shop__option__right">
                        <select style="display: none;">
                            <option value="">Default sorting</option>
                            <option value="">A to Z</option>
                            <option value="">1 - 8</option>
                            <option value="">Name</option>
                        </select>
                        <div class="nice-select" tabindex="0"><span class="current">Default sorting</span>
                            <ul class="list">
                                <li data-value="" class="option selected">Default sorting</li>
                                <li data-value="" class="option">A to Z</li>
                                <li data-value="" class="option">1 - 8</li>
                                <li data-value="" class="option">Name</li>
                            </ul>
                        </div>
                        <a href="#"><i class="fa fa-list"></i></a>
                        <a href="#"><i class="fa fa-reorder"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php foreach ($Products as $key => $value) : ?>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="product__item">
                        <div class="product__item__pic set-bg">
                            <a href="product_detail.php?id=<?php echo $value['ProductId'] ?> ">
                                <img src="..//admin//uploads//<?php echo $value['Image'] ?>" alt="Chi tiết sản phẩm">
                            </a>
                            <div class="product__label">
                                <!-- <span>Cupcake</span> -->
                            </div>
                        </div>
                        <div class="product__item__text">
                            <h6> <a href="product_detail.php?id=<?php echo $value['ProductId'] ?>"><?php echo $value['Name'] ?></a></h6>
                            <h5>Giá <?php echo $value['SellPrice'] . ' $USD' ?></h5>
                            <div>
                                <button class="btn primary-btn mt-4">
                                    <a style="color: white" href="cart_add.php">Thêm giỏ hàng</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="shop__last__option">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="shop__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><span class="arrow_carrot-right"></span></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="shop__last__text">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<!-- Map End -->
<?php
include($_SERVER["DOCUMENT_ROOT"] . '/cake-main/inc/footer.php');
?>