<?php
require './config.php';
//$token = $location = $weight = $garbagepercent = $uid = '';
var_dump($_POST); // trả dữ liệu về cho server
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = test_input($_POST["token"]);
    $check_token = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `trash_can` WHERE `token`='$token'"));
    if ($check_token) {
        //Gán biến
        $location = test_input($_POST["location"]);
        $weight = test_input($_POST["weight"]);
        $garbagepercent = test_input($_POST["garbagepercent"]);
        $uid = test_input($_POST["uid"]);
        //kết nốt -> update cơ sở dữ liệu
            $update = mysqli_query($connect, "UPDATE `trash_can` SET `location`='$location',`weight`='$weight',`garbagepercent`='$garbagepercent' WHERE `token`='$token'");
            if ($update){
                echo "success update";
            } else {
                echo "Error:" . $connect->error;
            }
        //log_activities
            $check_uid = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `admin` WHERE `uid`='$uid'"));
            if ($check_uid) {
                    $row = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `trash_can` WHERE `token`='$token'"));
                    $log = "insert into log_activities(
                        trash_can_id, weight, staffid, datetime) values('{$row["id"]}', '{$row["weight"]}', '{$check_uid["uid"]}', '$datetime')";
                    if ($connect->query($log) === TRUE) {
                        echo " and LOG";
                    }else{
                        echo " and LOG FAIL";
                    }
            }else{
                echo " | Không phải nhân viên -> Log thất bại !";
            }
        //đóng kết nối
        $connect->close();
    } else {
        echo ('Không tồn tại token');
    }
} else {
    echo "No data posted with HTTP POST.";
}

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
