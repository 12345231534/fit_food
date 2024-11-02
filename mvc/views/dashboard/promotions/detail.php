<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<?php if(isset($promotion) and $promotion != null) { ?>
    <h2>Mã khuyến mãi: <?= $promotion['id'] ?></h2>
    <h2>Tên khuyến mãi: <?= $promotion['name'] ?></h2>
    <h2>Loại khuyến mãi: <?= $promotion['type'] ?></h2>
    <h2>Giá trị khuyến mãi: <?= $promotion['value'] ?></h2>
    <h2>Ngày bắt đầu: <?= $promotion['start_day'] ?></h2>
    <h2>Trạng thái: <?= $promotion['status'] == 1 ? "Hiển thị" : "Ẩn" ?></h2>
<?php } ?>
</table>