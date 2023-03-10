<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/header(not template).php');
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

$query = "SELECT a.ProductId, a.Name, a.Image, c.CategoryName, b.BrandName, a.BuyPrice,a.SellPrice, a.CountView, a.Status 
            FROM `products` a, category c, brands b 
            WHERE a.CategoriId = c.CategoryId and a.BrandId = b.BrandId 
            ORDER BY a.ProductId DESC";
$Products = mysqli_query($conn, $query);

?>

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Danh sách sản phẩm</h4>

        <!-- Basic Bootstrap Table -->
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Loại bánh</th>
                            <th>Thương hiệu</th>
                            <th>Giá nhập</th>
                            <th>Giá bán</th>
                            <th>Số lượt xem</th>
                            <th>Trạng thái</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
                        foreach ($Products as $key => $value) : ?>
                            <tr>
                                <td><?php echo $key + 1 ?></td>
                                <td><?php echo $value['Name'] ?></td>
                                <td>
                                    <img src="..//uploads//<?php echo $value['Image'] ?>" alt="" width="80">
                                </td>
                                <td><?php echo $value['CategoryName'] ?></td>
                                <td><?php echo $value['BrandName'] ?></td>
                                <td><?php echo $value['BuyPrice'] ?></td>
                                <td><?php echo $value['SellPrice'] ?></td>
                                <td><?php echo $value['CountView'] ?></td>
                                <?php if ($value['Status'] == 1) { ?>
                                    <td>Hiện</td>
                                <?php } else { ?>
                                    <td>Ẩn</td>
                                <?php } ?>
                                <td>
                                    <button type="button" class="btn btn-primary">
                                        <a style="color: white" ; href="product_update.php?id=<?php echo $value['ProductId'] ?>">Sửa</a>
                                    </button>
                                    <button type="button" class="btn btn-danger">
                                        <a style="color: white" ; href="product_delete.php?id=<?php echo $value['ProductId'] ?>" onclick="return confirm('Bạn có chắc chắn xóa ?')">Xóa</a>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="mt-4">
            <button type="button" class="btn btn-info">
                <a style="color: white" ; href="product_add.php">Thêm Mới</a>
            </button>
        </div>
    </div>
</div>
<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/footer.php');
?>