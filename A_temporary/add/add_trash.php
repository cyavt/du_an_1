<?php
    require '../connect/config.php';
    //$user_id = mysqli_fetch_row(mysqli_query($connect, "SELECT MAX(id) FROM `trash`"));
    //$user_id[0] + 1; Lấy ra giá trị id lớn nhất
?>
<h3>Thêm thùng rác</h3>
<form action="../connect/send.php?key=a" method="post">
    Tên thùng rác
    <input type="text" name="user" value="Thùng rác số "><br><br>
    Tình trạng
    <select name="state" id="">
        <option value="2">Rỗng</option>
        <option value="1">Đầy</option>
    </select>
    <br><br>
    Địa chỉ hiện tại
    <input type="text" name="maps"><br><br>
    Mã định danh <small style="color: red;">(inactive)</small>
    <input type="text" name="token" value="Access Token connect" disabled><br><br>
    <button type="submit">Thực hiện</button>
</form>
</br>