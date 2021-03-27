<?php
    include '../database/db.php';
    if(!CheckSession()){
        header("location: ../index.php");
    }
    $DataUsers = getAllData("personnel");
    
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        DeleteData("personnel", $id);
        header("Refresh: 0 url=admin.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="admin.php" method="get">
        <table border="1" cellspacing=0 cellpadding=0>
            <tr>
                <td colspan="6" style="text-align: left;"> <a href="../index.php">Go Back</a></td>
            </tr>
            <tr>
                <th>STT</th>
                <th>Tên Tài Khoản</th>
                <th>Mã Nhân Viên</th>
                <th>Ngày tạo</th>
                <th>Chức quyền</th>
                <th>Điều khiển</th>
            </tr>
            <?php 
                if(gettype($DataUsers) == "array"){
                    $stt = 1;
                    foreach($DataUsers as $data){
                        $permission = Decentralization($data['trangthai']);
                        if($permission == "admin"){
                            continue;
                        }
                        else{
                            echo "<tr>";
                            echo "<td>$stt</td>";
                            echo "<td>{$data['manhanvien']}</td>";
                            echo "<td>{$data['tentaikhoan']}</td>";
                            echo "<td>{$data['ngaytao']}</td>";
                            echo "<td>{$permission}</td>";
                            echo "<td class='function_admin'>
                                <a href='./function/edit.php?user={$data['id']}'>Edit</a> | 
                                <a onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")' href='admin.php?delete={$data['id']}'>Delete</a>
                            </td>";
                            echo "</tr>";
                        }
                        $stt++;
                    }
                }
                else{
                    echo "<tr>";
                    echo "<td colspan='5'>Rỗng</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </form>
</body>
<script>
 if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
    } 
    // history.back();
</script>
</html>