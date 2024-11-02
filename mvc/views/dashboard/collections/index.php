<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
    Quản lý sản phẩm
    </h6>
  </div>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-end"> 
      <h6 class="text-primary">Danh sách sản phẩm</h6>
      <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
      <a href="dashboard/collection/add" type="button" class="btn btn-primary">Thêm mới</a>
    <?php } ?>
    </div>
    <?php if (isset($_COOKIE['msg'])) { ?>
      <div class="alert alert-success">
        <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
      </div>
    <?php } ?>
    <hr>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Tên</th>
          <th scope="col">Slug</th>
          <th scope="col">Hình Ảnh</th>
          <th scope="col">Mô tả</th>
          <th scope="col">Trạng thái</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $row) { ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['slug'] ?></td>
            <td>
              <img src="<?= $row['image'] ?>" height="60px">
            </td>
            <td><?= $row['description'] ?></td>
            <td><?= $row['status'] == 1 ? 'Hiển thị' : 'Ẩn'?></td>
            <td>
              <a href="dashboard/collection/detail/?id=<?= $row['id'] ?>" class="btn btn-success">Xem</a>
              <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
              <a href="dashboard/collection/update/?id=<?= $row['id'] ?>" class="btn btn-warning">Sửa</a>
              <a href="dashboard/collection/delete/?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
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