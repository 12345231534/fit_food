<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
        Thêm mới danh mục
        </h6>
    </div>
    <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <form action="dashboard/collection/add" method="POST" role="form" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Tên danh mục</label>
                    <input type="text" class="form-control" id="" placeholder="" name="name" required>
                </div>
                <div class="form-group ">
                    <label for="">Hình ảnh </label>
                    <div class="d-none my-2 collection-img" style="width:200px; height: 200px ">
                        <img  src="" alt="" style="object-fit:contain; width:200px; height:200px"   class="mx-auto shadow-sm mb-3 ">
                    </div>
                    <input type="file" class="form-control " id="" placeholder=""  name="image" onchange="displayImg(this,$(this), '.collection-img')">
                </div>
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea type="text" class="form-control" id="" placeholder="" name="description"></textarea>
                </div>
                <div class="form-group d-flex align-items-center">
                    <label class="mr-3" for="">Trạng thái</label>
                    <input type="checkbox" class="mr-2" id="" placeholder="" value="1" name="status" >
                    <em>(Tích để cho phép hiện thị danh mục)</em>
                </div>
                <button type="submit" class="btn btn-primary float-right">Thêm mới</button>
                
        
            </form>
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
        </table>
    </div>
</div>
