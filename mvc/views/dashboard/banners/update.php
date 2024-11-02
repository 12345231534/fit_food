<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
        Cập nhật banner
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
            <form action="dashboard/banner/update/?id=<?=$data['id']?>" method="POST" role="form" enctype="multipart/form-data">
                <input type="hidden" name="id" disabled value="<?= $data['id'] ?>">
                <div class="form-group mb-4">
                    <label for="">Hình ảnh</label>
                    <div class="my-2 <?= $data['image']== '' ? 'd-none' : 'd-block'  ?>  banner-img" style="width:200px; height: 200px ">
                        <img  src="<?=$data['image']?>"    alt="" style="object-fit:contain; width:200px; height:200px"   class=" shadow-sm mb-3 ">
                    </div>
                    <input type="file" class="form-control" id="" placeholder="" name="image"  onchange="displayImg(this,$(this), '.banner-img')" value="<?=$data['image']?>">
                </div>
                <button type="submit" class="btn btn-primary float-right">Cập nhật</button>
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