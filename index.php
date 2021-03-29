<!-- On her use php session when the user not login yet back to login page -->
<!-- This is main page for admin manager -->

<?php
        include 'database/db.php';
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
            <a href="index.php"><h1>User Manager</h1></a>
            <div class="admin-name">
                <span><i class="fas fa-user-tie"></i>
                </span>
                <p>
                <?php echo CheckSession() ? $DataUser2['tentaikhoan'] : "";?>
                </p>   <!--Print Session The user Logged  -->
            </div>
            <div class="list-item">
            <?php echo (CheckSession() && $DataUser2['trangthai'] == 2) ? 
            '<div class="manager">
                <span><i class="fas fa-users-cog"></i>
                </span>
                <form action="index.php" method="post">
                <a class="btn" href="manager.php">Manager</a>
                </form>
            </div>' : "";
            ?>
            <div class="logout">
                <span><i class="fas fa-sign-out-alt"></i>
                </span>
                <a href="logout.php" ">Logout</a>
            </div> <!-- Use Function logout is this <a> -->
            </div>
        </div><!-- End Of Side Nav -->
<div class="content">
    <div class="first-content" id="first-content">
        <h1>hi admin</h1>
    </div>
</div>
</div>
</body>
</html>