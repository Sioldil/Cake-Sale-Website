<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/inc/header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

$sql = "SELECT * FROM category where status = 1 ";
$categorys = mysqli_query($conn, $sql);

$sql = "SELECT * FROM brands where status = 1";
$brands = mysqli_query($conn, $sql);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $id_brands = $_POST['id_brands'];
    $id_categories = $_POST['id_categories'];
    $buy_price = $_POST['buy_price'];
    $sell_price = $_POST['sell_price'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    if (isset($_FILES['photo'])) {
        $file_name =  time() . '_' . $_FILES['photo']['name'];
        $file_tmp = $_FILES['photo']['tmp_name'];
        move_uploaded_file($file_tmp, "..//uploads//" . $file_name);

        $query = "INSERT INTO `products`(`Name`, `Image`, `Quantity`, `Description`, `BuyPrice`, `SellPrice`, `Status`, `CountView`, `CategoriId`, `BrandId`) 
                      VALUES ('$name','$file_name',' $quantity','$description','$buy_price',' $sell_price','$status','','$id_categories','$id_brands')";
        $data = mysqli_query($conn, $query);

        if ($data) {
            header("location:product_list.php");
        } else {
            echo "Xảy ra lỗi khi thêm mới";
        }
    }
}

?>

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"> Thêm mới sản phẩm</h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="product_add.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Bánh kem Le Castella" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thương hiệu</label>
                                <select name="id_brands" class="form-control" id="">
                                    <option value="">--------------Loại thương hiệu--------------</option>
                                    <?php foreach ($brands as $key => $value) { ?>
                                        <option value="<?php echo $value["BrandId"] ?>">
                                            <?php echo $value["BrandName"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Sản phẩm</label>
                                <select name="id_categories" class="form-control" id="">
                                    <label class="form-label">Loại sản phẩm</label>
                                    <option value="">--------------Loại sản phẩm--------------</option>
                                    <?php foreach ($categorys as  $key => $value) { ?>
                                        <option value="<?php echo $value["CategoryId"] ?>">
                                            <?php echo $value["CategoryName"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control" name="photo" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá nhập</label>
                                <input type="number" class="form-control" name="buy_price" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá bán</label>
                                <input type="number" class="form-control" name="sell_price" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số lượng</label>
                                <input type="number" class="form-control" name="quantity" required />
                            </div>
                            <div class="mp-3">
                                <label class="form-label">Trạng thái</label>
                                </br>
                                <label>
                                    <input type="radio" name="status" value="1" id="status" checked>
                                    Hiện
                                </label>
                                </br>
                                <label>
                                    <input type="radio" name="status" value="0" id="status">
                                    Ẩn
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/inc/footer.php");
?>