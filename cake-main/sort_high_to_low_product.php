<?php
include($_SERVER['DOCUMENT_ROOT'] . "/cake-main/inc/header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

$query = "SELECT *FROM Products where status = 1 and is_accept = 1 order by SellPrice DESC";
$Products = mysqli_query($conn, $query);

$query1 = "SELECT *FROM Category where status = 1";
$Category = mysqli_query($conn, $query1);


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
                    <a href="./index.php">Home</a>
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
                        <form action="search_product.php" method="POST">
                            <select name="id_category" id="id_category" onchange="location = this.value;">
                                <option value="">Category</option>
                                <?php foreach ($Category as $key => $value) { ?>
                                    <option value='list_product_by_category.php?id=<?php echo $value["CategoryId"] ?>'>
                                        <?php echo $value["CategoryName"] ?>
                                    </option>
                                <?php } ?>
                            </select>
                                <input type="text" name="search" class="form-control rounded" placeholder="Search"/>
                                <button class="btn btn-primary" type ="submit" name="submit">Search</button>
                        </form>
                    </div>

                </div>
                <div class="col-lg-5 col-md-5">
                    <div class="shop__option__right">
                        <select onchange="document.location.href=this.value">
                            <option value="">Price sorting</option>
                            <option value="sort_high_to_low_product.php">High to Low</option>
                            <option value="sort_low_to_high_product.php">Low to High</option>
                        </select>
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
                            <h5>Price <?php echo $value['SellPrice'] . ' $USD' ?></h5>
                            <div>
                                <button class="btn primary-btn mt-4">
                                    <a style="color: white" href="cart.php?id=<?php echo $value['ProductId'] ?>">Add to Cart</a>
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