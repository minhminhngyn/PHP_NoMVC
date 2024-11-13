<?php
session_start();
include 'xlqluser.php'; 
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>
    <link rel="stylesheet" href="..\helpers\css\qluser.css">
    <script src="../helpers/js/qluser.js"></script>
</head>
<body>

<button type="button" class="home-button" onclick="window.location.href='../trangchu/welcome.php';">Trang Chủ</button>

<button type="button" class="logout-button" onclick="window.location.href='../dangnhap/dangnhap.php';">Đăng Xuất</button>

<h2>Quản Lý Người Dùng</h2>
<form method="POST" action="">
    <input type="text" name="search" placeholder="Tìm kiếm tài khoản" value="<?php echo htmlspecialchars($search); ?>">
    <select name="role_filter">
        <option value="">Tất cả vai trò</option>
        <option value="admin" <?php echo ($role_filter == 'admin') ? 'selected' : ''; ?>>Admin</option>
        <option value="user" <?php echo ($role_filter == 'user') ? 'selected' : ''; ?>>User</option>
    </select>
    <input type="submit" value="Tìm kiếm">
</form>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <tr>
            <th>Tên Tài Khoản</th>
            <th>Phân Quyền</th>
            <th>Chức Năng</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['TenDangNhap']); ?></td>
                <td>
                    <select id="role-<?php echo $row['MaTK']; ?>" name="new_role" data-old-role="<?php echo htmlspecialchars($row['PhanQuyen']); ?>" onchange="checkRoleChange(this, '<?php echo $row['MaTK']; ?>')">
                        <option value="admin" <?php echo ($row['PhanQuyen'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        <option value="user" <?php echo ($row['PhanQuyen'] == 'user') ? 'selected' : ''; ?>>User</option>
                    </select>
                </td>
                <td>
                    <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="MaTK" value="<?php echo $row['MaTK']; ?>">
                        <input type="hidden" name="new_role" id="new-role-<?php echo $row['MaTK']; ?>" value="<?php echo htmlspecialchars($row['PhanQuyen']); ?>">
                        <input type="submit" name="save_role" value="Lưu" class="button" id="save-<?php echo $row['MaTK']; ?>" style="display: none;">
                        <a href="edit_user.php?MaTK=<?php echo $row['MaTK']; ?>" class="button">Chỉnh sửa</a>
                        <input type="submit" name="delete_user" value="Xóa" class="button" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="pagination">
        <?php if ($current_page > 1): ?>
            <a href="?page=<?php echo $current_page - 1; ?>">« Trước</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?php echo $i; ?>" <?php echo ($i == $current_page) ? 'class="active"' : ''; ?>><?php echo $i; ?></a>
        <?php endfor; ?>

        <?php if ($current_page < $total_pages): ?>
            <a href="?page=<?php echo $current_page + 1; ?>">Sau »</a>
        <?php endif; ?>
    </div>

<?php else: ?>
    <p>Không tìm thấy tài khoản nào.</p>
<?php endif; ?>

</body>
</html>
