<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/header(not template).php');
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

  $query = "SELECT * FROM Brands";
  $Brands = mysqli_query($conn, $query);

?>

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Thương hiệu bánh</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên thương hiệu</th>
              <th>Hình ảnh</th>
              <th>Chức năng</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php
            foreach ($Brands as $key => $value) : ?>
              <tr>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $value['BrandName'] ?></td>
                <td>
                  <img src="..//uploads//<?php echo $value['Image']?>" alt="" width="80">
                </td>
                <td>
                  <button type="button" class="btn btn-primary">
                    <a style="color: white" ; href="brand_update.php?id=<?php echo $value['BrandId'] ?>">Sửa</a>
                  </button>
                  <button type="button" class="btn btn-danger">
                    <a style="color: white" ; href="brand_delete.php?id=<?php echo $value['BrandId'] ?>" 
                    onclick="return confirm('Bạn có chắc chắn xóa ?')">Xóa</a>
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
        <a style="color: white" ; href="brand_add.php">Thêm Mới</a>
      </button>
    </div>
  </div>
</div>
<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/footer.php');
?>