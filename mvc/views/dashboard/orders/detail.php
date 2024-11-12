        
<?php if(isset($order) and $order != null){ ?>

        
<div class="card shadow mb-4">
   
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
        Chi tiết
        </h6>
    </div>
    
    <div class="card-body">  
        <?php if (isset($_COOKIE['msg'])) { ?>
            <div class="alert alert-success">
                <strong>Thông báo</strong> <?= $_COOKIE['msg'] ?>
            </div>
        <?php } ?>
        <div class="d-flex justify-content-end align-items-center mb-3">
            <a href="dashboard/order/confirmOrder/?id=<?= $order['id'] ?>" class="btn btn-success mr-2">Duyệt hóa đơn</a>
            <a href="dashboard/order/delete/?id=<?= $order['id'] ?>" onclick="return confirm('Bạn có thật sự muốn xóa ?');" type="button" class="btn btn-danger">Xóa</a>
        <?php } ?>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Tổng Đơn</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Ngày nhận</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['recepient_name'] ?></td>
                    <td><?= $order['total_price'] ?> VNĐ</td>
                    <td><?= $order['phone'] ?></td>
                    <td><?= $order['address']  ?></td>
                    <td><?= $order['date_received'] ?></td>
                </tr>
        </table>

        
        <script>
            $(document).ready(function() {
                $('#dataTable').DataTable();
            });
        </script>
    </div>
</div>

<div class="card shadow mb-4">
   
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
        Thông tin đơn hàng
        </h6>
    </div>
    <div class="card-body">  
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Hình ảnh </th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Đơn giá/1 đơn vị</th>
                    <th scope="col">Tổng đơn</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($orderDetails as $row) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td>
                        <img src="public/<?= $row['image1'] ?>" class="object-fit-contain " style="width=100px; height=100px"  alt="">
                    </td>
                    <td><?= $row['quantity'] ?> </td>
                    <td><?= $row['price'] ?> VNĐ </td>
                    <td><?= $row['price']*$row['quantity']  ?> VNĐ</td>
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
