<?php
    session_start();
    // hàm riêng biệt, được sử dụng xóa session
    function EndSession(){
        session_unset();
        session_destroy();
    }
    // Ta sẽ lấy các hàm và dữ liệu từ database để xử lý hệ thống đăng nhập
    include 'database.php';
    // =============================================================================================
    // Phần xử lý đăng nhập - dăng ký :
    $alerttext = "";
    // 1. Hàm bắt lỗi đăng nhập
    function AlertText($bool, $str){ 
        // Kiểm tra dạng nhập và lỗi 
        if(!$bool && $str == "pass")
            return "Mật khẩu không chính xác";
        else if(!$bool && $str == "user") 
            return "Tài khoản không tồn tại";
        return "";
    }
    // (*) : Các phần giá trị nhập vào sẽ được lấy từ $_POST
    // 2. Hàm xử lý đăng nhập
    function Login($username, $password){
        $tablename = "Personnel";
        $Mpassword = md5($password);
        $checkUsername = SearchSingleData($tablename, "tentaikhoan", "\"$username\"");
        $checkPassword = SearchSingleData($tablename, "matkhau", "\"$Mpassword\"");
        if($checkUsername && !$checkPassword)
            return AlertText($checkPassword, "pass");
        else if(!$checkUsername && $checkPassword)
            return AlertText(false, "user");
        else if(!$checkUsername && !$checkPassword)
            return AlertText(false, "user");
        else { 
            $id = $checkUsername[0]['id'];
            $_SESSION['login'] = $id;
            return true;
        }
    }
    // Cấu trúc hàm Login:  Login("tentaikhoan", "matkhau");
    // (*) Hàm kiểm tra Session 
    function CheckSession(){
        return isset($_SESSION['login']);
    }
    // 3. Hàm xử lý giá trị đăng ký
    function CheckRegister($form, $value){ 
        if($form == "tentaikhoan") { 
            $Nvalue = trim($value);
            if(intval($Nvalue[0])) // sử dụng hàm intval - chuyển đổi string -> int dể xác nhận
            return false; 
        }
        // Xác nhận tên bảng
        $tablename = "Personnel";
        // Gọi toàn bộ dữ liệu ra để kiểm tra giá trị người dăng ký nhập vào
        $AllData = getAllData($tablename);
           // Để tránh trường hợp lỗi foreach, ta chỉ cho nó thực hiện khi bảng không rỗng dữ liệu 
        if(!empty($AllData) && !empty($value)){
            foreach($AllData as $data){  // Chạy vòng lặp foreach để kiểm tra 
                if($data[$form] === $value){
                return false; 
                break; }
            }   
        }
        // Nếu không có dữ liệu nào trong bảng giống với giá trị, ta sẽ trả về true 
        return true;
    }
    // Cấu trúc hàm CheckRegister : CheckRegister("tentaikhoan/manhanvien", "giatrinhapvao");
 
    // 4. Hàm xử lý đăng ký
    function Register($inforArr){ // inforArr : ta sẽ gửi các giá trị nhập vào của người dùng vào hàm SQL ở dạng chuỗi
        // sau đó chuyển mảng thành dạng string
        $datasInsert = implode(", ", $inforArr);
        // rồi gửi nó vào hàm thêm dữ liệu trong file database
        InsertData("personnel", $datasInsert);
    }
    // Cấu trúc hàm Register : Register(["manhanvien" => "\"user_0001\"", "tentaikhoan" => "\"userUN\"", "matkhau" => "\"123456\"", "ngaytao" => "\"$date\"", "trangthai" => 1]);

    // ================================================================================================
    // Phần Admin : Khi người dùng là Admin quản lý thông tin
    // 1: Chức năng sửa 
    function Admin_Edit($id, $editstr){
        UpdateData("personnel", $editstr, $id);
    }
    // 2: Chức năng xóa 
    function Admin_Delete($id){
        DeleteData("personnel", $id);
    }
    // 3: Chức năng thêm 
    function Admin_Add($sqlstr){
        Register($sqlstr);
    }
    // ==========================================================================================
    // Phần dữ liệu User : Khi người dùng đăng nhập thành công
    // (*) Hàm in ra dữ liệu người dùng
    function SelectInforUser(){
        // nếu như có tồn tại session, ta sẽ trả về dữ liệu cần thiết của người dùng
        if(CheckSession()){
           return GetSomeData("personnel", $_SESSION['login'], "manhanvien, tentaikhoan, ngaytao, trangthai")[0];
        }
        // còn ngược lại, ta sẽ trả về dạng mảng dữ liệu vô chủ
        else return "";
    }
    function Decentralization($status){
        switch($status){
            case "1": {
                return "User";
                break;
            }
            case "2": {
                return "Admin";
                break;
            }
            default: {
                return "Guest";
                break;
            }
        }
    }

    function ConfirmStatus($status)
    {
        return ($status == "2") ? true : false;
    }


    // function CheckUsername($username){
    //     $sqlCheck = "SELECT tentaikhoan FROM personnel WHERE tentaikhoan = $username";
    //     $check = Execute($sqlCheck);
    //     return $check;
    // }
    // function CheckUsername_P($username){
    //     $sql = "SELECT tentaikhoan FROM personnel";
    //     $column = ConvertData(Execute($sql));
    //     // var_dump($column);
    //     foreach($column as $col){
    //         if($username === $col['tentaikhoan']){
    //             return false;
    //             break;
    //         }
    //     }
    //     return true;
    // }
    // var_dump(CheckUsername_P("nguyenthanhphu1"));
?>