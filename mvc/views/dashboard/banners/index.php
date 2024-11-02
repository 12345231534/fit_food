<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
    Quản lý Banner
    </h6>
  </div>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-end"> 
      <h6 class="text-primary">Danh sách Banner</h6>
      <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
      <a href="dashboard/banner/add" type="button" class="btn btn-primary">Thêm mới</a>
    <?php } ?>
    </div>
    <hr>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Hình Ảnh</th>
          <th scope="col">#</th>
        </tr>
      </thead>
      <tbody>
        <?php  foreach ($banners as $row) { ?>
          <tr>
            
            <td><?= $row['id'] ?></td>
            <td><?= $row['image'] ?></td>
            <td>
              <a href="dashboard/banner/detail/?id=<?= $row['id'] ?>" class="btn btn-success">Xem</a>
                  <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
                  <a href="dashboard/banner/update/?id=<?= $row['id'] ?>" class="btn btn-warning">Sửa</a>
                  <a href="dashboard/banner/delete/?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
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