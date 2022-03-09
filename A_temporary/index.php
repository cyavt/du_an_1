<?php
session_start();
if(isset($_SESSION['username'])){
    include './trang_chu.php';  
}else{
    include './login.php';  
}
?>