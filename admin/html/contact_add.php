<?php
include($_SERVER['DOCUMENT_ROOT'] . "/admin/inc/header.php");
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
        echo "Dữ liệu rỗng";
    } else {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $query = "INSERT INTO Contacts (UserName,Email,Message) Value('$name','$email','$message')";
        $data = mysqli_query($conn, $query);

        if ($data) {
            header("location: contact_list.php");
        } else {
            echo "Xảy ra lỗi khi thêm mới";
        }
    }
}

?>

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"> Thêm Phản Hồi</h4>
        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="contact_add.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên người dùng</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nguyễn Văn A" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="abc@gmail.com" required />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="message">Nội dung</label>
                                <input type="text" class="form-control" id="message" name="message" placeholder="Nội dung" required />
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
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