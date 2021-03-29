

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
<?php
    if(!CheckSession()){
        header("location: index.php");
    }
    $DataUsers2 = getAllData("personnel");
    
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        DeleteData("personnel", $id);
        header("Refresh: 0 url=manager.php");
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
                <?php echo (CheckSession() && $DataUser2['trangthai'] == 2) ? '<a class="btn" href="#">Manager</a>': ""; ?>
                </form>
            </div>
            <div class="logout">
                <span><i class="fas fa-sign-out-alt"></i>
                </span>
                <a href="logout.php" ">Logout</a>
            </div> <!-- Use Function logout is this <a> -->
            </div>
        </div><!-- End Of Side Nav -->
    <div class="content">
        <div class="table-container" id="table">
        <!-- This container will appear when the user click manager remember this container will return error when user not admin -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Account Name</th>
                    <th>employee code</th>
                    <th>Date Created</th>
                    <th>Permissionn</th>
                    <th>Control</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if(gettype($DataUsers2) == "array"){
                    $stt = 1;
                    foreach($DataUsers2 as $data){
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
                            echo "<td class='control'>
                                <a href='update.php?user={$data['id']}'>Edit</a>
                                <a onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")' href='manager?delete={$data['id']}'>Delete</a>
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
            </tbody>
        </table>
    </div>
        </div>
</div>
</body>
</html>