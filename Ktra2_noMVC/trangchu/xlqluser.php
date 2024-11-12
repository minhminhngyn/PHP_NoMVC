<?php
include '../helpers/others/connect.inp';

$search = isset($_POST['search']) ? trim($_POST['search']) : '';
$role_filter = isset($_POST['role_filter']) ? $_POST['role_filter'] : '';
$limit = 10;

$sql_total = "SELECT COUNT(*) as total FROM thongtintaikhoan WHERE 1=1";
if ($search) {
    $sql_total .= " AND TenDangNhap LIKE '%" . $con->real_escape_string($search) . "%'";
}
if ($role_filter) {
    $sql_total .= " AND PhanQuyen = '" . $con->real_escape_string($role_filter) . "'";
}

$result_total = $con->query($sql_total);
$total_accounts = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_accounts / $limit);
$current_page = max(1, min(isset($_GET['page']) ? (int)$_GET['page'] : 1, $total_pages));
$offset = ($current_page - 1) * $limit;

$sql = "SELECT * FROM thongtintaikhoan WHERE 1=1";
if ($search) {
    $sql .= " AND TenDangNhap LIKE '%" . $con->real_escape_string($search) . "%'";
}
if ($role_filter) {
    $sql .= " AND PhanQuyen = '" . $con->real_escape_string($role_filter) . "'";
}
$sql .= " LIMIT $limit OFFSET $offset";
$result = $con->query($sql);

if (isset($_POST['save_role'])) {
    $new_role = $_POST['new_role'];
    $MaTK = $_POST['MaTK'];
    if ($MaTK && $new_role) {
        $update_sql = "UPDATE thongtintaikhoan SET PhanQuyen = '" . $con->real_escape_string($new_role) . "' WHERE MaTK = '" . $con->real_escape_string($MaTK) . "'";
        $con->query($update_sql);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_POST['delete_user'])) {
    $MaTK = $_POST['MaTK'];
    if ($MaTK) {
        $delete_sql = "DELETE FROM thongtintaikhoan WHERE MaTK = '" . $con->real_escape_string($MaTK) . "'";
        $con->query($delete_sql);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>
