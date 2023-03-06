<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/admin/inc/header(not template).php");
    include($_SERVER['DOCUMENT_ROOT'] . "/classes/brands.php");
?>
<?php
  $brand = new Brands();
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
                        $show_brand = $brand->show_Brands();
                        if($show_brand)
                        {
                          $i = 0;
                          while($result = $show_brand->fetch_assoc())
                          {
                            $i++;
                      ?>
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger"></i> <strong><?php echo $i ?></strong></td>
                        <td><?php echo $result['Name'] ?></td>
                        <td><?php echo $result['Image'] ?></td>
                        <td>
                        <button type="button" class="btn btn-danger">
                        <a style="color: white"; href="brand_edit.php">Sửa</a>  
                        </button>
                        <button type="button" class="btn btn-dark">
                        <a style="color: white"; href="brand_delete.php">Xóa</a>  
                        </button>
                        </td>
                      </tr>
                      <?php
                          }
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="mt-4">
                  <button type="button" class="btn btn-info">
                  <a style="color: white"; href="brand_add.php">Thêm Mới</a>  
                  </button>
              </div>
            </div>
          </div>
<?php
    include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/footer.php');
?>