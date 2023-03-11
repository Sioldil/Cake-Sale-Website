<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/header(not template).php');
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM Brands WHERE BrandId = '$id'";

    $data = mysqli_query($conn, $query);

    $brand = mysqli_fetch_assoc($data);
}


if (isset($_POST['name'])) {

    $name = $_POST['name'];

    if (isset($_FILES['image'])) {
        $file_name = $_FILES['image']['name'];
        $file_tmp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_name;


        move_uploaded_file($file_tmp, "..//uploads//" . $unique_image);

        if (!empty($file_name)) {
            $query = "UPDATE Brands set BrandName='$name', Image='$unique_image' where BrandId='$id'";
            $update = mysqli_query($conn, $query);
        } else {
            $query = "UPDATE Brands set BrandName='$name' where BrandId='$id'";
            $update = mysqli_query($conn, $query);
        }
        if ($update) {
            header('location: brand_list.php');
        } else {
            echo "Có lỗi khi cập nhật thương hiệu";
        }
    } else {
        $query = "UPDATE Brands set BrandName='$name' where BrandId='$id'";
        $update = mysqli_query($conn, $query);

        if ($update) {
            header('location: brand_list.php');
        } else {
            echo "Có lỗi khi cập nhật thương hiệu";
        }
    }
}

?>

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"> Sửa thương hiệu</h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên thương hiệu</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $brand['BrandName'] ?>" />
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
                                    <label class="form-label" for="image">Hình ảnh</label>
                                    <input type="file" class="form-control mb-4" id="image" name="image" />
                                    <img src="..//uploads//<?php echo $brand['Image'] ?>" alt="" width="250">
                                </div>
                            </div>
                            <button type="submit" name='submit' class="btn btn-primary">Lưu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/footer.php');
?>