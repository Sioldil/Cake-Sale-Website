<?php
    include($_SERVER['DOCUMENT_ROOT'] . "/admin/inc/header(not template).php");
    include($_SERVER['DOCUMENT_ROOT'] . "/classes/brands.php");
?>

<?php
  $class = new Brands();
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    //Lấy tất cả dữ liệu khi ấn submid và dùng phương thức Post
    $insert_brand = $class -> insert_Brand($_POST, $_FILES);
  }
?>

<div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"> Thêm mới thương hiệu</h4>
              <!-- Basic Layout -->
              <div class="row">
                <div class="col-xl">
                  <div class="card mb-4">
                    <div class="card-body">
                      <form action="brand_add.php" method="POST" enctype="multipart/form">
                        <div class="mb-3">
                          <label class="form-label" for="brand_name">Tên thương hiệu</label>
                          <input type="text" class="form-control" id="brand_name" name="brand_name" placeholder="Bánh kem Le Castella" required />
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="image">Hình ảnh</label>
                          <input type="file" class="form-control"  id="image" name="image" placeholder="Bánh kem Le Castella" required />
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
    include($_SERVER['DOCUMENT_ROOT'] . "/admin/inc/footer.php");
?>