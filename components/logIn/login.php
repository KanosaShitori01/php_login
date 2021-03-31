<?php

    include '../../db/Infor_control.php';
    if(isset($_POST['login_submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(Login($username, $password) === true){
            header("location: ../../");
        }
        else $alerttext = Login($username, $password);
    }
    if(CheckSession()){
        header("location: ../../");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Đăng Nhập</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form_inp">
            <label for="">Tên tài khoản: </label>
            <input type="text" name="username" id="">
        </div>
        <br>
        <div class="form_inp">
            <label for="">Mật khẩu: </label>
            <input type="password" name="password" id="">
        </div>
        <?php echo "<p>".$alerttext."</p>"; ?>
        <br>
        <div class="form_inp sub">
            <input type="submit" name="login_submit" value="Đăng Nhập">
        </div>
    </form>
</body>
<script src="../assets/js.js"></script>
</html>