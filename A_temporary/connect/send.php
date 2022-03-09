<?php
require './config.php';
if(isset($_GET['key'])):
        if ($_GET['key'] == 'a'):
                $user = $_POST["user"];
                $state = $_POST["state"];
                $maps = $_POST["maps"];
                $sql = "insert into trash(user, state, maps) values('$user', '$state', '$maps')";
                mysqli_query($connect, $sql);
                mysqli_close($connect);
                echo '<script>alert("Thêm thành công thùng rác mới");setTimeout(function(){ window.location.href = "/"});</script>';
        elseif($_GET['key'] == 'b'):
                $name = $_POST["name"];
                $phone = $_POST["phone"];
                $address = $_POST["address"];
                $note = $_POST["note"];
                $trash_id = $_POST["trash_id"];

                $sql = "insert into info(name, phone, address, note, trash_id) values('$name', '$phone', '$address', '$note', '$trash_id')";
                mysqli_query($connect, $sql);
                mysqli_close($connect);
                echo '<script>alert("Nhập thành công thông tin thùng rác");setTimeout(function(){ window.location.href = "/"});</script>';
        endif;
else:
        die(HACKER);
endif;