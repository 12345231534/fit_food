<?php
require_once "./mvc/core/redirect.php";

class ProductController extends Controller{
    private $ProductModel;
    private $CollectionModel;
    private $PromotionModel;
    public function __construct(){
        $this->ProductModel = $this->model('Product');
        $this->CollectionModel = $this->model('Collection');
        $this->PromotionModel = $this->model('Promotion');
    }
    public function index(){
        $productData = $this->ProductModel->getAllProduct("created_at ASC");
        $data = [
            'page'          => 'products/index',
            'products'       => $productData,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function detail(){
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $product = $this->ProductModel->findProduct($id);
        $data = [
            'page'          => 'products/detail',
            'product'       => $product,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function add(){
        $data_collection = $this-> CollectionModel->getAllCollection();
        $data_promotion = $this-> PromotionModel->getAllPromotion();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $status = 0;
            if (isset($_POST['status'])) {
                $status = $_POST['status'];
            }
            $target_dir = "./public/img/products/";  // thư mục chứa file upload

            $image1 = "";
            $target_file = $target_dir . basename($_FILES["image1"]["name"]); // link sẽ upload file lên

            $status_upload = move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file);

            if ($status_upload) { // nếu upload file không có lỗi 
                $image1 =  "img/products/" . basename($_FILES["image1"]["name"]);
            }

            $image2 = "";
            $target_file = $target_dir . basename($_FILES["image2"]["name"]); // link sẽ upload file lên
            $status_upload = move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file);
            if ($status_upload) { // nếu upload file không có lỗi 
                $image2 =  "/img/products/" . basename($_FILES["image2"]["name"]);
            }

            $image3 = "";
            $target_file = $target_dir . basename($_FILES["image3"]["name"]); // link sẽ upload file lên
            $status_upload = move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file);
            if ($status_upload) { // nếu upload file không có lỗi 
                $image3 =  "/img/products/" . basename($_FILES["image3"]["name"]);
            }

            $image4 = "";
            $target_file = $target_dir . basename($_FILES["image4"]["name"]); // link sẽ upload file lên
            $status_upload = move_uploaded_file($_FILES["image4"]["tmp_name"], $target_file);
            if ($status_upload) { // nếu upload file không có lỗi 
                $image4 =  "/img/products/" . basename($_FILES["image4"]["name"]);
            }




            print_r($_POST);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = array(
                'name'  =>   $_POST['name'],
                'collection_id' => $_POST['collection_id'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity'],
                'image1' => $image1,
                'image2' => $image2,
                'image3' => $image3,
                'image4' => $image4,
                'promotion_id' =>  $_POST['promotion_id'],
                'status' => $status,
                'description' =>  $_POST['description'],
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $res = $this->ProductModel->addProduct( $data);
            if ($res === true) {
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Tạo mới sản phẩm thành công!";
                $_SESSION['alert_timer'] = true;
                setcookie('noti-message', 'Tạo mới sản phẩm thành công!', time() + 2);
                setcookie('noti-type', 'success', time() + 2);
                $redirect = new redirect('dashboard/product');
                return;

            } else {
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Tạo sản phẩm không thành công!', time() + 2);
            }
           
        }

        $data = [
            'page'          => 'products/add',
            'data_collection' => $data_collection,
            'data_promotion' => $data_promotion,
        ];
        $this->view('dashboard/dashboard-layout',$data);

    }
  
    public function delete()
    {   
        $id = $_GET['id'];
        $query = $this->ProductModel->deleteProduct($id);
        if($query){
            $_SESSION['alert_type'] = "success";
            $_SESSION['alert_message'] ="Xóa sản phẩm thành công!";
            $_SESSION['alert_timer'] = true;
            print_r($_SESSION['alert_type']);
            $redirect = new redirect('dashboard/product');
          
        }

    }

    public function update(){
        $id = $_GET['id'];
        $data_collection = $this-> CollectionModel->getAllCollection();
        $data_promotion = $this-> PromotionModel->getAllPromotion();
        $product = $this->ProductModel->findProduct($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            print_r($_POST);

            $target_dir = "./public/img/products/";  // thư mục chứa file upload
            $image1 = "";
            $target_file = $target_dir . basename($_FILES["image1"]["name"]); // link sẽ upload file lên
            $status_upload = move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file);
            if ($status_upload) { // nếu upload file không có lỗi 
                $image1 =  "img/products/" . basename($_FILES["image1"]["name"]);
            }

            $image2 = "";
            $target_file = $target_dir . basename($_FILES["image2"]["name"]); // link sẽ upload file lên
            $status_upload = move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file);
            if ($status_upload) { // nếu upload file không có lỗi 
                $image2 =  "/img/products/" . basename($_FILES["image2"]["name"]);
            }

            $image3 = "";
            $target_file = $target_dir . basename($_FILES["image3"]["name"]); // link sẽ upload file lên
            $status_upload = move_uploaded_file($_FILES["image3"]["tmp_name"], $target_file);
            if ($status_upload) { // nếu upload file không có lỗi 
                $image3 =  "/img/products/" . basename($_FILES["image3"]["name"]);
            }

            $image4 = "";
            $target_file = $target_dir . basename($_FILES["image4"]["name"]); // link sẽ upload file lên
            $status_upload = move_uploaded_file($_FILES["image4"]["tmp_name"], $target_file);
            if ($status_upload) { // nếu upload file không có lỗi 
                $image4 =  "/img/products/" . basename($_FILES["image4"]["name"]);
            }



            $status = 0;
            if (isset($_POST['status'])) {
                $status = $_POST['status'];
            }

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $data = array(
                'name'  =>   $_POST['name'],
                'collection_id' => $_POST['collection_id'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity'],
                'image1' => $image1,
                'image2' => $image2,
                'image3' => $image3,
                'image4' => $image4,
                'promotion_id' =>  $_POST['promotion_id'],
                'status' => $status,
                'description' =>  $_POST['description'],
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $res = $this->ProductModel->updateProduct($id, $data);
            if ($res === true) {
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Cập nhật sản phẩm thành công!";
                $_SESSION['alert_timer'] = true;
                setcookie('noti-message', 'Cập nhật sản phẩm thành công!', time() + 2);
                setcookie('noti-type', 'success', time() + 2);
                // $redirect = new redirect('dashboard/product');
                return;

            } else {
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Tạo sản phẩm không thành công!', time() + 2);
                return;

            }
           
        }
        
        $data = [
            'page'          => 'products/update',
            'data_collection' => $data_collection,
            'data_promotion' => $data_promotion,
            'data' => $product,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
}

?>