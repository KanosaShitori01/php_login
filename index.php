<?php 
    include './db/Infor_control.php';
    $DataUser = SelectInforUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<body>
    <div class="content_user">
        <h1>Welcome you. <?php echo ($DataUser !== "") ? $DataUser['tentaikhoan'] : "Admin"; ?></h1>
        <?php 
            (CheckSession()) ? $positionU = Decentralization($DataUser['trangthai']) : "";
            if($DataUser !== ""){
                $dateVN = DateMadeInVN($DataUser['ngaytao']);   
                echo "<ul>
                    <li>Mã tài khoản: {$DataUser['manhanvien']}</li>
                    <li>Tên tài khoản: {$DataUser['tentaikhoan']}</li>
                    <li>Cấp quyền: {$positionU}</li>
                    <li>Ngày tạo tài khoản: {$dateVN}</li>
                </ul>";
            } else echo "";
        ?>
    </div>
    <div class="log_reg">
        <?php echo CheckSession() ? '<a href="./components/logIn/logout.php">Logout</a>' : '<a href="./components/logIn/login.php">Login</a>';
              echo CheckSession() ? '' : ' <a href="./components/logIn/register.php">Register</a>';
              echo (CheckSession() && $DataUser['trangthai'] == "2") ? ' <a href="./components/admin/">Admin</a>' : '';
              echo (CheckSession() && ($DataUser['trangthai'] == "1" || $DataUser['trangthai'] == "2")) ? ' <a href="./components/user/">Edit</a>' : "";
        ?>
    </div>
</body>
</html>