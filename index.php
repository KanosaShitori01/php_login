<?php
        include './database/db.php';
        if(CheckSession()) $DataUser = getData("personnel", $_SESSION['login']);
        if(isset($_POST['log_in'])){
            header("location: Log/login.php");
            if(isset($_SESSION['login'])) { 
                header("location: index.php");
                EndSession();
            }
        }
        
?>
<!-- ========================================================================================================= -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Main Page <?php echo CheckSession() ? "Of ".$DataUser['tentaikhoan']: ""; ?></h1>
    <h1>Welcome <?php echo CheckSession() ? $DataUser['tentaikhoan'] : "";?></h1>
    <?php 
        if(CheckSession()){
            $position = Decentralization($DataUser['trangthai']);
        }
        echo (isset($_SESSION['login'])) ? "<h1>Membership Code: {$DataUser['manhanvien']}</h1>" : "";
        echo (isset($_SESSION['login'])) ? "<h1>Position: {$position}</h1>" : "";
    ?>
    <form class="form-main" action="index.php" method="post">
        <div class="log-reg">
            <input class="btn" type="submit" name="log_in" value="<?php  
            echo (isset($_SESSION['login'])) ? "Logout" : "Login"; ?>">
            <?php 
            echo (CheckSession()) ? "" : '<a class="btn" href="./log/register.php">Register</a>';
            echo (CheckSession() && $DataUser['trangthai'] == 2) ? '<a class="btn" href="./admin/admin.php">Admin</a>' : "";    
            ?>
        </div>
        <div class="uplevel">
            <?php echo (CheckSession() && $DataUser['trangthai'] == 1) ? '<a class="btn" href="./admin/update.php">Update</a>' : ""; ?>
        </div>
    </form>
</body>
<script>
 if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    } 
</script>
</html>
