<?php
    require '../connect/config.php';
    $result = mysqli_query($connect, "select * from trash");
    if (isset($_GET['id'])) :
        $check_id_trash = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `trash` WHERE `id`='{$_GET['id']}'"));
        $acc_trash_id = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `info` WHERE `trash_id`='{$_GET['id']}'"));
        //var_dump($check_id_trash);
        //die();
        if(isset($check_id_trash) && !isset($acc_trash_id)):
            $name_trash = mysqli_fetch_array(mysqli_query($connect, "SELECT `user` FROM `trash` WHERE `id`='{$_GET['id']}'"));
 ?>
 <!-- Thêm thông tin ngườu dùng phụ -->
<h3>Thêm thông tin</h3>
<form action="../connect/send.php?key=b" method="post">
    Tên bệnh nhân
    <input type="text" name="name"><br><br>
    Số điện thoại
    <input type="number" name="phone"><br><br>
    Địa chỉ cư trú
    <input type="text" name="address"><br><br>
    Tình trạng bệnh nhân
    <input type="text" name="note"><br><br>
    Loại thùng rác
    <select name="trash_id">
        <option value="<?= $_GET['id'];?>">
            <?= $name_trash[0]; ?>
            </option>
    </select>
    <button type="submit">Gửi</button>
</form>
 <?php
        else:
            die(HACKER);
        endif;
    else:       
?>
<!-- Thêm thông tin người dùng chính -->
<h3>Thêm thông tin người sử dụng</h3>
<form action="../connect/send.php?key=b" method="post">
    Tên bệnh nhân
    <input type="text" name="name"><br><br>
    Số điện thoại
    <input type="number" name="phone"><br><br>
    Địa chỉ cư trú
    <input type="text" name="address"><br><br>
    Tình trạng bệnh nhân
    <input type="text" name="note"><br><br>
    Loại thùng rác
    <select name="trash_id">
        <?php foreach ($result as $data) : ?>
            <option value="<?= $data['id']; ?>" 
            <?php
            $acc_trash_id = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `info` WHERE `trash_id`='{$data['id']}'"));
            echo (isset($acc_trash_id)) ? 'disabled': '' ?>>
            <?= $data['user']; ?>
            </option>
        <?php endforeach ?>
    </select>
    <button type="submit">Gửi</button>
</form>
<?php
 endif;    
?>