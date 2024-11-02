<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
        Chi tiết
        </h6>
    </div>
    <div class="card-body">    
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <h4>ID: <?= $data['id'] ?></h4>
            <h4>Tên danh mục: <?= $data['name'] ?></h4>
            <h4>Slug: <?= $data['slug'] ?></h4>
            <h4>Hình ảnh: <img src="./public/img/collection/<?= $data['image'] ?>" height="100px"></h4>
            <h4>Mô tả: <?= $data['description'] ?></h4>
            <h4>Trạng thái <?= $data['description'] == 1 ? "Hiển thị" : "Ẩn" ?></h4>
            
        </table>
    </div>
</div>