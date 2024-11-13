<?php
session_start();
include '../helpers/others/connect.inp';

if (!isset($_GET['MaTK']) || !isset($_POST['TenDangNhap'])) {
    echo "<script>alert('Mã tài khoản không hợp lệ.'); window.history.back();</script>";
    exit();
}

$maTK = $_GET['MaTK'];
$TenDangNhap = $_POST['TenDangNhap'];
$PhanQuyen = $_POST['PhanQuyen'];
$TenKH = $_POST['TenKH'];
$ngaySinh = $_POST['NgaySinh'];
$DiaChi = $_POST['DiaChi'];
$email = $_POST['Email'];
$sdt = $_POST['SDT'];
$matKhau = $_POST['MatKhau'];

$alertMessage = '';

if (!empty($matKhau)) {
    $matKhau = password_hash($matKhau, PASSWORD_BCRYPT);
    $updateAccountSql = "UPDATE thongtintaikhoan SET TenDangNhap=?, Matkhau=?, PhanQuyen=?, NgaySua=NOW(), NguoiSua=? WHERE MaTK=?";
    $updateAccountStmt = $con->prepare($updateAccountSql);
    $updateAccountStmt->bind_param('sssss', $TenDangNhap, $matKhau, $PhanQuyen, $TenDangNhap, $maTK);
} else {
    $updateAccountSql = "UPDATE thongtintaikhoan SET TenDangNhap=?, PhanQuyen=?, NgaySua=NOW(), NguoiSua=? WHERE MaTK=?";
    $updateAccountStmt = $con->prepare($updateAccountSql);
    $updateAccountStmt->bind_param('ssss', $TenDangNhap, $PhanQuyen,$TenDangNhap, $maTK);
}

$updatePersonalSql = "UPDATE thongtincanhan SET TenKH=?, NgaySinh=?, DiaChi=?, Email=?, SDT=? WHERE MaKH=?";
$updatePersonalStmt = $con->prepare($updatePersonalSql);
$updatePersonalStmt->bind_param('ssssss', $TenKH, $ngaySinh, $DiaChi, $email, $sdt, $maTK);

if ($updateAccountStmt->execute() && $updatePersonalStmt->execute()) {
    $alertMessage = "Cập nhật thông tin thành công!";
    echo "<script>alert('$alertMessage'); window.location.href='qluser.php';</script>";
} else {
    $alertMessage = "Lỗi: " . $con->error;
    echo "<script>alert('$alertMessage'); window.history.back();</script>";
}
exit();
