<div class="animated fadeInRight" id="content1">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>DANH SÁCH THÙNG RÁC</h5>
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
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Tên người dùng</th>
                                    <th>Vị trí</th>
                                    <th>Cân nặng</th>
                                    <th>Mức độ lưu trữ</th>
                                    <th>Tùy chỉnh</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $result = mysqli_query($connect, "SELECT * FROM `trash_can`");
                                foreach ($result as $row) :
                                    $name = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM `user` WHERE `trash_can_id`='{$row['id']}'"));
                                ?>
                                    <tr>
                                        <td><?= $row['id']; ?></td>
                                        <td><?= (isset($name['name'])) ? $name['name'] : '<i class="label label-danger">inactive</i>'; ?></td>
                                        <td><a href="https://www.google.com/maps/place/<?= $row['location']; ?>" target="_blank"><?= $row['location']; ?></a></td>
                                        <td><span class="pie"><?= number_format($row['weight']); ?>/5</span> <?= number_format($row['weight']); ?>kg</td>
                                        <td class="project-completion">
                                            <small><?= number_format($row['garbagepercent']); ?>%</small>
                                            <div class="progress progress-mini">
                                                <div style="width: <?= number_format($row['garbagepercent']); ?>%;" class="progress-bar <?php if (number_format($row['garbagepercent']) >= 70) {
                                                                                                                                            echo ('progress-bar-danger');
                                                                                                                                        } ?>"></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-center">
                                                <?php if (isset($name['name'])) : ?>
                                                    <button class="btn btn-primary" onclick="xem('<?= $row['id']; ?>')"><i class="fa fa-long-arrow-right"></i></button>
                                                <?php else : ?>
                                                    <button class="btn btn-danger" onclick="xoatrash('<?= $row['id']; ?>')"><i class="fa fa-trash"></i></button>
                                                    <button data-toggle="modal" onclick="add('<?= $row['id']; ?>')" data-target="#add" class="btn btn-success"><i class="fa fa-plus-square-o"></i></button>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PHẦN CHỈNH XEM, CHỈNH SỬA NGƯỜI DÙNG -->

<div class="social-feed-separated animated fadeInRight" id="content2" style="display:none;">
    <div class="social-feed-box">
        <div class="social-avatar">
            <h3 class="text-muted text-center">THÔNG TIN NGƯỜI DÙNG</h3>
        </div>
        <div class="social-body">
            <form class="form-horizontal">
                <div class="form-group"><label class="col-sm-2 control-label">TRASH CAN UID</label>
                    <div class="col-sm-10"><input type="text" id="vaL0" class="form-control" disabled></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Họ và tên</label>
                    <div class="col-sm-10"><input type="text" id="vaL1" class="form-control" disabled></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Ngày sinh</label>
                    <div class="col-sm-10"><input type="text" id="vaL2" class="form-control" disabled></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Số điện thoại</label>
                    <div class="col-sm-10"><input type="text" id="vaL3" class="form-control" disabled></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Ngày bị nhiễm F0</label>
                    <div class="col-sm-10"><input type="text" id="vaL4" class="form-control" disabled></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10"><input type="text" id="vaL5" class="form-control" disabled></div>
                </div>
                <div class="form-group"><label class="col-sm-2 control-label">Địa chỉ</label>
                    <div class="col-sm-10"><input type="text" id="vaL6" class="form-control" disabled></div>
                </div>
            </form>
            <p>
                <hr>
            </p>
            <div class="text-center">
                <button class="btn btn-primary btn-rounded btn-sm" id="btn1"><i class="fa fa-chevron-circle-left"></i> Back</button>
                <button class="btn btn-warning btn-rounded btn-sm" data-toggle="modal" data-target="#edit"><i class="fa fa-check"></i> Chỉnh sửa</button>
                <button class="btn btn-danger btn-rounded btn-sm" id="xoauser"><i class="fa fa-trash"></i><span> Xóa</span> </button>
            </div>
        </div>
    </div>
</div>