<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/helper/HelperFunctions.php";

class CollectionController extends Controller{
    private $CollectionModel;
    public function __construct(){
        $this->CollectionModel = $this->model('Collection');
    }
    public function index(){
        $collectionData = $this->CollectionModel->getAllCollection("created_at ASC");
        $data = [
            'page'          => 'collections/index',
            'data'       => $collectionData,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function detail(){
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $collection = $this->CollectionModel->findCollection($id);
        $data = [
            'page'          => 'collections/detail',
            'data'       => $collection,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function create_slug($string) {
        $slug = preg_replace('/[^a-zA-Z0-9_\-]/', '', strtolower($string));
        return $slug;
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $image = "";
		    $target_dir = "./public/img/collection/";  // thư mục chứa file upload

            $target_file = $target_dir . basename($_FILES["image"]["name"]); // link sẽ upload file lên

            $status_upload = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            if ($status_upload) { // nếu upload file không có lỗi 
                $image =              $target_file = $target_dir . basename($_FILES["image"]["name"]); // link sẽ upload file lên

            }
            $status = 0;
            if(isset($_POST['status'])){
                $status = $_POST['status'];
            }
            $data = array(
                'name' =>    $_POST['name'],
                'image'  =>   $image,
                'slug' => HelperFunction::create_slug($_POST['name']),
                'description' => $_POST['description'],
                'status' => $status,
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $res = $this->CollectionModel->addCollection( $data);
            if ($res === true) {
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Tạo mới danh mục thành công!";
                $_SESSION['alert_timer'] = true;
                setcookie('noti-message', 'Đăng ký thành công, Vui lòng đăng nhập lại!', time() + 2);
                setcookie('noti-type', 'success', time() + 2);
                $redirect = new redirect('dashboard/collection');
                return;

            } else {
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Tạo danh mục không thành công!', time() + 2);
                return;
            }
            
        }

        $data = [
            'page'          => 'collections/add',
        ];
        $this->view('dashboard/dashboard-layout',$data);

    }
  
    public function delete()
    {   
        $id = $_GET['id'];
        $query = $this->CollectionModel->deleteCollection($id);
        if($query){
            $_SESSION['alert_type'] = "success";
            $_SESSION['alert_message'] ="Xóa tài khoản thành công!";
            $_SESSION['alert_timer'] = true;
            print_r($_SESSION['alert_type']);
            $redirect = new redirect('dashboard/collection');
          
        }

    }

    public function update(){
        $id = $_GET['id'];
        $collection = $this->CollectionModel->findCollection($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = array();
            $status = 0;
            if(isset($_POST['status'])){
                $status = $_POST['status'];
            }
            if($_FILES["image"]['name'] != ""){
                $image = "";
                $target_dir = "./public/img/collection/";  // thư mục chứa file upload
                $target_file = $target_dir . basename($_FILES["image"]["name"]); // link sẽ upload file lên
                $status_upload = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                if ($status_upload) { // nếu upload file không có lỗi 
                    $image =  $target_file;
                }
                $data = array(
                'name' =>    $_POST['name'],
                'image'  =>   $image,
                'slug' => HelperFunction::create_slug($_POST['name'])    ,
                'description' => $_POST['description'],
                'status' => $status,
                );
            }
            else{
                $data = array(
                'name' =>    $_POST['name'],
                'slug' => HelperFunction::create_slug($_POST['name'])    ,
                'description' => $_POST['description'],
                'status' => $status,
                );
            }
          
           
            $isUpdated = $this->CollectionModel->updateCollection($id, $data);
            if($isUpdated){
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Cập nhật danh mục thành công!";
                $_SESSION['alert_timer'] = true;
                setcookie('noti-message', 'Cập nhật danh mục thành công!', time() + 2);
                setcookie('noti-type', 'success', time() + 2);
                $data = $this->CollectionModel->findCollection($id);
                $redirect = new redirect('dashboard/collection');
                return;
            }
            else{
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Câp nhật danh mục không thành công!', time() + 2);
                return;
            }
        }
        
        $data = [
            'page'          => 'collections/update',
            'data' => $collection,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
}

?>