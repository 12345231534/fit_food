
    
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
    Quản lý đơn hàng
    </h6>
  </div>
  <div class="card-body">
    <div class="d-flex justify-content-between align-items-end"> 
      <ul class="nav nav-tabs">
      <li class="nav-item">
        <a href="dashboard/order" href="#" tabindex="-1" aria-disabled="true">Tất cả</a>
      </li>
      <li class="nav-item">
        <a href="dashboard/order/status=1" type="button" class="nav-item">Đã duyệt</a>
      </li>
      <li class="nav-item">
        <a href="dashboard/order/status=0" type="button" class="nav-item">Chưa duyệt</a>
      </li>
    </ul>
      <?php if (isset($_SESSION['isLogin_Admin']) && $_SESSION['isLogin_Admin'] == true) { ?>
      <a href="dashboard/promotion/add" type="button" class="btn btn-primary">Thêm mới</a>
    <?php } ?>
    </div>
    
    <!-- <select id="" name="promotion_id" class="form-control">
      <option>
        <a href="dashboard/order" type="button" class="btn btn-primary">Chưa duyệt</a>
      </option>
      <option>
        <a href="dashboard/order/status=0" type="button" class="btn btn-primary">Chưa duyệt</a>
      </option>
      <option>
        <a href="dashboard/order/status=1" type="button" class="btn btn-primary">Đã duyệt</a>
      </option>
    </select> -->
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th scope="col">Mã đơn hàng</th>
          <th scope="col">Tên Khách Hàng</th>
          <th scope="col">Ngày đặt hàng</th>
          <th scope="col">Tổng tiền</th>
          <th scope="col">Địa chỉ</th>
          <th scope="col">SĐT</th>
          <th scope="col">Trạng thái</th>
          <th>#</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $row) { ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['recepient_name'] ?></td>
            <td><?= $row['date_received'] ?></td>
            <td><?= number_format($row['total_price']) ?>VNĐ</td>
            <td><?= $row['address'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?php if($row['status']==0){
                echo 'Chưa xét duyệt';
            }else{
                echo 'Đã xét duyệt';
            }
            ?></td>
            <td>
              <a href="dashboard/order/detail/?id=<?= $row['id'] ?>" class="btn btn-success" >Xem chi tiết</a>
              <a href="dashboard/order/delete/?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
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