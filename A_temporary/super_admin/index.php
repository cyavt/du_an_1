<?php
    session_start();
    require '../connect/config.php';
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $acc = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `super_admin` WHERE `username`='" . $username . "'"));
        if (!$acc) {
            echo 'Tài Khoản không tồn tại';
        } else if ($password != $acc['password']) {
            echo 'Sai mật khẩu';
        } else {
            $_SESSION['super_admin'] = $username;
            echo '<script>alert("Đăng nhập thành công");setTimeout(function(){ window.location.href = "./trang_chu.php"});</script>';
        }
    }
?>

<form action="" method="POST">
    Tài Khoản: <input type="text" name="username"><br><br>
    Mật Khẩu: <input type="text" name="password"><br><br>
    <button type="submit" name="submit">Gửi</button>
</form>