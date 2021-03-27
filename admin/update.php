<?php
    include '../database/db.php';
    $codeupdate = "XYZABC1234";
    $alertText = "";
    if(isset($_POST['code_submit'])){
        $code = $_POST['code_update'];
        if($codeupdate == $code){
            $alertText = "Thăng cấp thành công";
            UpdateData("personnel", $_SESSION['login'], "trangthai = 2");
            header("location: ../index.php");
        }else $alertText = "Thăng cấp thất bại";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form class="nap_lan_dau" action="update.php" method="post">
        <input class="inp" type="text" name="code_update" id="" placeholder="Nhập code để update">
        <input class="btn" type="submit" value="UDPATE" name="code_submit"> 
        <?php echo $alertText; ?>
    </form>
</body>
<script>
 if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    } 
</script>
</html>