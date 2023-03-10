<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/header(not template).php');
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

$sql = "SELECT * FROM category";
$categorys = mysqli_query($conn, $sql);

$sql = "SELECT * FROM brands";
$brands = mysqli_query($conn, $sql);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
  
    $query ="SELECT * FROM Products Where ProductId = '$id'";
  
    $data = mysqli_query($conn, $query);
  
    $product = mysqli_fetch_assoc($data);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $id_brands = $_POST['id_brands'];
    $id_categories = $_POST['id_categories'];
    $buy_price = $_POST['buy_price'];
    $sell_price = $_POST['sell_price'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    $description = $_POST['description'];

    // if (isset($_FILES['photo'])) {
    //     $file_name =  time() . '_' . $_FILES['photo']['name'];
    //     $file_tmp = $_FILES['photo']['tmp_name'];
    //     move_uploaded_file($file_tmp, "..//uploads//" . $file_name);

    //     $query = "UPDATE Brands set Name='$name' where BrandId='$id'";
    //     $update = mysqli_query($conn, $query);

    //     if ($update) {
    //         header("location:product_list.php");
    //     } else {
    //         echo "Xảy ra lỗi khi thêm mới";
    //     }
    // }
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
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['Name']?>" placeholder="Bánh kem Le Castella" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thương hiệu</label>
                                <select name="id_brands" class="form-control" id="">
                                    <option value="">--------------Loại thương hiệu--------------</option>
                                    <?php foreach ($brands as $key => $value) { ?>
                                        <option value="<?php echo $value["BrandId"] ?>"
                                        <?php echo (($value['BrandId'] == $product['BrandId']) ? 'selected' : '') ?>>
                                            <?php echo $value["BrandName"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Loại bánh</label>
                                <select name="id_categories" class="form-control" id="">
                                    <option value="">--------------Loại bánh--------------</option>
                                    <?php foreach ($categorys as  $key => $value) { ?>
                                        <option value="<?php echo $value["CategoryId"] ?>"
                                        <?php echo (($value['CategoryId'] == $product['CategoriId']) ? 'selected' : '') ?>>
                                            <?php echo $value["CategoryName"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control mb-4" id="image" name="image"  value="<?php echo $product['Image'] ?>" required/>
                                <img src="..//uploads//<?php echo $product['Image']?>" alt="" width="250">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <input type="text" class="form-control" name="description" value="<?php echo $product['Description']?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá nhập</label>
                                <input type="text" class="form-control" name="buy_price" value="<?php echo $product['BuyPrice']?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá bán</label>
                                <input type="text" class="form-control" name="sell_price" value="<?php echo $product['SellPrice']?> "required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số lượng</label>
                                <input type="text" class="form-control" name="quantity" value="<?php echo $product['Quantity']?> "required />
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