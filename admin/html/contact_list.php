<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/header.php');
include($_SERVER['DOCUMENT_ROOT'] . "/admin/inc/navbar.php");
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

  $query = "SELECT * FROM Contacts";
  $Contacts = mysqli_query($conn, $query);

?>

<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">Danh sách phản hồi</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
      <div class="table-responsive text-nowrap">
        <table class="table">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên người dùng</th>
              <th>Email</th>
              <th>Nội dung</th>
              <th>Chức năng</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php
            foreach ($Contacts as $key => $value) : ?>
              <tr>
                <td><?php echo $key + 1 ?></td>
                <td><?php echo $value['UserName'] ?></td>
                <td><?php echo $value['Email'] ?></td>
                <td><?php echo $value['Message'] ?></td>
                <td>
                  <button type="button" class="btn btn-danger">
                    <a style="color: white"; href="contact_delete.php?id=<?php echo $value['ContactId'] ?>" 
                    onclick="return confirm('Bạn có chắc chắn xóa ?')">Xóa</a>
                  </button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<?php
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/footer.php');
?>