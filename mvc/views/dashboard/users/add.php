
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
       Thêm mới tài khoản người dùng
        </h6>
    </div>
    <div class="card-body">
        <div class="">
        <div class="table"  width="100%" cellspacing="0">
            <?php if (isset($_COOKIE['noti-type'])) { ?>
                <?php if ($_COOKIE['noti-type']=='success') { ?>
                    <div class="alert alert-success">
                        <?= $_COOKIE['noti-message'] ?>
                    </div>
                <?php } ?>
                <?php if ($_COOKIE['noti-type']=='error') { ?>
                    <div class="alert alert-danger">
                        <?= $_COOKIE['noti-message'] ?>
                    </div>
                <?php } ?>
            <?php } ?>
        
            <form action="dashboard/user/add" method="POST" role="form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-12 col-sm-12 col-md-6">
                            <label for="">Họ</label>
                            <input type="text" class="form-control" id="" placeholder="" name="lastname">
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6">
                            <label for="">Tên</label>
                            <input type="text" class="form-control" id="" placeholder="" name="firstname">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-sm-12 col-md-6">
                            <label for="">Giới tính</label>
                            <select id="" name="gender" class="form-control">
                                    <option value="male">Nam</option>
                                    <option value="female">Nữ</option>
                                    <option value="others">Khác</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6">
                            <label for="">Số Điện Thoại</label>
                            <input type="text" class="form-control" id="" placeholder="" name="phone">
                        </div>
                    
                    </div>
                    <div class="form-group">
                        <label for="">Địa chỉ</label>
                        <input type="text" class="form-control" id="" placeholder="" name="address">
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-sm-12 col-md-6">
                            <label for="">Tài Khoản</label>
                            <input type="text" class="form-control" id="" placeholder="" name="username">
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6">
                            <label for="">Mật Khẩu</label>
                            <input type="Password" class="form-control" id="" placeholder="" name="password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-sm-12 col-md-6">
                            <label for="">Vai trò</label>
                            <select id="" name="auth_id" class="form-control">
                                <option value="<?= 1?>">Khách hàng</option>
                                <option value="<?= 2?>">Quản trị viên</option>
                                <option value="<?= 3?>">Nhân viên</option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-12 col-md-6">
                            <label for="">Email</label>
                            <input type="Email" class="form-control" id="" placeholder="" name="email">
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary float-right my-2">Tạo mới</button>
            </form>
        </div>
    </div>
</div>