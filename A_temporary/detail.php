<?php
    require './connect/config.php';
    if(isset($_GET['id'])):
    $info = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `info` WHERE `trash_id`='" . $_GET['id'] . "'"));
    if(isset($info)):
    //bật tắt chế độ chỉnh sửa người dùng
    $disabled = (isset($_GET['edit'])) ? ($_GET['edit'] === NULL) ? 'disabled' : '' : 'disabled' ;
    //Nếu ấn lưu
    if (isset($_POST['submit'])):
        $check_update = mysqli_query($connect, "UPDATE `info` SET `name` = '{$_POST['update_name']}', `phone` = '{$_POST['update_phone']}', `address` = '{$_POST['update_address']}', `note` = '{$_POST['update_note']}' WHERE `trash_id`='{$_GET['id']}'");
        if(isset($check_update)): header("Refresh:0"); else: echo('Thất bại'); endif;
    endif
    ?>
    <!-- Bắt đầu form xem chi tiết -->
    <form action="detail.php?id=<?=$info['trash_id'];?>" method="post">
    Tên:<input type="text" name="update_name" value="<?= $info['name']; ?>" <?=$disabled;?>><br>
    Sđt: <input type="number" name="update_phone" value="<?= $info['phone']; ?>" <?=$disabled;?>><br>
    Địa chỉ: <input type="text" name="update_address" value="<?= $info['address']; ?>" <?=$disabled;?>><br>
    Tình trạng / ghi chú: <input type="text" name="update_note" value="<?= $info['note']; ?>" <?=$disabled;?>><br>
    <!-- Điều kiện để hiển thị nút chỉnh sửa, xóa, lưu -->
    <?=(!isset($_GET['edit'])) ? '<button><a href="./detail.php?id='.$info['trash_id'].'&edit">Chỉnh sửa</a></button> <button><a href="./connect/xuly.php?xoa_info='.$info['trash_id'].'">Xóa</a></button>' : '<button type="submit" name="submit">Lưu</button>';?>
    
    </form>
    <!-- Kết thúc form xem chi tiết -->
<?php
    else:
        die('Không tồn tại giá trị, vui lòng thử lại !');
    endif;
 else :
    die(HACKER);
 endif;
?>