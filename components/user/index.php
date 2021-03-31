<?php
    include '../../db/Infor_control.php';
    if(CheckSession()) 
    $DataUser = getData("personnel", $_SESSION['login'])[0];
    else 
    header("location: ../../");

    if(isset($_POST['change_submit'])){
        $username = $_POST['username']; 
        if(empty($username)) $username = $DataUser['tentaikhoan'];
        $password = md5($_POST['password']);
        if(empty($password)) $password = $DataUser['matkhau'];
        $membercode = $_POST['membership_code'];
        if(empty($membercode)) $membercode = $_POST['membership_code'];
        Admin_Edit($_SESSION['login'], "tentaikhoan=\"$username\", matkhau=\"$password\", manhanvien=\"$membercode\"");
        header("location: ../../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form class="form-edit" action="index.php" method="post">
    <h2>Thông tin của bạn</h2>
    <div class="form-edit__tab">
        <label for="">Tên tài khoản: </label>
        <input type="text" name="username" value="<?php echo $DataUser['tentaikhoan'] ?>" id="">
    </div>
    <div class="form-edit__tab">
        <label for="">Mã nhân viên: </label>
        <input type="text" name="membership_code" value="<?php echo $DataUser['manhanvien'] ?>" id="">
    </div>
    <div class="form-edit__tab">
        <label for="">Mật khẩu: </label>
       <input type="password" name="password" value="<?php echo $DataUser['matkhau'] ?>" id="">
    </div>
    <?php echo "<p>$alerttext</p>" ?>
    <div class="form-edit__tab">
        <input id="submit" type="submit" name="change_submit" class="btn" value="Thay Đổi">
    </div>
    </form>
</body>
<script>
 if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    } 
    
</script>
</html>