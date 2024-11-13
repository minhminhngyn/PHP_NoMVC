<?php
session_start(); // Khởi động session
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="../helpers/css/dangnhap.css"> 
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    background-color: #f0f0f0;
    color: #333;
    font-family: Arial, sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

/* Container styling */
.login-container {
    width: 100%;
    max-width: 400px;
    background-color: #ffffff;
    padding: 30px 20px;
    border-radius: 10px; /* Reduced border radius */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #000;
}

/* Form styling */
form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 15px; /* Adjusted spacing */
    position: relative;
}

label {
    color: #333;
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

input[type="text"],
input[type="password"],
input[type="checkbox"] {
    width: 100%;
    padding: 10px;
    margin-top: 5px; /* Added spacing between label and input */
    border: 1px solid #bbb;
    border-radius: 5px;
    background-color: #f9f9f9;
    color: #333;
}

input[type="checkbox"] {
    width: auto;
    margin-right: 10px;
}

button[type="button"],
button[type="submit"] {
    width: 100%;
    padding: 10px;
    font-weight: bold;
    color: #fff;
    background-color: #333;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    margin-top: 20px; /* Consistent spacing */
}

button[type="button"]:hover,
button[type="submit"]:hover {
    background-color: #000;
}

.captcha-image {
    margin-top: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
}

.extra-links {
    text-align: center;
    margin-top: 20px;
}

.extra-links a {
    color: #333;
    text-decoration: none;
    font-size: 0.9em;
}

.extra-links a:hover {
    text-decoration: underline;
}

</style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng Nhập</h2>
        <form action="xldangnhap.php" method="post">
            <div class="form-group">
                <label for="username">Tên Đăng Nhập:</label>
                <input type="text" id="username" name="username" required 
                        value="<?php echo isset($_SESSION['remembered_username']) ? htmlspecialchars($_SESSION['remembered_username']) : ''; ?>">

            </div>
            <div class="form-group">
                <label for="password">Mật Khẩu:</label>
                <input type="password" id="password" name="password" required>
                <button type="button" onclick="togglePassword()">Hiện</button>
            </div>
            <div class="form-group">
                <label for="captcha">Mã Captcha:</label>
                <input type="text" id="captcha" name="captcha" required>
                <img src="../helpers/others/generate_captcha.php" alt="Captcha" class="captcha-image">
                <button type="button" onclick="reloadCaptcha()">Tạo lại Captcha</button>
            </div>
            <div class="form-group">
                <label>
                    <input type="checkbox" name="remember">
                    Lưu Mật Khẩu
                </label>
            </div>
            <button type="submit">Đăng Nhập</button>
            <div class="extra-links">
                <a href="../dangky/frm_dki.php">Bạn chưa có tài khoản?</a> 
                <a href="../quenmatkhau/Quenmatkhau.php">Quên mật khẩu</a>
            </div>
        </form>
    </div>
    <script src="../helpers/js/dangnhap.js"></script>
</body>
</html>
