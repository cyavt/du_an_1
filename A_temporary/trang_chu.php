<?php
require './connect/config.php';
$sql = "select * from trash";
$result = mysqli_query($connect, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển thị</title>
    <style>
        a{
            text-decoration: none;
            color: blue;
        }
    </style>
</head>

<body>
    <ul>
        <li><button><a href="./add/add_trash.php">Thêm thùng rác mới</a></button></li> <br>
        <li><button><a href="./add/add_info.php">Thêm thông tin người dùng</a></button></li>
    </ul>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Tên thùng rác</th>
            <th>Tên chủ hộ</th>
            <th>tình trạng rác</th>
            <th>Địa chỉ hiện tại</th>
            <th>Chi tiết</th>
        </tr>
        <?php
        foreach ($result as $data) : ?>
            <tr>
                <td><?= $data['id']; ?></td>
                <td><?= $data['user']; ?></td>
                <td><?php
                    $name_info = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `info` WHERE `trash_id`='" . $data['id'] . "'"));
                    if (isset($name_info['name'])) {
                        echo $name_info['name'];
                    } else {
                        echo '<i style="color: red">Không hoạt động</i>';
                    }
                    ?>
                </td>
                <td><?= ($data['state'] == 1) ? 'Đầy' : 'Rỗng'; ?></td>
                <td><?= $data['maps']; ?></td>
                <!-- Điều kiện khi hiển thị nút xem, thêm, xóa -->
                <?=(isset($name_info['name'])) ? '<td><center><button><a href="./detail.php?id=' . $data['id'] . '">See more</a></button></center></td>' : '<td><button><a href="./connect/xuly.php?xoa_trash=' . $data['id'] . '" style="color: red;">Delete</a></button> <button><a href="./add/add_info.php?id='.$data['id'].'">Add</a></button></td>';?>

            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>