<?php
require_once "./mvc/core/redirect.php";

class PromotionController extends Controller{
    private $PromotionModel;
    public function __construct(){
        $this->PromotionModel = $this->model('Promotion');

    }
    public function index(){
        $promotionData = $this->PromotionModel->getAllPromotion("created_at ASC");
        $data = [
            'page'          => 'promotions/index',
            'promotions'       => $promotionData,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function detail(){
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $promotion = $this->PromotionModel->findPromotion($id);
        $data = [
            'page'          => 'promotions/detail',
            'promotion'       => $promotion,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $NgayBD =  date('Y-m-d H:i:s');
            $data = array(
                'TenKM' => $_POST['name'],
                'LoaiKM' => $_POST['type'],
                'GiaTriKM' => $_POST['value'],
                'NgayBD' => $NgayBD,
                'TrangThai' => $_POST['status']
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $res = $this->PromotionModel->addPromotion( $data);
            if ($res === true) {
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Tạo mới khuyến mãi thành công!";
                $_SESSION['alert_timer'] = true;
                $redirect = new redirect('dashboard/promotion');
                return;

            } else {
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Tạo mới khuyến mãi thất bại', time() + 2);
            }
            
        }

        $data = [
            'page'          => 'promotions/add',
        ];
        $this->view('dashboard/dashboard-layout',$data);

    }
  
    public function delete()
    {   
        $id = $_GET['id'];
        $query = $this->PromotionModel->deletePromotion($id);
        if($query){
            $_SESSION['alert_type'] = "success";
            $_SESSION['alert_message'] ="Xóa khuyến mãi thành công!";
            $_SESSION['alert_timer'] = true;
            $redirect = new redirect('dashboard/promotion');
          
        }

    }

    public function update(){
        $id = $_GET['id'];
        $promotion = $this->PromotionModel->findPromotion($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $NgayBD =  date('Y-m-d H:i:s');
            $data = array(
                'TenKM' => $_POST['name'],
                'LoaiKM' => $_POST['type'],
                'GiaTriKM' => $_POST['value'],
                'NgayBD' => $NgayBD,
                'TrangThai' => $_POST['status']
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $isUpdated = $this->PromotionModel->updatePromotion($id, $data);
            if($isUpdated){
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Cập nhật khuyến mãi thành công!";
                $_SESSION['alert_timer'] = true;
                $data = $this->PromotionModel->findPromotion($id);
                $redirect = new redirect('dashboard/promotion/');
                return;
            }
            else{
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Câp nhật khuyến mãi thất bại', time() + 2);
                return;
            }
        }
        
        $data = [
            'page'          => 'promotions/update',
            'data' => $promotion,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
}

?>