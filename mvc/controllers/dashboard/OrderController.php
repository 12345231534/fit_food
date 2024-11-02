<?php
require_once "./mvc/core/redirect.php";
require_once "./mvc/helper/HelperFunctions.php";

class OrderController extends Controller{
    private $OrderModel;
    private $OrderDetailModel;
    public function __construct(){
        $this->OrderModel = $this->model('Order');
        $this->OrderDetailModel = $this->model('OrderDetail');
    }
    public function index(){
        $orderData = $this->OrderModel->getAllOrder("created_at ASC");

        $data = [
            'page'          => 'orders/index',
            'data'       => $orderData,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function detail(){
        $id = isset($_GET['id']) ? (int)$_GET['id'] : NULL;
        $order = $this->OrderModel->findOrder($id);
        $orderDetails = $this->OrderDetailModel->getOrderDetailOfOrder($id);
        $data = [
            'page'          => 'orders/detail',
            'order'       => $order,
            'orderDetails' => $orderDetails,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function create_slug($string) {
        $slug = preg_replace('/[^a-zA-Z0-9_\-]/', '', strtolower($string));
        return $slug;
    }

    function confirmOrder(){
        $id = $_GET['id'];
        $data = array(
            'id' => $_GET['id'],
            'status' => 1,
        );
        
        $res = $this->OrderModel->update($data);
         if ($res == true) {
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Duyệt đơn hàng thành công!";
                $_SESSION['alert_timer'] = true;
                $redirect = new redirect('dashboard/order');
                return;

        } else {
            setcookie('noti-type', 'error', time() + 2);
            setcookie('noti-message', 'Duyệt đơn hàng thất bại!', time() + 2);
            $redirect = new redirect('dashboard/order/detail/?id='.$id);

            return;
        }
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $image = "";
		    $target_dir = "./public/img/order/";  // thư mục chứa file upload

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
            $res = $this->OrderModel->addOrder( $data);
            if ($res === true) {
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Tạo mới danh mục thành công!";
                $_SESSION['alert_timer'] = true;
                $redirect = new redirect('dashboard/order');
                return;

            } else {
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Tạo danh mục không thành công!', time() + 2);
                return;
            }
            
        }

        $data = [
            'page'          => 'orders/add',
        ];
        $this->view('dashboard/dashboard-layout',$data);

    }
  
    public function delete()
    {   
        $id = $_GET['id'];
        $query = $this->OrderModel->deleteOrder($id);
        if($query){
            $_SESSION['alert_type'] = "success";
            $_SESSION['alert_message'] ="Xóa đơn hàng thành công!";
            $_SESSION['alert_timer'] = true;
            $redirect = new redirect('dashboard/order');
          
        }

    }


}

?>