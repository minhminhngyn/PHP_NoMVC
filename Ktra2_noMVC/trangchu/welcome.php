<?php
session_start();
$user_role = $_SESSION['vaitro'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="..\helpers\css\welcome.css">
</head>
<body>

<h1 class="page-title">Trang Chủ</h1>

<button type="button" class="logout-button" onclick="confirmLogout();">Đăng Xuất</button>

<?php if ($user_role == 'admin'): ?>
    <button type="button" class="qluser-button" onclick="window.location.href='../trangchu/qluser.php';">Quản lý người dùng</button>
<?php else: ?>
    <button type="button" class="qluser-button" onclick="window.location.href='../trangchu/edit_user.php?MaTK=<?php echo $_SESSION['user_id']; ?>';">Thông tin cá nhân</button>
<?php endif; ?>
<script>
function confirmLogout() {
    if (confirm("Bạn có chắc chắn muốn đăng xuất không?")) {
        window.location.href = '../dangnhap/dangnhap.php';
    }
}
</script>
</body>
</html>
