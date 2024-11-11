<?php
include '../helpers/others/connect.inp';
date_default_timezone_set('Asia/Bangkok');

require("../vendor/phpmailer/phpmailer/src/PHPMailer.php");
require("../vendor/phpmailer/phpmailer/src/SMTP.php");
require("../vendor/phpmailer/phpmailer/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['submit'])) {
    $userEmail = $_POST['email'];

    // Truy vấn thông tin tài khoản và tên khách hàng
    $stmt = $con->prepare("SELECT thongtincanhan.MaKH, thongtincanhan.TenKH, thongtintaikhoan.MaTK 
                            FROM thongtincanhan 
                            JOIN thongtintaikhoan ON thongtincanhan.MaKH = thongtintaikhoan.MaTK 
                            WHERE thongtincanhan.Email = ?");
    if (!$stmt) {
        die("Lỗi trong câu truy vấn SELECT: " . $con->error);
    }
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        echo "<script>alert('Tài khoản không tồn tại');
        window.location.href = 'Quenmatkhau.php';
        </script>";
    } else {
        $row = $result->fetch_assoc();
        $maKH = $row['MaKH'];
        $maTK = $row['MaTK'];
        $TenKH = $row['TenKH'];

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->CharSet = "utf-8";
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "nguyenminh26721@gmail.com";
            $mail->Password = "pxkg xwep jpyc ifvd";
            $mail->SMTPSecure = "ssl";
            $mail->Port = 465;

            $mail->setFrom("nguyenminh26721@gmail.com", "Minh Minh");
            $mail->addAddress($userEmail);

            // Tạo token mới và thời gian hết hạn
            $token = bin2hex(random_bytes(16));
            $currentDateTime = date("Y-m-d H:i:s"); // Thời gian hiện tại
            $expiry = date("Y-m-d H:i:s", strtotime($currentDateTime . ' +1 hour'));

            // Cập nhật bảng datlaimk với token mới
            $insertToken = $con->prepare("INSERT INTO datlaimk (MaToken, MaTK, Token, TgTao, TgHethan, TrangThai) VALUES (?, ?, ?, ?, ?, 'Active')");
            if (!$insertToken) {
                die("Lỗi trong câu truy vấn INSERT: " . $con->error);
            }
            $maToken = bin2hex(random_bytes(8)); // Tạo mã token ngẫu nhiên
            $insertToken->bind_param("sssss", $maToken, $maTK, $token, $currentDateTime, $expiry);
            $insertToken->execute();

            $resetLink = "http://localhost/Ktra2_noMVC/helpers/others/confirm_quenmk.php?token=" . $token;
            $mail->isHTML(true);
            $mail->Subject = "Quên mật khẩu";
            $mail->Body = "
                <h3>Xin chào,</h3>
                <p>Bạn đã yêu cầu đặt lại mật khẩu. Nhấp vào nút bên dưới để tiếp tục:</p>
                <a href='$resetLink' style='display: inline-block; padding: 10px 20px; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px; font-weight: bold;'>Đặt lại mật khẩu</a>
                <p>Nếu bạn không yêu cầu điều này, vui lòng bỏ qua email này.</p>
                <p>Trân trọng,<br>Đội ngũ hỗ trợ</p>
            ";
            $mail->send();

            echo "<script>alert('Email đã được gửi thành công đến $userEmail'); window.location.href = 'Quenmatkhau.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Không thể gửi email. Lỗi: " . $mail->ErrorInfo . "'); window.location.href = 'Quenmatkhau.php';</script>";
        }
    }
}
?>
