<?php
    include '../../db/Infor_control.php';
    if(!CheckSession()) header("location: ../../index.php");
    $AllData = getAllData("personnel");
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        Admin_Delete($id);
        header("Refresh: 0; url=index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<style>
    table{
        text-align: center;
    }
</style>
<body>
    <table border="1" cellspacing="0">
        <tr>
            <td colspan="4"><a href="../../index.php">Go Back</a></td>
            <td colspan="2"><a href="./add.php">Thêm User</a></td>
        </tr>
        <tr>
            <th>STT</th>
            <th>Mã Nhân Viên</th>
            <th>Tên Tài Khoản</th>
            <th>Ngày tạo</th>
            <th>Chức quyền</th>
            <th>Thao tác</th>
        </tr>
            <?php
                if(!empty($AllData)){
                    $stt = 1;
                    foreach($AllData as $data){
                        if($data['trangthai'] != "2"){
                        echo "<tr>";
                        echo "<td>{$stt}</td>";
                        echo "<td>{$data['manhanvien']}</td>";
                        echo "<td>{$data['tentaikhoan']}</td>";
                        echo "<td>{$data['ngaytao']}</td>";
                        echo "<td>{$data['trangthai']}</td>";
                        echo "<td>
                            <a href='./edit.php?id={$data['id']}'>Edit</a>
                            <a href='./index.php?delete={$data['id']}'>Delete</a>
                        </td>";
                        echo "</tr>";
                        }
                        $stt++;
                    }
                }
            ?>
    </table>
</body>
</html>