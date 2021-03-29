<?php
    $servername = "localhost"; // tên server
    $username = "root"; // tên admin
    $password = ""; // mật khẩu
    $dbname = "employeemanager"; // tên database
    // Kết nối cơ sở dữ liệu
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Kiểm tra kết nối
    if(!$conn){
        die("Connection Failed ". $conn);
    }
    // Hàm nhận lệnh SQL
    function Execute($sql){
        return $GLOBALS['conn']->query($sql);
    }
    // ===================================================== 
    // Các hàm xử lý SQL 
    // =>=>=>=>=>
    // * : Truy xuất dữ liệu ra dạng Array 
    function ConvertData($Bdata){
        if($Bdata){ // Kiểm tra xem lệnh SQL có chạy thành công không?
            // Nếu không thì thực hiện lệnh lấy dữ liệu từ đó
            if($Bdata->num_rows > 0) {
                // Nếu các cột trong bảng dữ liệu đó không trống thì sẽ chuyển đổi thành dạng mảng và nạp vào biến data
                while($row = $Bdata->fetch_assoc())
                $data[] = $row; 
            }   else $data = ""; // Ngược lại, thì sẽ trả về dạng chuỗi rỗng
        }
        else  return false; // Nếu SQL không chạy thành công sẽ trả về false 
        return $data;
         // Sau tất cả, nó sẽ trả về toàn bộ dữ liệu đáp ứng đúng điều kiện được cho
    }
    // 1: Lấy dữ liệu bằng Id
    function getData($tablename, $id){
        $sql = "SELECT * FROM $tablename WHERE id=$id";
        return ConvertData(Execute($sql));
    }
    // 2: Lấy dữ liệu bằng bất cứ trường nào 
    function SearchSingleData($tablename, $keyname, $key){
        $sql = "SELECT * FROM $tablename WHERE $keyname=$key";
        return ConvertData(Execute($sql));
    }
    // 3: Lấy toàn bộ dữ liệu trong bảng 
    function getAllData($tablename){
        $sql = "SELECT * FROM $tablename";
        // Cũng y hệt như getData, nhưng không có điều kiện 
        return ConvertData(Execute($sql));
    }
    // 4: Thêm dữ liệu 
    function InsertData($tablename, $sqlstr){
        // phần sqlstr là dạng string nhận các giá trị của trường được thêm vào thông qua phần xử lý
        // VD: "$username, $password, $manhanvien, $ngaytao, $trangthai"
        $sql = "INSERT INTO $tablename VALUES(NULL,$sqlstr)";
        return Execute($sql);
    }
    // 5: Cập nhật dữ liệu thông qua ID
    function UpdateData($tablename, $sqlstr, $id){
        // Cấu trúc $sqlstr: "username = $username, password = $password, vv...";
        $sql = "UPDATE $tablename SET $sqlstr WHERE id=$id";
        return Execute($sql); 
    }
    // 6: Xóa dữ liệu thông qua ID 
    function DeleteData($tablename, $id){
        $sql = "DELETE FROM $tablename WHERE id=$id";
        return Execute($sql);
    }
    // 7: In ra một số dữ liệu 
    function GetSomeData($tablename, $id, $sqlstr){
        $sql = "SELECT $sqlstr FROM $tablename WHERE id=$id";
        return ConvertData(Execute($sql));
    }
    // =======================================================
?>