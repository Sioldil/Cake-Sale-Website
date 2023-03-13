<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/header.php');
include($_SERVER['DOCUMENT_ROOT'] . "/admin/inc/navbar.php");
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $sql1 = "SELECT * FROM category";
    $categorys = mysqli_query($conn, $sql1);

    $sql2 = "SELECT * FROM brands";
    $brands = mysqli_query($conn, $sql2);

    $query = "SELECT * FROM Products Where ProductId = '$id'";

    $data = mysqli_query($conn, $query);

    $product = mysqli_fetch_assoc($data);
}


if (isset($_POST['submit'])) {

    $sql = "SELECT Image from products where ProductId = '$id'";
    $image_name = mysqli_query($conn, $sql);

    $name = $_POST['name'];
    $id_brands = $_POST['id_brands'];
    $id_categories = $_POST['id_categories'];
    $buy_price = $_POST['buy_price'];
    $sell_price = $_POST['sell_price'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $id_categories = $_POST['id_categories'];
    $id_brands = $_POST['id_brands'];

    if (isset($_FILES['image'])) {

        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_name;


        move_uploaded_file($file_tmp, "..//uploads//" . $unique_image);

        //Kiểm tra người dùng chọn file hay chưa
        if (!empty($file_name)) {
            // $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
            // $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            // if (!array_key_exists($ext, $allowed)) {
            //     echo "<script>alert('Lỗi: Vui lòng chọn định dạng tệp hợp lệ.');</script>";
            // } else if ($file_size > 5120) {
            //     echo "<script>alert('Lỗi kích thước tệp lớn hơn giới hạn cho phép (Chọn tệp < 5mb)');</script>";
            // } 
            $query =  "UPDATE `products` SET `Name`='$name',`Image`='$unique_image',`Quantity`='$quantity',`Description`='$description',
                    `BuyPrice`='$buy_price',`SellPrice`='$sell_price',`Status`='$status',`CategoriId`='$id_categories',`BrandId`='$id_brands' WHERE ProductId = '$id'";
            $update = mysqli_query($conn, $query);
        } else {
            //người dùng chưa chọn file hay chưa
            $query = "UPDATE `products` SET `Name`='$name',`Quantity`='$quantity',`Description`='$description',
                         `BuyPrice`='$buy_price',`SellPrice`='$sell_price',`Status`='$status',`CategoriId`='$id_categories',`BrandId`='$id_brands' WHERE ProductId = '$id'";
            $update = mysqli_query($conn, $query);
        }

        if ($update) {
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
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['Name'] ?>" placeholder="Bánh kem Le Castella" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thương hiệu</label>
                                <select name="id_brands" class="form-control" id="">
                                    <option value="">--------------Loại thương hiệu--------------</option>
                                    <?php foreach ($brands as $key => $value) { ?>
                                        <option value="<?php echo $value["BrandId"] ?>" <?php echo (($value['BrandId'] == $product['BrandId']) ? 'selected' : '') ?>>
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
                                        <option value="<?php echo $value["CategoryId"] ?>" <?php echo (($value['CategoryId'] == $product['CategoriId']) ? 'selected' : '') ?>>
                                            <?php echo $value["CategoryName"] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh</label>
                                <input type="file" class="form-control mb-4" id="image" name="image" value="<?php echo $product['Image'] ?>" />
                                <img src="..//uploads//<?php echo $product['Image'] ?>" alt="" width="150">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <input type="text" class="form-control" name="description" value="<?php echo $product['Description'] ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá nhập</label>
                                <input type="text" class="form-control" name="buy_price" value="<?php echo $product['BuyPrice'] ?>" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Giá bán</label>
                                <input type="text" class="form-control" name="sell_price" value="<?php echo $product['SellPrice'] ?> " required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Số lượng</label>
                                <input type="text" class="form-control" name="quantity" value="<?php echo $product['Quantity'] ?> " required />
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
                            <button type="submit" name="submit" class="btn btn-success mt-4">Sửa</button>
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