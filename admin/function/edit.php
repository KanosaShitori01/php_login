<?php
    include '../../database/db.php';
    if(!CheckSession()){
        header("location: ../../index.php");
    }
    
    if(isset($_GET['user'])){
        $id = $_GET['user'];
    }
    $DataUser = getData("personnel", $id);
    if(isset($_POST['change_submit'])){
        $username = $_POST['username'];
        $membercode = $_POST['membership_code'];
        $status = $_POST['status'];
        if(isset($_POST['change_password'])){
            if(empty($password)) $password = $DataUser['matkhau'];
            else $password = $_POST['password'];
            UpdateData("personnel", $id, "tentaikhoan=\"$username\", manhanvien=\"$membercode\", matkhau=\"$password\", trangthai=\"$status\""); 
            header("location: ../admin.php");
        }
        else{
            UpdateData("personnel", $id, "tentaikhoan=\"$username\", manhanvien=\"$membercode\", trangthai=\"$status\"");
            header("location: ../admin.php");
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>

    <form class="form-edit" action="edit.php?user=<?php echo $DataUser['id'];?>" method="post">
    <a href="">Go Back</a>
        <div class="form-edit__tab">
            <label for="">Tên tài khoản: </label>
            <input type="text" name="username" value="<?php echo $DataUser['tentaikhoan'];?>" id="">
        </div>
        <div class="form-edit__tab">
            <label for="">Mã nhân viên: </label>
            <input type="text" name="membership_code" value="<?php echo $DataUser['manhanvien'];?>" id="">
        </div>
        <div class="form-edit__tab">
            <label for="">Mật khẩu: </label>
           <?php echo (isset($_POST['change_password'])) ?'<input type="password" name="password" value="" id="">' : '<input type="submit" class="btn small" name="change_password" value="Đổi mật khẩu">'; 
            ?>
        </div>
        <div class="form-edit__tab">
            <label for="">Trạng thái: </label>
            <input type="text" name="status" value="<?php echo $DataUser['trangthai']?>" id="">
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