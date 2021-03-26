<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "employeemanager";
    $conn = mysqli_connect($servername,$username,$password,$dbname);
    if($conn->connect_error){
        die("Connection Failed". $conn->connect_error);
    } 
    function CheckSession(){
        return (isset($_SESSION['login'])) ? true : false;
    }
    function StartSession($tablename, $id){
        $sql = "SELECT * FROM $tablename WHERE id=$id";
        if($GLOBALS['conn']->query($sql))
            $_SESSION['iduser'] = $id;
        else return false;

        return $_SESSION['iduser'];
    }
    function EndSession(){
        session_unset();
        session_destroy();
    }
    // var_dump(Execute("SELECT * FROM personnel", $conn));
    function SearchData($tablename, $namekey, $key){
        $sql = "SELECT * FROM $tablename WHERE $namekey = $key";
        $dataU = $GLOBALS['conn']->query($sql);
        if(!$dataU)
        return false;
        else if($dataU->num_rows > 0){
            while($row = $dataU->fetch_assoc()){
                $data[] = $row;
            }
        }
        else{
            $data[] = "";
        }
        return $data;
    }
    function InsertData($tablename, $sqlstr){
        $sql = "INSERT INTO $tablename VALUES($sqlstr)";
        return $GLOBALS['conn']->query($sql);
    }
    function getSomeAllData($tablename, $keyname){
        $sql = "SELECT $keyname FROM $tablename";
        $dataU = $GLOBALS['conn']->query($sql);
        if($dataU->num_rows > 0){
            while($row = $dataU->fetch_assoc()){
                $data[] = $row;
            }
        }
        else{
            $data = "";
        }
        return $data;
    }
    function getData($tablename, $id){
        $sql = "SELECT * FROM $tablename WHERE id=$id";
        $dataU = $GLOBALS['conn']->query($sql);
        if($dataU->num_rows > 0){
            while($row = $dataU->fetch_assoc()){
                $data[] = $row;
            }
        }
        else{
            $data = "";
        }
        return $data[0];
    }

    // $conn->query("TRUNCATE TABLE personnel");
?>