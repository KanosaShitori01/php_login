<?php
    include 'database/db.php';
    if(!CheckSession()){
        header("location: index.php");
    }
    
    if(isset($_GET['user'])){
        $id = $_GET['user'];
    }
    $nameErr=$membercodeErr=$statusError=$passwordErr="";
    $DataUser = getData("personnel", $id);
    if(isset($_POST['change_submit'])){
        if(empty($_POST['username']))
        {
            $nameErr="do not empty user name";
        }
        else
        {
            $username = $_POST['username'];

        }
        if(empty($_POST['membership_code']))
        {
            $membercodeErr="do not empty employee code ";
        }
        else
        {
            $membercode = $_POST['membership_code'];

        }
        if(empty($_POST['status']))
        {
            $statusError="do not empty status ";
        }
        else
        {
            $status = $_POST['status'];

        }
        if(empty($_POST['password']))
        {
            $passwordErr="do not password status ";
        }
        else
        {
            $password = $_POST['password'];
            $newPass = md5($password);
        }

        UpdateData("personnel", $id, "tentaikhoan=\"$username\", manhanvien=\"$membercode\", matkhau=\"$newPass\", trangthai=\"$status\""); 
        header("location: manager.php");
    }

    
?>
<?php
        if(CheckSession())
        {
            $DataUser2 = getData("personnel", $_SESSION['login']);
        }
        if(!isset($_SESSION['login'])) { 
            header("location: login.php");
        }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/76ee6cfa25.js" crossorigin="anonymous"></script>
    <script src="js.js"></script>

    <title>Admin Manager Page</title>
</head>
<body>
<div class="container">
        <div class="side-navbar"> <!-- This is side navbar -->
            <h1>User Manager</h1>
            <div class="admin-name">
                <span><i class="fas fa-user-tie"></i>
                </span>
                <p>
                <?php echo CheckSession() ? $DataUser2['tentaikhoan'] : "";?>
                </p>   <!--Print Session The user Logged  -->
            </div>
            <div class="list-item">
            <div class="manager">
                <span><i class="fas fa-users-cog"></i>
                </span>
                <form action="index.php" method="post">
                <?php echo (CheckSession() && $DataUser2['trangthai'] == 2) ? '<a class="btn" href="manager.php">Manager</a>': ""; ?>
                </form>
            </div>
            <div class="logout">
                <span><i class="fas fa-sign-out-alt"></i>
                </span>
                <a href="logout.php">Logout</a>
            </div> <!-- Use Function logout is this <a> -->
            </div>
        </div>
        <div class="content">
    <div class="update">
        <div class="Edit">
            <!-- Edit Form Container -->
            <form method="post" action="update.php?user=<?php echo $DataUser['id'];?>"">
                <!-- action use php self -->
                <h1>update information</h1>
                <div class="code-input">
                <p>User Name</p>
                    <input type="text" name="username" placeholder="enter user name " value="<?php echo $DataUser['tentaikhoan'];?>" id="">
                </div>
                <div class="errortext">
                <?php echo $nameErr; ?>
                </div>
                <div class="code-input">
                <p>employee code</p>
                    <input type="text" name="membership_code" placeholder="enter employee code " value="<?php echo $DataUser['manhanvien'];?>" id="">
                </div>
                <div class="errortext">
                <?php echo $membercodeErr; ?>
                </div>
                <div class="code-input">
                   <p>Password</p>
                   <input type="text" name="password" value="<?php echo $DataUser['matkhau'];?>" id="">
                </div>
                <div class="errortext">
                <?php echo $passwordErr; ?>
                </div>
                <div class="code-input">
                <p>status</p>
                    <input type="text" name="status" value="<?php echo $DataUser['trangthai']?>" id="">
                </div>
                <div class="errortext">
                <?php echo $statusError; ?>
                </div>
                <div class="update-code">
                    <input type="submit" value="Thay Đổi" name="change_submit">
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
