<?php
session_start();
include '../helpers/others/connect.inp';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh Sửa Người Dùng</title>
    <link rel="stylesheet" href="../helpers/css/edituser.css">
</head>
<body>
<button type="button" class="home-button" onclick="window.location.href='../trangchu/welcome.php';">Trang Chủ</button>
<button type="button" class="logout-button" onclick="window.location.href='../dangnhap/dangnhap.php';">Đăng Xuất</button>
<h2>Chỉnh Sửa Thông Tin Người Dùng</h2>
<?php
if (!isset($_GET['MaTK'])) {
    echo "<script>alert('Mã tài khoản không hợp lệ.'); window.history.back();</script>";
    exit();
}

$maTK = $_GET['MaTK'];

$sql = "SELECT a.MaTK, a.TenDangNhap, a.PhanQuyen, b.TenKH, b.NgaySinh, b.DiaChi, b.Email, b.SDT 
        FROM thongtintaikhoan a 
        JOIN thongtincanhan b ON a.MaTK = b.MaKH 
        WHERE a.MaTK = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param('s', $maTK);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Không tìm thấy tài khoản.'); window.history.back();</script>";
    exit();
}

$row = $result->fetch_assoc();
?>

<form method="POST" action="xledituser.php?MaTK=<?php echo $maTK; ?>">
    <label for="TenDangNhap">Tên Tài Khoản:</label>
    <input type="text" name="TenDangNhap" value="<?php echo htmlspecialchars($row['TenDangNhap']); ?>" required>

    <label for="PhanQuyen">Vai Trò:</label>
    <select name="PhanQuyen">
        <option value="admin" <?php echo ($row['PhanQuyen'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
        <option value="user" <?php echo ($row['PhanQuyen'] == 'user') ? 'selected' : ''; ?>>User</option>
    </select>

    <label for="TenKH">Họ Tên:</label>
    <input type="text" name="TenKH" value="<?php echo htmlspecialchars($row['TenKH']); ?>" required>

    <label for="NgaySinh">Ngày Sinh:</label>
    <input type="date" name="NgaySinh" value="<?php echo htmlspecialchars($row['NgaySinh']); ?>" required>

    <label for="DiaChi">Địa Chỉ:</label>
    <input type="text" name="DiaChi" value="<?php echo htmlspecialchars($row['DiaChi']); ?>" required>

    <label for="Email">Email:</label>
    <input type="email" name="Email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>

    <label for="SDT">Số Điện Thoại:</label>
    <input type="text" name="SDT" value="<?php echo htmlspecialchars($row['SDT']); ?>" required>

    <label for="MatKhau">Mật Khẩu Mới:</label>
    <div class="password-container">
        <input type="password" id="MatKhau" name="MatKhau" placeholder="Nhập mật khẩu mới (nếu có)" style="padding-right: 40px;">
        <img src="../helpers/css/images/eye-off-icon.png" id="togglePassword" alt="Toggle Password Visibility">
    </div>

    <input type="submit" value="Cập Nhật">
</form>

<script src="../helpers/js/edituser.js"></script>

</body>
</html>
