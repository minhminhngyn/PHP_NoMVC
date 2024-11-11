<?php
    if (isset($_POST['token'])) {
        $token = $_POST['token'];
    } else {
        echo "<script>alert('Không tồn tại URL!'); window.history.back();</script>";
        exit;  // Nếu không có token, dừng thực thi
    }
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu</title>
    <link rel="stylesheet" href="../helpers/css/datlaimk.css">
</head>
<body>
    <h2>Đặt Lại Mật Khẩu</h2>
    <form id="resetForm" method="post" action="xlDatlaimk.php" onsubmit="validatePasswords(event)">
        <tr>
            <td>Mật khẩu:</td>
            <td>
                <div style="position: relative;">
                    <input type='password' name='password' id='password' class='password' required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('password')">
                        <img src="../helpers/css/images/eye-off-icon.png" alt="Show Password" id="eyeIconPassword" style="cursor: pointer;">
                    </span>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div id="strengthBar">
                    <div class="strengthSegment" id="segment1"></div>
                    <div class="strengthSegment" id="segment2"></div>
                    <div class="strengthSegment" id="segment3"></div>
                    <div class="strengthSegment" id="segment4"></div>
                    <div class="strengthSegment" id="segment5"></div>
                </div>
                <div class="strengthText">
                    <span class="weak">Mật khẩu yếu</span>
                    <span class="strong">Mật khẩu mạnh</span>
                </div>
                <p id='strengthMessage'></p>
            </td>
        </tr>
        <tr>
            <td>Xác nhận mật khẩu:</td>
            <td>
                <div style="position: relative;">
                    <input type='password' name='password_confirm' id='confirmPassword' class='password' required>
                    <span class="toggle-password" onclick="togglePasswordVisibility('password_confirm')">
                        <img src="../helpers/css/images/eye-off-icon.png" alt="Show Password" id="eyeIconConfirmPassword" style="cursor: pointer;">
                    </span>
                </div>
            </td>
        </tr>
        <div style="text-align: center;"> 
            <button type='button' id='reset_value'>Bỏ qua</button>
            <input type='submit' value='Đặt lại mật khẩu'>
        </div>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    </form>

    <script src="../helpers/js/datlaimk.js"></script>
</body>
</html>
