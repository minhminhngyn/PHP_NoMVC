<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký tài khoản</title>
    <link rel="stylesheet" href="../helpers/css/dangki.css"> 
</head>
<body>
    <div>
        <h3>Đăng ký tài khoản</h3>
    </div>
    <form action='xl_dki.php' method='POST'>
        <div class='cus_infor'>
            <h4>Thông tin người đăng ký</h4>
            <table>
                <tr>
                    <td>Họ tên:</td>
                    <td><input type='text' name='name' maxlength="300" required></td>
                </tr>
                <tr>
                    <td>Ngày sinh:</td>
                    <td><input type='date' name='birthdate' required></td>
                </tr>
                <tr>
                    <td>Địa chỉ:</td>
                    <td><input type='text' name='address' required></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type='email' name='email' required></td>
                </tr>
                <tr>
                    <td>Số điện thoại:</td>
                    <td><input type='text' name='phonenumber' maxlength='10' required></td>
                </tr>
            </table>
        </div>
        <div class='account_infor'>
            <h4>Thông tin tài khoản</h4>
            <table>
                <tr>
                    <td>Tên đăng nhập:</td>
                    <td><input type='text' name='username' maxlength="300" required></td>
                </tr>
                <tr>
                    <td>Mật khẩu:</td>
                    <td>
                        <div style="position: relative;">
                            <input type='password' name='password' class='password' required>
                            <span class="toggle-password" onclick="togglePasswordVisibility('password')">
                                <img src="eye-off-icon.png" alt="Show Password" id="eyeIconPassword" style="cursor: pointer;">
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
                            <input type='password' name='password_confirm' class='password' required>
                            <span class="toggle-password" onclick="togglePasswordVisibility('password_confirm')">
                                <img src="eye-off-icon.png" alt="Show Password" id="eyeIconConfirmPassword" style="cursor: pointer;">
                            </span>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div style="text-align: center;"> 
            <button type='button' id='reset_value'>Làm lại</button>
            <input type='submit' value='Đăng ký'>
        </div>
    </form>
    <?php
        if (isset($_GET['mess'])) 
        {
            echo "<script>alert('" . htmlspecialchars($_GET['mess']) . "');</script>";
        }
    ?>
    <script src="../helpers/js/frm_dki.js"></script>
</body>
</html>
