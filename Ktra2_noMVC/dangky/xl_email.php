<?php
    include('connect.inp');
    if(isset($_GET['token']))
    {
        $token=$_GET['token'];

        $sql = "SELECT * FROM thongtintaikhoan_tam WHERE TokenEmail='{$token}' AND ThoiGianHieuLuc >= NOW();";
        $result = $con->query($sql);

        if ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();
            $username = $row['TenDangNhap'];
            $hashed_password = $row['MatKhau'];
            $token_email=$row['TokenEmail'];
            $send_token_time=$row['ThoiGianTokenEmail'];
            $expiration_time = $row['ThoiGianHieuLuc'];

            // Lấy mã tự động tăng cho tài khoản mới
            $sql_taoma = "SELECT MAX(MaTK) as max_ma from thongtintaikhoan";
            $result = $con->query($sql_taoma);
            $row_ma = $result->fetch_assoc();
            $mamoi = $row_ma['max_ma'] + 1;

            // Lưu thông tin vào bảng tài khoản
            $create_time=date('Y-m-d H:i:s',time());
            $create_by=$username;
            $update_time=NULL;
            $update_by=NULL;
            $role=NULL;
            $is_active='1';
            $is_verify='1';

            // Lưu thông tin vào bảng tài khoản
            $sql_tk = "INSERT INTO thongtintaikhoan (MaTK, TenDangNhap, MatKhau, NgayTao, 
                    NguoiTao, NgaySua, NguoiSua, PhanQuyen, TrangThaiHoatDong, TrangThaiXacThuc,TokenEmail, 
                    ThoiGianTokenEmail,ThoiGianHieuLuc) 
                    VALUES ('{$mamoi}', '{$username}', '{$hashed_password}', '{$create_time}', 
                    '{$create_by}', '{$update_time}', '{$update_by}', '{$role}', {$is_active}, 
                    {$is_verify},'{$token_email}', '{$send_token_time}','{$expiration_time}');";
            $result=$con->query($sql_tk);

            // Lưu thông tin cá nhân vào bảng
            $sql_getinfor_ttcn = "SELECT * FROM thongtincanhan_tam WHERE TokenEmail='{$token}';";
            $result = $con->query($sql_getinfor_ttcn);
            if ($result->num_rows > 0) 
            {
                $row = $result->fetch_assoc();
                $name = $row['TenKH'];
                $birthdate = $row['NgaySinh'];
                $address=$row['DiaChi'];
                $email=$row['Email'];
                $phonenumber=$row['SDT'];
            }


            $sql_cn="INSERT INTO thongtincanhan (MaKH, TenKH, NgaySinh, DiaChi, Email, SDT) 
                    VALUES ('{$mamoi}','{$name}','{$birthdate}','{$address}', '{$email}', '{$phonenumber}');";
            //echo $sql_cn;
            $result=$con->query($sql_cn);

            // Xóa bản ghi khỏi bảng tạm
            $sql_delete = "DELETE FROM thongtintaikhoan_tam WHERE TokenEmail='{$token}';";
            $con->query($sql_delete);

            $sql_delete_ttcn = "DELETE FROM thongtincanhan_tam WHERE TokenEmail='{$token}';";
            $con->query($sql_delete_ttcn);

            echo "Tài khoản của bạn đã được kích hoạt thành công! 
                    Bạn có thể <a href='../dangnhap/dangnhap.php'>đăng nhập</a>.";
        } 
        else 
        {
            echo "Token không hợp lệ hoặc đã hết hạn.";
        }
    }
?>
