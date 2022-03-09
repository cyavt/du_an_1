<?php
session_start();
require '../connect/config.php';
if (!isset($_SESSION['super_admin'])) :
    header("location: /admin");
    exit;
else :
    if (isset($_POST['submit'])) {
        $check = mysqli_query($connect, "INSERT INTO `admin`(`id`, `uid`,`username`, `password`, `name`, `birthday`, `phone`, `email`, `address`) VALUES (NULL,'{$_POST['uid']}','{$_POST['username']}','{$_POST['password']}','{$_POST['name']}','{$_POST['birthday']}','{$_POST['phone']}','{$_POST['email']}','{$_POST['address']}')");
        if ($check) {
            echo '<script>alert("Đăng kí thành công , đang chuyển hướng ...");setTimeout(function(){ window.location.href = "./home.php?page"});</script>';
        } else {
            echo '<script>alert("Chưa tạo thành công vui lòng thử lại !");</script>';
        }
    }
?>
    <!DOCTYPE html>
    <html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Trang Chủ</title>
        <link href="asset/css/bootstrap.min.css" rel="stylesheet">
        <link href="asset/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="asset/css/animate.css" rel="stylesheet">
        <link href="asset/css/style.css" rel="stylesheet">

    </head>

    <body class="top-navigation">

        <div id="wrapper">
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom white-bg">
                    <nav class="navbar navbar-expand-lg navbar-static-top" role="navigation">
                        <strong class="navbar-brand">ADMIN +</strong>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-reorder"></i>
                        </button>

                        <div class="navbar-collapse collapse" id="navbar">
                            <ul class="nav navbar-nav mr-auto">
                                <li <?= ($_GET['page'] == null) ? 'class="active"' : null; ?>>
                                    <a aria-expanded="false" role="button" href="./home.php?page">Tổng quang</a>
                                </li>
                                <li <?= ($_GET['page'] == 'add_agent') ? 'class="active"' : null; ?>>
                                    <a aria-expanded="false" role="button" href="./home.php?page=add_agent">Thêm nhân viên</a>
                                </li>
                                <li <?= ($_GET['page'] == 'setting') ? 'class="active"' : null; ?>>
                                    <a aria-expanded="false" role="button" href="./home.php?page=setting">Cài Đặt hệ thống</a>
                                </li>
                            </ul>
                            <ul class="nav navbar-top-links navbar-right">
                                <li>
                                    <a href="../logout.php">
                                        <i class="fa fa-sign-out"></i> Đăng xuất
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>

                <div class="wrapper wrapper-content">
                    <div class="container">

                        <?php if (isset($_GET['page'])) :
                            switch ($_GET['page']) {
                                case null:
                        ?>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="ibox ">
                                                <div class="ibox-content">
                                                    <h3>Tình trạng số lượng truy cập của website</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="ibox ">
                                                <div class="ibox-title">
                                                    <h3>Thông tin về server</h3>
                                                </div>
                                                <div class="ibox-content">
                                                    <div class="row">
                                                        <h5>Hiển thị thông tin</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ibox ">
                                                <div class="ibox-title">
                                                    <h5>Thống kê số nhân viên hiện có</h5>
                                                    <div class="ibox-tools">
                                                        <a class="collapse-link">
                                                            <i class="fa fa-chevron-up"></i>
                                                        </a>
                                                        <a class="close-link">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="ibox-content">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#ID</th>
                                                                    <th>Tên nhân viên</th>
                                                                    <th>Ngày tháng năm sinh</th>
                                                                    <th>Số điện thoại</th>
                                                                    <th>Email</th>
                                                                    <th>Địa chỉ</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $result = mysqli_query($connect, "select * from admin");
                                                                foreach ($result as $data) : ?>
                                                                    <tr>
                                                                        <td><?= $data['id']; ?></td>
                                                                        <td><?= $data['name']; ?></td>
                                                                        <td><?= $data['birthday']; ?></td>
                                                                        <td><?= $data['phone']; ?></td>
                                                                        <td><?= $data['email']; ?></td>
                                                                        <td><?= $data['address']; ?></td>
                                                                    </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                <?php
                                    break;
                                    // TRANG CÀI ĐẶT HỆ THỐNG
                                case 'setting':
                                ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ibox ">
                                                <div class="ibox-content">
                                                    <h3>TRANG CÀI ĐẶT HỆ THỐNG</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    break;
                                    //TRANG THÊM NHÂN VIÊN
                                case 'add_agent':
                                ?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="ibox ">
                                                <div class="ibox-content">
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                    break;
                            }
                        else :
                            header("location: ../page/404.php");
                        endif; ?>

                    </div>
                </div>

                <div class="footer">
                    <div class="float-right">
                        10GB of <strong>250GB</strong> Free
                    </div>
                    <div>
                        UTE &copy; 20222
                    </div>
                </div>

            </div>
        </div>



        <!-- Mainly scripts -->
        <script src="asset/js/jquery-3.1.1.min.js"></script>
        <script src="asset/js/popper.min.js"></script>
        <script src="asset/js/bootstrap.js"></script>
        <script src="asset/js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="asset/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

        <!-- Custom and plugin javascript -->
        <script src="asset/js/inspinia.js"></script>
        <script src="asset/js/plugins/pace/pace.min.js"></script>

        <!-- Flot -->
        <script src="asset/js/plugins/flot/jquery.flot.js"></script>
        <script src="asset/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
        <script src="asset/js/plugins/flot/jquery.flot.resize.js"></script>

        <!-- ChartJS-->
        <script src="asset/js/plugins/chartJs/Chart.min.js"></script>

        <!-- Peity -->
        <script src="asset/js/plugins/peity/jquery.peity.min.js"></script>
        <!-- Peity demo -->
        <script src="asset/js/demo/peity-demo.js"></script>


    </body>

    </html>
<?php
endif;
?>