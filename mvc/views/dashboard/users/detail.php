<table class="table " id="dataTable" width="100%" cellspacing="0">
    <div class="mb-3">
        <h3 class="d-inline" style="font-style: bold; color: #000">ID: </h3>
        <h3 class="d-inline"><?=$user['id']?></h3>
    </div>
     <div class="mb-3">
        <h3 class="d-inline" style="font-style: bold; color: #000">Họ: </h3>
        <h3 class="d-inline"><?=$user['lastname']?></h3>
    </div>
     <div class="mb-3">
        <h3 class="d-inline" style="font-style: bold; color: #000">Tên: </h3>
        <h3 class="d-inline"><?=$user['firstname']?></h3>
    </div>
     <div class="mb-3">
        <h3 class="d-inline" style="font-style: bold; color: #000">Email: </h3>
        <h3 class="d-inline"><?=$user['email']?></h3>
    </div>
     <div class="mb-3">
        <h3 class="d-inline" style="font-style: bold; color: #000">Số điện thoại: </h3>
        <h3 class="d-inline"><?=$user['phone']?></h3>
    </div>
     <div class="mb-3">
        <h3 class="d-inline" style="font-style: bold; color: #000">Địa chỉ: </h3>
        <h3 class="d-inline"><?=$user['address']?></h3>
    </div>
    <div class="mb-3">
        <h3 class="d-inline" style="font-style: bold; color: #000">Giới tính: </h3>
        <h3 class="d-inline"><?php
              switch($user['gender']){
                case 'male':
                  echo 'Nam';
                  break;
                case 'female':
                  echo "Nữ";
                  break;
                default:
                  echo "Khác";
              }
            ?></h3>
    </div>
    <div class="mb-3">
        <h3 class="d-inline" style="font-style: bold; color: #000">Vai trò: </h3>
        <h3 class="d-inline">
            <?php
              if ($user['auth_id'] == 2) {
                echo 'Quản trị viên';
              } else {
                if ($user['auth_id'] == 1) {
                  echo 'Khách hàng';
                } else {
                  echo 'Nhân viên';
                }
              }
            ?>
        </h3>
    </div>
    <div class="mb-3">
        <h3 class="d-inline" style="font-style: bold; color: #000">Trạng thái: </h3>
        <h3 class="d-inline"><?=$user['status']?></h3>
    </div>
</table>