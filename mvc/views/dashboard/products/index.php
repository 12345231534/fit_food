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
      <a href="dashboard/product/add" type="button" class="btn btn-primary">Thêm mới</a>
    <?php } ?>
    </div>
    <hr>
    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th scope="col">Mã sản phẩm</th>
          <th scope="col">Sản phẩm Giá trành</th>
          <th scope="col">Giá thành/1 đơn v</th>
          <th scope="col">Số lượng</th>
          <th scope="col">Trạng thái</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $row) { ?>
          <tr>
            <th scope="row"><?= $row['id'] ?></th>
            <td><?= $row['name'] ?></td>
            <td><?= $row['price'] ?> VNĐ</td>
            <td><?= $row['stock'] ?></td>
            <td><?= $row['status'] == 1 ? 'Hiển thị' : 'Ẩn'?></td>
            <td style="padding: 8px 20px;">
                <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
                <a href="dashboard/product/update/?id=<?= $row['id'] ?>" type="button" class="btn btn-warning">Sửa</a>
                  <?php if(isset($_SESSION['user']['id']) && $_SESSION['user']['id'] != $row['id']){ ?>
                    <a href="dashboard/product/delete/?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
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