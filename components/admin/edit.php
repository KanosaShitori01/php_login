<?php
    include '../../db/Infor_control.php';
    if(!CheckSession()) header("location: ../../index.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $DataUser = getData("personnel", $id)[0];
        if(isset($_POST['change_submit'])){
            $username = $_POST['username']; 
            if(empty($username)) $username = $DataUser['tentaikhoan'];
            $membercode = $_POST['membership_code']; 
            if(empty($membercode)) $membercode = $DataUser['manhanvien'];
            $status = $_POST['status']; 
            if(empty($status)) $status = $DataUser['trangthai'];
            $password = md5($_POST['password']); 
            if(empty($password)) $password = $DataUser['matkhau'];

            Admin_Edit($id, "manhanvien=\"$membercode\", tentaikhoan=\"$username\", matkhau=\"$password\", trangthai=$status");
            header("location: index.php");
        }
    }else header("location: index.php");
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
    <form class="form-edit" action="edit.php?id=<?php echo $id;?>" method="post">
    
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
    <div class="form-edit__tab">
        <label for="">Trạng thái: </label>
        <input type="text" name="status" value="<?php echo $DataUser['trangthai'] ?>" id="">
    </div>
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