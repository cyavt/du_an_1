<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5 class="text-muted text-center">LỊCH SỬ XỬ LÝ RÁC</h5>
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
                    <table class="table table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>ID thùng rác</th>
                                <th>Cân nặng</th>
                                <th>Nhân viên thu gom</th>
                                <th>Thời gian</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $result = mysqli_query($connect, "SELECT * FROM `log_activities`");
                            foreach( $result as $rows): ?>
                            <tr>
                                <td><?=$rows['id']?></td>
                                <td><?=$rows['trash_can_id']?></td>
                                <td><span class="pie"><?=$rows['weight']?>/10</span> <?=$rows['weight']?> kg</td>
                                <td>
                                    <?php 
                                    $staffid = mysqli_fetch_array(mysqli_query($connect, "SELECT `name` FROM `admin` WHERE `uid` = '{$rows['staffid']}'"));
                                    echo($staffid['name']);
                                    ?>
                                </td>
                                <td><?=$rows['datetime']?></td>
                                <td class="text-center"><button class="btn btn-info btn-sm" data-toggle="modal" data-target="#btn_log" type="button" onclick="xem('<?=$rows['trash_can_id']?>')"><i class="fa fa-eye"></i></button></td>
                            </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>