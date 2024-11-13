<?php
    include('connect.inp');
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        // thông tin cá nhân
        $name = $_POST['name'];
        $birthdate = $_POST['birthdate'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];

        //thông tin tài khoản
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        
        //kiểm tra mật khẩu
        if ($password !== $password_confirm) 
        {
            $mess='Mật khẩu xác nhận phải khớp với mật khẩu đăng ký';
            header('location:frm_dki.php?mess='. urlencode($mess));
            exit();
        }
    
        // Mã hóa mật khẩu 
        $hashed_password = password_hash($password,PASSWORD_BCRYPT);

        
        $sql="SELECT * FROM thongtintaikhoan INNER JOIN thongtincanhan 
        WHERE TenDangNhap='{$username}' or Email='{$email}';";
        $result=$con->query($sql);

        if ($result->num_rows > 0) 
        {
            //tồn tại
            $mess='Tên tài khoản hoặc email đã tồn tại, nhập lại';
            header('location:frm_dki.php?mess='. urlencode($mess));
            exit();
        }
        else
        {
            // //tạo mã tự tăng
            // $sql_taoma="SELECT MAX(MaTK) as max_ma from thongtintaikhoan";
            // $result=$con->query($sql_taoma);
            // $row = $result->fetch_assoc();
            // $mamoi=$row['max_ma']+1;

            //tạo mã token gửi đi
            $token = hash('sha256', $username . time());

            // //gán giá trị bảng tài khoản nhé
            // $create_time=date('Y-m-d H:i:s',time());
            // $create_by=$username;
            // $update_time=NULL;
            // $update_by=NULL;
            // $role=NULL;
            // $is_active='0';
            // $is_verify='0';
            $token_email=$token;
            $send_token_time=date('Y-m-d H:i:s',time());
            $expiration_time = date("Y-m-d H:i:s", strtotime("+24 hours"));

            // $sql_tk = "INSERT INTO thongtintaikhoan (MaTK, TenDangNhap, MatKhau, NgayTao, 
            // NguoiTao, NgaySua, NguoiSua, PhanQuyen, TrangThaiHoatDong, TrangThaiXacThuc, TokenEmail, 
            // ThoiGianTokenEmail,ThoiGianHieuLuc) 
            // VALUES ('{$mamoi}', '{$username}', '{$hashed_password}', '{$create_time}', 
            // '{$create_by}', '{$update_time}', '{$update_by}', '{$role}', {$is_active}, 
            // {$is_verify}, '{$token_email}', '{$send_token_time}','{$expiration_time}');";
            // $result=$con->query($sql_tk);
            
            // $sql_cn="INSERT INTO thongtincanhan (MaKH, TenKH, NgaySinh, DiaChi, Email, SDT) 
            //     VALUES ('{$mamoi}','{$name}',{$birthdate},'{$address}', '{$email}', '{$phonenumber}');";
            // $result=$con->query($sql_cn);

            // Lưu vào bảng tạm để xác nhận qua email
            $sql_temp = "INSERT INTO thongtintaikhoan_tam (TenDangNhap, MatKhau, TokenEmail, ThoiGianTokenEmail, ThoiGianHieuLuc) 
                         VALUES ('{$username}', '{$hashed_password}', '{$token}', '{$send_token_time}', '{$expiration_time}');";
            $result = $con->query($sql_temp);

            $sql_temp_ttcn = "INSERT INTO thongtincanhan_tam (TokenEmail, TenKH,NgaySinh, DiaChi, Email, SDT) 
                         VALUES ('{$token}','{$name}',{$birthdate},'{$address}', '{$email}', '{$phonenumber}');";
            $result = $con->query($sql_temp_ttcn);


            //xử lý gửi mail
            require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
            require '../vendor/phpmailer/phpmailer/src/Exception.php';
            require '../vendor/phpmailer/phpmailer/src/SMTP.php';
            $mail = new PHPMailer\PHPMailer\PHPMailer(true); 
            try 
            {
                // set gửi mail
                $mail->SMTPDebug=2;
                $mail->isSMTP();
                $mail->CharSet = 'UTF-8';
                $mail->Host = 'smtp.gmail.com'; 
                $mail->SMTPAuth = true;
                    $user='nguyenngoc51203@gmail.com';
                    $pass='qnkx oika zgkm ycyq';
                $mail->Username = $user;
                $mail->Password = $pass;
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
        
                // Người gửi và người nhận
                $mail->setFrom($user);
                $to=$email;
                $mail->addAddress($to);
        
                // Nội dung email
                $mail->isHTML(true);
                $mail->Subject = 'Xác nhận tài khoản của bạn nhé';
                $activationLink= "localhost/ktra2/dangky/xl_dki.php?token={$token}";
                $noidung="Xin chào $name,<br><br>Cảm ơn bạn đã đăng ký tài khoản.<br>
                        Vui lòng nhấp vào link bên dưới để kích hoạt tài khoản của bạn:<br>
                        <a href='{$activationLink}'>Kích hoạt tài khoản</a><br>";
                $mail->Body = $noidung;
                $mail->send();
                echo 'Email kích hoạt đã được gửi';
            } 
            catch (Exception $e) 
            {
                echo "Không thể gửi email. Chi tiết lỗi: {$mail->ErrorInfo}";
            }

        }
        
    }
    else
        echo "Khoong cos";

?>

<?php
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
                    VALUES ('{$mamoi}','{$name}',{$birthdate},'{$address}', '{$email}', '{$phonenumber}');";
            $result=$con->query($sql_cn);

            // Xóa bản ghi khỏi bảng tạm
            $sql_delete = "DELETE FROM thongtintaikhoan_tam WHERE TokenEmail='{$token}';";
            $con->query($sql_delete);

            echo "Tài khoản của bạn đã được kích hoạt thành công! Bạn có thể <a href='#'>đăng nhập</a>.";
        } 
        else 
        {
            echo "Token không hợp lệ hoặc đã hết hạn.";
        }
    }
?>


