<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['status'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
include '../connect.php';
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Stock Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <button class="btn btn-primary d-lg-none position-fixed top-0 start-0 m-3 z-3"
        onclick="document.querySelector('.sidebar-logistics').classList.toggle('show')"><i
            class="bi bi-list"></i></button>

    <div class="sidebar-logistics d-flex flex-column">
        <div class="p-4 mb-4 text-center">
            <h4 class="fw-bold text-danger mb-0">MINIPRO <span class="text-white small">ADMIN</span></h4>
        </div>
        <nav class="flex-grow-1">
            <a href="dashboard.php" class="sidebar-link"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
            <a href="manage_users.php" class="sidebar-link"><i class="bi bi-people me-2"></i> Users</a>
            <a href="stock.php" class="sidebar-link active"><i class="bi bi-box-seam me-2"></i> Stock</a>
            <a href="settings.php" class="sidebar-link"><i class="bi bi-gear me-2"></i> Settings</a>
        </nav>
        <div class="p-4 border-top border-secondary">
            <a href="../logout.php" class="btn btn-outline-danger w-100 btn-sm">ออกจากระบบ</a>
        </div>
    </div>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary"><i class="bi bi-box-seam"></i> คลังสินค้า</h2>
            <a href="add_product_admin.php" class="btn btn-primary shadow"><i class="bi bi-plus-lg"></i> เพิ่มสินค้า</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover mb-0 align-middle">
                    <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคา</th>
                            <th>จำนวนคงเหลือ</th>
                            <th class="text-end pe-4">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = mysqli_query($con, "SELECT * FROM products");
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td class='ps-4 text-muted'>#{$row['id']}</td>
                                    <td class='fw-bold text-white'>{$row['p_name']}</td>
                                    <td class='text-danger fw-bold'>฿" . number_format($row['p_price'], 2) . "</td>
                                    <td><span class='badge bg-secondary'>{$row['p_qty']} ชิ้น</span></td>
                                    <td class='text-end pe-4'>
                                        <a href='delete_product.php?id={$row['id']}' class='btn btn-sm btn-outline-danger' onclick='return confirm(\"ยืนยันการลบ?\")'><i class='bi bi-trash'></i></a>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='text-center py-5 text-muted'>ยังไม่มีสินค้าในคลัง</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>