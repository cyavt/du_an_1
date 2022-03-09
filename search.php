<div class="ibox">
    <div class="ibox-title">
        <h5 class="text-muted text-center">Tìm kiếm theo danh sách hiện có</h5>
        <div class="ibox-tools">
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
            <a class="close-link">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content m-b-sm border-bottom">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="status">Tỉnh / Thành phố</label>
                    <select name="calc_shipping_provinces" class="form-control" required>
                        <option value="" selected>---</option>
                        <?php $data_city = mysqli_query($connect, "SELECT * FROM `user`");
                        foreach ($data_city as $row) : ?>
                            <option value="<?= $row['city']; ?>"><?= $row['city']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for="status">Quận / Huyện</label>
                    <select name="calc_shipping_district" class="form-control" required>
                        <option value="" selected>---</option>
                        <?php $data_city = mysqli_query($connect, "SELECT * FROM `user`");
                        foreach ($data_city as $row) : ?>
                            <option value=""><?= $row['district']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-2 b-r">
                <div class="form-group">
                    <label class="col-form-label" for="status">Xã / Phường</label>
                    <select id="calc_shipping_ward" class="form-control">
                        <option value="" selected>---</option>
                        <?php $data_city = mysqli_query($connect, "SELECT * FROM `user`");
                        foreach ($data_city as $row) : ?>
                            <option value=""><?= $row['ward']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <p>
            <div class="col-sm-2 text-center">
                <br>
                <button class="btn btn-primary btn-rounded" id="button_search">Tìm kiếm</button>
            </div>
            </p>
        </div>
    </div>
    <div class="row">
        <h3 class="text-muted text-center" id="result_search"></h3>
    </div>
</div>