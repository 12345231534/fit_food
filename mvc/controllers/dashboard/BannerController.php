<?php
require_once "./mvc/core/redirect.php";

class BannerController extends Controller{
    private $BannerModel;
    public function __construct(){
        $this->BannerModel = $this->model('Banner');

    }
    public function index(){
        $bannerData = $this->BannerModel->getAllBanner("created_at ASC");
        $data = [
            'page'          => 'banners/index',
            'banners'       => $bannerData,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function detail(){
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $banner = $this->BannerModel->findBanner($id);
        $data = [
            'page'          => 'banners/detail',
            'banner'       => $banner,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $target_dir = "./public/img/banners/";  // thư mục chứa file upload
            $image = "";

            $target_file = $target_dir . basename($_FILES["image"]["name"]); // link sẽ upload file lên

            $status_upload = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

            if ($status_upload) { // nếu upload file không có lỗi 
                $image =  "img/banners/" . basename($_FILES["image"]["name"]);
            }
            $data = array(
                'image' => $image
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $res = $this->BannerModel->addBanner( $data);
            if ($res === true) {
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Tạo mới banner thành công!";
                $_SESSION['alert_timer'] = true;
                $redirect = new redirect('dashboard/banner');
                return;

            } else {
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Tạo banner thất bại!', time() + 2);
            }
         
        }

        $data = [
            'page'          => 'banners/add',
        ];
        $this->view('dashboard/dashboard-layout',$data);

    }
  
    public function delete()
    {   
        $id = $_GET['id'];
        $query = $this->BannerModel->deleteBanner($id);
        if($query){
            $_SESSION['alert_type'] = "success";
            $_SESSION['alert_message'] ="Xóa tài khoản thành công!";
            $_SESSION['alert_timer'] = true;
            print_r($_SESSION['alert_type']);
            $redirect = new redirect('dashboard/banner');
          
        }

    }

    public function update(){
        $id = $_GET['id'];
        $banner = $this->BannerModel->findBanner($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           if($_FILES["image"]['name'] != ""){
                $image = "";
                $target_dir = "./public/img/banner/";  // thư mục chứa file upload
                $target_file = $target_dir . basename($_FILES["image"]["name"]); // link sẽ upload file lên
                $status_upload = move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

                if ($status_upload) { // nếu upload file không có lỗi 
                    $image =  $target_file;
                }
                $data = array(
                    'image'  =>   $image,
                );
            }
            else{
                return;
            }
            $isUpdated = $this->BannerModel->updateBanner($id, $data);
            if($isUpdated){
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Cập nhật banner thành công!";
                $_SESSION['alert_timer'] = true;
                $redirect = new redirect('dashboard/banner/');
                return;
            }
            else{
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Câp nhật banner thất bại!', time() + 2);
                return;
            }
        }
        
        $data = [
            'page'          => 'banners/update',
            'data' => $banner,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
}

?>