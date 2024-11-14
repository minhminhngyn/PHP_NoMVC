<?php
// Kết nối tới cơ sở dữ liệu
require_once '../helpers/others/connect.inp'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['password_confirm'];
    $token = isset($_POST['token']) ? $_POST['token'] : '';  

    // echo "Token: " . htmlspecialchars($token) . "<br>"; 
    if ($newPassword !== $confirmPassword) {
        // Kiểm tra nếu mật khẩu và xác nhận mật khẩu không khớp
        echo "<script>alert('Mật khẩu không khớp!'); window.history.back();</script>";
        exit();
    }

    if (strlen($newPassword) < 8) {
        // Kiểm tra độ dài mật khẩu tối thiểu là 8 ký tự
        echo "<script>alert('Mật khẩu phải có ít nhất 8 ký tự!'); window.history.back();</script>";
        exit();
    }

    // Kiểm tra tính hợp lệ của token
    $sql = "SELECT * FROM datlaimk WHERE Token = ? AND TgHethan > NOW() AND TrangThai = 1";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $tokenData = $result->fetch_assoc();

    if (!$tokenData) {
        // Token không hợp lệ hoặc đã hết hạn
        echo "<script>alert('Token không hợp lệ hoặc đã hết hạn.'); window.location.href = 'Datlaimk.php';</script>";
        exit();
    }

    // Lấy thông tin tài khoản từ cột MaTK
    $userId = $tokenData['MaTK'];  

    // Lấy tên khách hàng từ bảng thongtincanhan
    $getNameSql = "SELECT TenKH FROM thongtincanhan WHERE MaKH = ?";
    $getNameStmt = $con->prepare($getNameSql);
    $getNameStmt->bind_param("i", $userId);
    $getNameStmt->execute();
    $nameResult = $getNameStmt->get_result();
    $nameData = $nameResult->fetch_assoc();
    $name = $nameData['TenKH'];

    // Token hợp lệ, cập nhật lại trạng thái token (khóa nó lại)
    $updateSql = "UPDATE datlaimk SET TrangThai = 1 WHERE Token = ? AND MaTK = ?";
    $updateStmt = $con->prepare($updateSql);
    $updateStmt->bind_param("si", $token, $userId);
    $updateStmt->execute();

    // Mã hóa mật khẩu mới
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Cập nhật mật khẩu mới vào cơ sở dữ liệu cùng với NguoiSua và NgaySua
    $updateSql = "UPDATE thongtintaikhoan SET MatKhau = ?, NguoiSua = ?, NgaySua = NOW() WHERE MaTK = ?";
    $updateStmt = $con->prepare($updateSql);
    $updateStmt->bind_param("ssi", $hashedPassword, $name, $userId);
    $updateStmt->execute();

    // Thông báo thành công
    echo "<script>alert('Đặt lại mật khẩu thành công!'); window.location.href = '../dangnhap/dangnhap.php';</script>";
}
?>
