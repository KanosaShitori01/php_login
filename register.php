
<?php
        include 'db.php';
        $alertText = "";
        function CheckMemberCode($code, $namecode){
            $allmember = getSomeAllData("personnel", "$namecode");
                foreach($allmember as $member){
                    if($code == $member[$namecode])
                    return false;
                }
            return true;
        }
        if(isset($_POST['register_submit'])){
            $username = $_POST['username'];
            $job_position = $_POST['job_position'];

            if(CheckMemberCode($_POST['membership_code'], "manhanvien") && CheckMemberCode($_POST['username'], "tentaikhoan") 
            && $_POST['password'] == $_POST['c_password']){
                $password = md5($_POST['password']);
                $member_code = $_POST['membership_code'];
                InsertData("personnel", "NULL, \"$member_code\", \"$username\", \"$password\", \"$job_position\", 1");
                $alertText = "SUCCESS";
                header("location: login.php");
            }
            else{
                $alertText = "ERROR";
            }
        }
?>

<!-- ===================================================================================== -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="register.php" method="post">
        <p>Tên tài khoản: </p>
        <input class="inp" type="text" name="username" id="" required>
        <p>Mã tài khoản: </p>
        <input class="inp" type="text" name="membership_code" id="">
        <p>Mật khẩu: </p>
        <input class="inp" type="password" name="password" id="">
        <p>Nhập lại mật khẩu: </p>
        <input class="inp" type="password" name="c_password" id="">
        <p>Vị trí: </p>
        <input class="inp" type="text" name="job_position" id="">
        <?php echo $alertText; ?>
        <br>
        <br>
        <input class="btn" type="submit" value="Register" name="register_submit">
    </form>
</body>
<script>
 if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    } 
</script>
</html>
