<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
       Cập nhật sản phẩm
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
            <form action="dashboard/product/update/?id=<?=$data['id']?>" method="POST" role="form" enctype="multipart/form-data">
           
                <div class="row">
                    <div class="form-group col-12 col-sm-12 col-md-6">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="" placeholder="" name="name" value="<?=$data['name']?>">
                    </div>
                    <div class="form-group col-12 col-sm-12 col-md-6">
                        <label for="">Số lượng</label>
                        <input type="text" class="form-control" id="" placeholder="" name="quantity" value="<?=$data['quantity']?>">
                    </div>
                </div>
                
                <div class="row mb-4">
                    <div class="form-group col-12 col-sm-12 col-md-6">
                        <label for="cars">Loại sản phẩm: </label>
                        <select id="" name="collection_id" class="form-control">
                            <?php foreach ($data_collection as $row) { ?>
                                <option <?= ($row['id'] == $data['collection_id'])?'selected':''?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-12 col-sm-12 col-md-6">
                        <label for="">Đơn giá</label>
                        <input type="text" class="form-control" id="" placeholder="" name="price" value="<?=$data['price']?>">
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="form-group col-12 col-sm-12 col-md-6">
                        <label for="">Hình ảnh 1</label>
                        <div class="my-2 <?= $data['image1']== '' ? 'd-none' : 'd-block'  ?>  img-1" style="width:200px; height: 200px ">
                            <img  src="./public/<?=$data['image1']?>" alt="" style="object-fit:contain; width:200px; height:200px"   class=" shadow-sm mb-3 ">
                        </div>
                        <input type="file" class="form-control " id="" placeholder="" name="image1" 
                        onchange="displayImg(this,$(this), '.img-1')" value="<?=$data['image1']?>">
                    </div>
                    <div class="form-group col-12 col-sm-12 col-md-6">
                        <label for="">Hình ảnh 2</label>
                        <div class="my-2  <?= $data['image2']== '' ? 'd-none' : 'd-block'  ?>  img-2" style="width:200px; height: 200px ">
                            <img  src="./public/<?=$data['image2']?>" alt="" style="object-fit:contain; width:200px; height:200px"   class=" shadow-sm mb-3 ">
                        </div>
                        <input type="file" class="form-control " id="" placeholder="" name="image2"  onchange="displayImg(this,$(this), '.img-2')" value="<?=$data['image2']?>">
                    </div>
               </div>
               
               <div class="row mb-3">
                   <div class="form-group col-12 col-sm-12 col-md-6">
                        <label  for="">Hình ảnh 3</label>
                        <div class="my-2 <?= $data['image1']== '' ? 'd-none' : 'd-block'  ?>  img-3" style="width:200px; height: 200px ">
                            <img  src="./public/<?=$data['image3']?>" alt="" style="object-fit:contain; width:200px; height:200px"   class=" shadow-sm mb-3 ">
                        </div>
                       
                        <input type="file" class="form-control" id="" placeholder="" name="image3"  onchange="displayImg(this,$(this), '.img-3')" value="<?=$data['image3']?>">
                   </div>
                        <div class="form-group col-12 col-sm-12 col-md-6">
                        <label for="">Hình ảnh 4</label>
                        <div class="my-2 <?= $data['image1']== '' ? 'd-none' : 'd-block'  ?>  img-4" style="width:200px; height: 200px ">
                            <img  src="./public/<?=$data['image1']?>"    alt="" style="object-fit:contain; width:200px; height:200px"   class=" shadow-sm mb-3 ">
                        </div>
                        <input type="file" class="form-control" id="" placeholder="" name="image4"  onchange="displayImg(this,$(this), '.img-4')" value="<?=$data['image4']?>">
                   </div>
               </div>
              
            
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea style="min-height: 200px" class="min-h- form-control" id="summernote" placeholder="" name="description"><?=$data['description']?></textarea>
                </div>
                

                <div class="form-group">
                    <label for="cars">Mã khuyến mãi </label>
                    <select id="" name="promotion_id" class="form-control">
                        <?php foreach ($data_promotion as $row) { ?>
                            <option <?= ($row['id'] == $data['promotion_id'])?'selected':''?> value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <input <?=($data['status']==1)?'checked':''?> type="checkbox" id="" placeholder="" value="1" name="status"><em>(Check cho phép hiện thị sản phẩm)</em>
                </div>
                <button type="submit" class="btn btn-primary float-right">Lưu cập nhật</button>
            </form>
            <script>
                $(document).ready(function() {
                    $('#summernote').summernote();
                });
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
        </table>
    </div>
</div>