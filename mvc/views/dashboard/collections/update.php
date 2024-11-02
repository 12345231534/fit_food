<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
        Cập nhật danh mục
        </h6>
    </div>
    <div class="card-body">          
        <?php if (isset($_COOKIE['noti-type'])) { ?>
            <?php if ($_COOKIE['noti-type']=='success') { ?>
                <div class="alert alert-success">
                    <?= $_COOKIE['noti-message'] ?>
                </div>
            <?php } ?>
            <?php if ($_COOKIE['noti-type']=='error') { ?>
                <div class="alert alert-danger">
                    <?= $_COOKIE['noti-message'] ?>
                </div>
            <?php } ?>
        <?php } ?>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <form action="dashboard/collection/update/?id=<?=$data['id']?>" method="POST" role="form" enctype="multipart/form-data">
                <div class="form-group mb-4">
                    <label for="">ID</label>
                    <input type="text" disabled class="form-control" id="" placeholder="" name="id" value="<?=$data['id'] ?>">
                </div>
                <div class="form-group mb-4">
                    <label for="">Tên loại sản phẩm</label>
                    <input type="text" class="form-control" id="" placeholder="" name="name" value="<?=$data['name'] ?>">
                </div>
                <div class="form-group mb-4">
                    <label for="">Hình ảnh</label>
                    <div class="my-2 <?= $data['image']== '' ? 'd-none' : 'd-block'  ?>  collection-img" style="width:200px; height: 200px ">
                        <img  src="<?=$data['image']?>"    alt="" style="object-fit:contain; width:200px; height:200px"   class=" shadow-sm mb-3 ">
                    </div>
                    <input type="file" class="form-control" id="" placeholder="" name="image"  onchange="displayImg(this,$(this), '.collection-img')" value="<?=$data['image']?>">
                </div>
                <div class="form-group mb-4">
                    <label for="">Mô tả</label>
                    <input type="text" class="form-control" id="" placeholder="" name="description"  value="<?=$data['description'] ?>">
                </div>
                <div class="form-group mb-4 d-flex align-items-center">
                    <label class="mr-3" for="">Trạng thái</label>
                    <input <?=($data['status']==1)?'checked':''?> type="checkbox" id="" placeholder="" value="1" name="status" class="mr-2"><em>(Tích để cho phép hiện thị sản phẩm)</em>
                </div>
                
                <button type="submit" class="btn btn-primary">Cập nhật</button>
            </form>
        </table>
    </div>
     <script >
        function displayImg(input,_this, imageClass) {
            let imageBox = document.querySelector(imageClass)
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                let image = imageBox.getElementsByTagName('img')[0];
                imageBox.classList.add('d-block');
                image.setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</div>