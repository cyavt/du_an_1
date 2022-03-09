<?php
session_start();
require '../connect/config.php';
if(isset($_SESSION['super_admin'])):
if(isset($_POST['submit'])){
    $check = mysqli_query($connect, "INSERT INTO `admin`(`id`, `uid`,`username`, `password`, `name`, `birthday`, `phone`, `email`, `address`) VALUES (NULL,'{$_POST['uid']}','{$_POST['username']}','{$_POST['password']}','{$_POST['name']}','{$_POST['birthday']}','{$_POST['phone']}','{$_POST['email']}','{$_POST['address']}')");
    if($check){
        echo '<script>alert("Đăng kí thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "./trang_chu.php?page=control"},0);</script>';
    }else{
        echo '<script>alert("Thất bại");</script>';
    }
}
?>

<body>
    <ul>
        <li><button><a href="./trang_chu.php?page=control">Quản lý nhân viên</a></button></li><br>
        <li><button><a href="./trang_chu.php?page=setting">Cài đặt hệ thống</a></button></li><br>
        <li><button><a href="../logout.php">Đăng xuất</a></button></li>
    </ul>
</body>
<!-- Trang chủ super_admin -->
<h3>chào mừng đến với trang admin</h3>
<!-- Quản lý nhân viên -->
<?php if (isset($_GET['page']) && $_GET['page'] == 'control') :
?>

    <!-- Thêm nhân viên -->
    <form action="" method="POST">
        UID: <input type="text" name="uid" required><br><br>
        Tên nhân viên: <input type="text" name="name" required><br><br>
        Ngày tháng năm sinh: <input type="date" name="birthday" required><br><br>
        Số điện thoại: <input type="number" name="phone" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        Địa chỉ: <input type="text" name="address" required><br><br>
        Tên đăng nhập: <input type="text" name="username" required><br><br>
        Mật khẩu: <input type="password" name="password" required><br><br>
        <button type="submit" name="submit">Gửi</button>
    </form>
    <!-- hiển thị thông tin nhân viên theo bảng-->
    <table border="1">
            <tr>
                <th>ID</th>
                <th>Tên nhân viên</th>
                <th>Ngày tháng năm sinh</th>
                <th>Số điện thoại</th>
                <th>Email</th>
                <th>Địa chỉ</th>
            </tr>
        <?php
        $result = mysqli_query($connect, "select * from admin");
        foreach ($result as $data) : ?>
            <tr>
                <td><?=$data['id'];?></td>
                <td><?=$data['name'];?></td>
                <td><?=$data['birthday'];?></td>
                <td><?=$data['phone'];?></td>
                <td><?=$data['email'];?></td>
                <td><?=$data['address'];?></td>
            </tr>
        <?php endforeach ?>
    </table>
<?php
endif;
?>
<!-- Cài đặt hệ thống -->
<?php if (isset($_GET['page']) && $_GET['page'] == 'setting') :
?>
    Cài đặt hệ thống
<?php
endif;
else :
    die(HACKER);
 endif;
?>