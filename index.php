<?php
        include 'db.php';
        if(CheckSession()) $DataUser = getData("personnel", $_SESSION['login']);
        if(isset($_POST['log_in'])){
            header("location: login.php");
            if(isset($_SESSION['login'])) { 
                header("location: index.php");
                EndSession();
            }
        }
        else if(isset($_POST['sign_in'])){
            header("location: register.php");
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
    <h1>Main Page <?php echo CheckSession() ? "Of ".$DataUser['tentaikhoan']:""; ?></h1>
    <h1>Welcome <?php echo CheckSession() ? $DataUser['tentaikhoan'] : "";?></h1>
    <?php 
        echo (isset($_SESSION['login'])) ? "<h1>Position Job: {$DataUser['vitri']}</h1>" : "";
        echo (isset($_SESSION['login'])) ? "<h1>Membership Code: {$DataUser['manhanvien']}</h1>" : "";
    ?>
    <form class="form-main" action="index.php" method="post">
        <div class="log-reg">
            <input class="btn" type="submit" name="log_in" value="<?php  
            echo (isset($_SESSION['login'])) ? "Logout" : "Login"; ?>">
            <input class="btn" type="submit" name="sign_in" value="Register">
        </div>

        <div class="uplevel">
            <input class="btn" type="submit" value="Update">
        </div>
    </form>
</body>
<script>
 if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    } 
</script>
</html>
