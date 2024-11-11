<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <link rel="stylesheet" href="../helpers/css/quenmatkhau.css"> 
</head>
<body>
    <h2>Quên Mật Khẩu</h2>
    <form action="xlQuenmatkhau.php" method="POST" style="width: 100%; display: flex; flex-direction: column; align-items: center;" onsubmit="return validateForm()">
        <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>
        <button type="submit" name="submit">Gửi Mã</button>
        <p>Đã có tài khoản? <a href="../dangnhap/dangnhap.php" style="color: #000; text-decoration: none;">Đăng nhập</a></p>
    </form>

    <script>
        function validateForm() {
            const email = document.getElementById("email").value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email === "") {
                alert("Vui lòng nhập email!");
                return false;
            }
            if (!emailPattern.test(email)) {
                alert("Email không hợp lệ!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
