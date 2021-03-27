
<?php
        include '../database/db.php';
        $alertText = "";
        function Login($username, $password)
        {
            $Mpass = md5($password);
            $checkName = SearchData("personnel", "tentaikhoan", "\"$username\"")[0];
            if (gettype($checkName) != "string" && in_array($Mpass, $checkName)) {
                $id = StartSession("personnel", $checkName['id']);
                $_SESSION['login'] = $id;
                return "SUCCESS";
            } else return "ERROR";
        }
        if (isset($_POST['login_submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            Login($username, $password);
            $alertText = Login($username, $password);
        }
        if (isset($_SESSION['login'])) {
            header("location: ../index.php");
        }

?>
<!-- =============================================================================== -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <form action="login.php" method="post">
        <p>Tên tài khoản:</p>
        <input class="inp" type="text" name="username" id="">
        <p>Mật khẩu: </p>
        <input class="inp" type="password" name="password" id="">
        <br>
        <p><?php echo $alertText; ?></p>
        <br>
        <input class="btn" type="submit" value="Login" name="login_submit">
    </form>
</body>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>
