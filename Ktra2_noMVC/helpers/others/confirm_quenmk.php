<?php
include 'connect.inp';

// Kiểm tra nếu có token trong URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Truy vấn cơ sở dữ liệu để kiểm tra token
    $stmt = $con->prepare("SELECT * FROM datlaimk WHERE Token = ? AND TrangThai = '1' AND TgHethan > NOW()");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // Token không hợp lệ hoặc đã hết hạn
        echo "<script>alert('Token không hợp lệ hoặc đã hết hạn.'); window.location.href = '../../quenmatkhau/Quenmatkhau.php';</script>";
        exit;
    } else {
        // Token hợp lệ, tự động chuyển hướng đến trang Datlaimk.php bằng phương thức POST
        echo '
        <form id="redirectForm" action="../../quenmatkhau/Datlaimk.php" method="POST">
            <input type="hidden" name="token" value="' . htmlspecialchars($token) . '">
        </form>
        <script type="text/javascript">
            document.getElementById("redirectForm").submit();
        </script>
        ';
        exit;
    }
} else {
    // Nếu không có token trong URL
    echo "<script>alert('Không có token trong URL.'); window.location.href = '../../quenmatkhau/Quenmatkhau.php';</script>";
    exit;
}
?>
