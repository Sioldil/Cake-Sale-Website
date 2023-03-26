<?php
ob_start();
include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/header.php');
include($_SERVER['DOCUMENT_ROOT'] . "/admin/inc/navbar.php");
include($_SERVER['DOCUMENT_ROOT'] . "/database/connect.php");

if (isset($_GET['id'])) {
    $id_order = $_GET['id'];

    $query = "SELECT * FROM oders where OderId = '$id_order'";
    $order_query = mysqli_query($conn, $query);
    $order = mysqli_fetch_assoc($order_query);

    $id_custommer = $order['CustomerId'];

    $custommer_query = mysqli_query($conn, "SELECT * from customers where CustomerId = '$id_custommer'");
    $customer = mysqli_fetch_assoc($custommer_query);

    $products_query = "SELECT a.Quantity, a.Price, p.Image, p.Name  FROM orderdetails a, products p, oders o 
                where a.ProductId = p.ProductId  and a.Order_Detail_Id = o.OderId and o.OderId = '$id_order'";
    $products = mysqli_query($conn, $products_query);

    if (isset($_POST['submit'])) {
        $status = $_POST['status'];
        $query = "UPDATE oders set status = '$status' WHERE  OderId = '$id_order'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header("location: order_list.php");
        } else {
            echo "xảy ra lỗi";
        }
    }
}

?>
<div class="layout-page">
    <!-- Navbar -->

    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block"><?php echo session::get('Username') ?></span>
                                        <small class="text-muted">Admin</small>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">My Profile</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Settings</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <span class="d-flex align-items-center align-middle">
                                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                    <span class="flex-grow-1 align-middle">Billing</span>
                                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="?action=logout">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="panel panel-infor">
                    <div class="panel-heading">
                        <h3 class="panel-title">Thông tin khách hàng</h3>
                    </div>
                    <div class="panel-body text-left">
                        <p>Tên khách hàng: <?php echo $customer['Fullname'] ?></p>
                        <p>Số điện thoại: <?php echo $order['number_phone'] ?></p>
                        <p>Địa chỉ nhận hàng: <?php echo $order['address'] ?></p>
                        <p>Ngày đặt hàng: <?php echo $order['order_date'] ?></p>
                        <p>Ghi chú của khách hàng: <?php echo $order['Note'] ?> </p>
                        <p>Trạng thái đơn hàng:
                            <?php if ($order['status'] == 0) { ?>
                                chưa xử lý
                            <?php } else if ($order['status'] == 1) { ?>
                                đang xử lý
                            <?php } else if ($order['status'] == 2) { ?>
                                thành công
                            <?php } ?>
                        </p>
                    </div>
                </div>
            </div>
            <!-- Basic Bootstrap Table -->
            <div class="panel-heading">
                <h3 class="panel-title">Thông tin chi tiết đơn hàng</h3>
            </div>
            <div class="card">
                <div class="table-responsive text-nowrap">

                    <table class="table" style="text-align: center">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <?php
                            $total_price = 0;
                            foreach ($products as $key => $value) : $total_price += $value['Price']  * $value['Quantity']; ?>
                                <tr>
                                    <td><?php echo $key + 1 ?></td>
                                    <td><?php echo $value['Name'] ?></td>
                                    <td>
                                        <img src="..//uploads//<?php echo $value['Image'] ?>" alt="" width="100">
                                    </td>
                                    <td><?php echo $value['Quantity'] ?></td>
                                    <td><?php echo $value['Price'] ?></td>
                                    <td><?php echo $value['Quantity'] * $value['Price']  ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td>Tổng tiền: </td>
                                <td class="bg-infor"><?php echo $total_price ?> usd</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <form method="POST">
                <div class="form-group mt-4">
                    <select name="status" id="" required>
                        <option name="status" value="0">Chưa xử lý</option>
                        <option name="status" value="1">Đang xử lý</option>
                        <option name="status" value="2">Đã xử lý</option>
                    </select>
                </div>
                <button class="mt-4 btn btn-primary" type="submit" name="submit">Cập nhật</button>
            </form>
        </div>
    </div>
    <?php
    include($_SERVER["DOCUMENT_ROOT"] . '/admin/inc/footer.php');
    ?>