<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/header(not template).php');
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

  if(empty($_POST['name']) && empty($_FILES['photo'])){
    echo "Dữ liệu rỗng";
  }else{
    $name = $_POST['name'];
    if(isset($_FILES['photo'])){
      $file_name =  time() . '_' .$_FILES['photo']['name'];
      $file_tmp = $_FILES['photo']['tmp_name'];
      move_uploaded_file($file_tmp,"..//uploads//".$file_name);
    
      $query = "INSERT INTO Brands(Name,Image) Value('$name','$file_name')";
      $data = mysqli_query($conn, $query);
    
      if ($data) {
        header("location: brand_list.php");
      } else {
        echo "Xảy ra lỗi khi thêm mới";
      }
    }
  }
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
            <form action="brand_add.php" method="POST" enctype="multipart/form-data">
              <div class="mb-3">
                <label class="form-label" for="name">Tên thương hiệu</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Bánh kem Le Castella" required />
              </div>
              <div class="mb-3">
                <label class="form-label">Hình ảnh</label>
                <input type="file" class="form-control" name="photo" required/>
              </div>
              <button type="submit" class="btn btn-primary">Lưu</button>
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