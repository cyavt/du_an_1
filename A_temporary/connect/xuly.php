<?php
require './config.php';
if (isset($_GET['xoa_trash']) || isset($_GET['xoa_info'])):
    if (isset($_GET['xoa_trash']) && isset($_GET['xoa_info'])):
        die('Vui lòng chỉ nhập một giá trị');
    else:
        //Điều kiện chống bug
        if(isset($_GET['xoa_info'])){ $_GET['xoa_trash'] = null; }
        if(isset($_GET['xoa_trash'])){ $_GET['xoa_info'] = null; }

        //xóa thùng rác  
        $check_id_trash = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `trash` WHERE `id`='" . $_GET['xoa_trash'] . "'"));
        if($check_id_trash != NULL){
            $xoa_trash = mysqli_query($connect, "DELETE FROM `trash` WHERE `id`='" . $_GET['xoa_trash'] . "'");
            if ($xoa_trash) {
                //var_dump($xoa_trash);
                //die();
                echo ('<script>alert("Xóa thành công thùng rác");setTimeout(function(){ window.location.href = "/"});</script>');
            } else {
            die('Xóa không thành công vui lòng thử lại  !');
            }
        }

        //xóa thông tin người dùng
        $check_id_info = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `info` WHERE `trash_id`='" . $_GET['xoa_info'] . "'"));
        if (isset($check_id_info)) {
            $xoa_info = mysqli_query($connect, "DELETE FROM `info` WHERE `trash_id`='" . $_GET['xoa_info'] . "'");
            if ($xoa_info) {
                echo ('<script>alert("Xóa thành công người dùng");setTimeout(function(){ window.location.href = "/"});</script>');
            } else {
                die('Xóa không thành công vui lòng thử lại !');
            }
        } else {
            die('Giá trị không tồn tại để xóa vui lòng thử lại');
        }
        
    endif;
else:
    die(HACKER);
endif;
