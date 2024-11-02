<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
    Quản lý khuyến mãi
    </h6>
  </div>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-end"> 
      <h6 class="text-primary">Danh sách khuyến mãi</h6>
      <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
      <a href="dashboard/promotion/add" type="button" class="btn btn-primary">Thêm mới</a>
    <?php } ?>
    </div>
    <hr>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th scope="col">Mã khuyến mãi</th>
          <th scope="col">Tên khuyến mãi</th>
          <th scope="col">Loại khuyến mãi</th>
          <th scope="col">Giá trị khuyến mãi</th>
          <th scope="col">Ngày bắt đầu</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($promotions as $row) { ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['value'] ?></td>
            <td><?= $row['start_day'] ?></td>
            <td>
              <a href="dashboard/promotion/detail/?id=<?= $row['id'] ?>" class="btn btn-success">Xem</a>
              <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
              <a href="dashboard/promotion/update/?id=<?= $row['id'] ?>" class="btn btn-warning">Sửa</a>
              <a href="dashboard/promotion/delete/?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
              <?php }?>
            </td>
          </tr>
        <?php } ?>
    </table>
    <script>
      $(document).ready(function() {
        $('#dataTable').DataTable();
      });
    </script>
  </div>
</div>