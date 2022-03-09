<?php
require './connect/config.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $acc = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `admin` WHERE `username`='" . $username . "'"));
    if (!$acc) {
        echo 'Tài Khoản không tồn tại';
    } else if ($password != $acc['password']) {
        echo 'Sai mật khẩu';
    } else {
        $_SESSION['username'] = $username;
        echo '<script>alert("Đăng nhập thành công");setTimeout(function(){ window.location.href = "/"});</script>';
    }
}
?>
<form action="/" method="POST">
    Tài Khoản: <input type="text" name="username" required><br><br>
    Mật Khẩu: <input type="password" name="password" required><br><br>
    <button type="submit" name="submit">Gửi</button>
</form>