 
<div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">
      Quản lý tài khoản người dùng
      </h6>
  </div>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-end"> 
      <h6 class="text-primary">Danh sách tài khoản người dùng</h6>
      <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
      <a href="dashboard/user/add" type="button" class="btn btn-primary">Thêm mới</a>
      <?php } ?>
    </div>
      
    <?php if (isset($_COOKIE['msg'])) { ?>
      <div class="alert alert-success">
        <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
      </div>
    <?php } ?>
    <hr>
    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Tài khoản</th>
          <th scope="col">Họ tên</th>
          <th scope="col">SDT</th>
          <th scope="col">Giới tính</th>
          <th scope="col">Quyền hạn</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php
    
        foreach ($users as $row) { ?>
          <tr>
            <th style="padding: 8px 20px;" scope="row"><?= $row['id'] ?></th>
            <td style="padding: 8px 20px;"><?= $row['username'] ?></td>
            <td style="padding: 8px 20px;"><?= $row['lastname']." ".$row['firstname'] ?></td>
            <td style="padding: 8px 20px;"><?= $row['phone'] ?></td>
            <td style="padding: 8px 20px;"><?php
              switch($row['gender']){
                case 'male':
                  echo 'Nam';
                  break;
                case 'female':
                  echo "Nữ";
                  break;
                default:
                  echo "Khác";
              }
            ?></td>
            <td style="padding: 8px 20px;">
              <?php
              if ($row['auth_id'] == 2) {
                echo 'Quản trị viên';
              } else {
                if ($row['auth_id'] == 1) {
                  echo 'Khách hàng';
                } else {
                  echo 'Nhân viên';
                }
              }
              ?>
            </td>
            <td style="padding: 8px 20px;">
              <a href="dashboard/user/detail/?id=<?= $row['id'] ?>" type="button" class="btn btn-info">Xem</a>
              <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
              <a href="dashboard/user/update/?id=<?= $row['id'] ?>" type="button" class="btn btn-warning">Sửa</a>
                <?php if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] != $row['id']){ ?>
                  <a href="dashboard/user/delete/?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
                <?php } ?>
            
              <?php }?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable();
      });
    </script>
  </div>
</div>