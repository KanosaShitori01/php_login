<?php
    include '../../db/Infor_control.php';
    $date = date("Y-m-d");
    if(isset($_POST['register_submit'])){
        if(CheckRegister("tentaikhoan", $_POST['username']) 
        && CheckRegister("manhanvien", $_POST['membership_code']) &&
        $_POST['password'] === $_POST['re_password'])
        {
            $username = $_POST['username'];
            $memberCode = $_POST['membership_code'];
            $password = md5($_POST['password']);
            $dateVN = date('Y-m-d', strtotime($date));
            Register(["manhanvien" => "\"$memberCode\"", "tentaikhoan" => "\"$username\"", 
            "matkhau" => "\"$password\"", "ngaytao" => "\"$dateVN\"", "trangthai" => 1]);
            header("location: ./login.php");
        }
        else $alerttext = "Vui lòng kiểm tra lại";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h2>Đăng Ký</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form_inp">
            <label for="">Mã tài khoản: </label>
            <input type="text" name="membership_code" id="" require>
        </div>
        <div class="form_inp">
            <label for="">Tên tài khoản: </label>
            <input type="text" name="username" id="" require>
        </div>
        <div class="form_inp">
            <label for="">Mật khẩu: </label>
            <input type="password" name="password" id="" require>
        </div>
        <div class="form_inp">
            <label for="">Nhập Lại Mật khẩu: </label>
            <input type="password" name="re_password" id="" require>
        </div>
        <?php echo "<p>".$alerttext."</p>"; ?>
        <br>
        <div class="form_inp sub">
            <input type="submit" name="register_submit" value="Đăng Nhập">
        </div>
    </form>
</body>
<script src="../assets/js.js"></script>
</html>