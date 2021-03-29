
<!-- Use Php session Right Here -->
<?php
        include 'database/db.php';
        $alertText = "";
        function CheckMemberCode($code, $namecode){
            $allmember = getSomeAllData("personnel", "$namecode");
            if(empty($allmember))
                return true;
            else {
                foreach($allmember as $member){
                    if($code == $member[$namecode])
                    return false;
                }
            }
            return true;
        }
        if(isset($_POST['register_submit'])){
            $username = $_POST['username'];
            $datecreated = date("Y-m-d"); 
            if(CheckMemberCode($_POST['membership_code'], "manhanvien") && CheckMemberCode($_POST['username'], "tentaikhoan") 
            && $_POST['password'] == $_POST['c_password']){
                $password = md5($_POST['password']);
                $member_code = $_POST['membership_code'];
                InsertData("personnel", "NULL, \"$member_code\", \"$username\", \"$password\",\"$datecreated\",1");
                $alertText = "SUCCESS";
                header("location: login.php");
            }
            else{
                $alertText = "ERROR";
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="sign-container">
        <div class="form-control">
            <form action="sign.php" method="post">
                <p>User Name</p>
                <input class="inp" type="text" name="username" id="">
                <p>Member Code</p>
                <input class="inp" type="text" name="membership_code" id="">
                <p>password</p>
                <input class="inp" type="password" name="password" id="">
                <p>retype password</p>
                <input class="inp" type="password" name="c_password" id="">
                <br>
                <p><?php echo $alertText; ?></p>
                <br>
                <input class="btn" type="submit" value="Register" name="register_submit">
            </form>
            <div class="back-login" style="font-size: 2em;">
            <p>already member</p>
            <a href="login.php"   style="background: var(--another-color);">login here</a>
        </div>
        </div>
    </div>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
</html>