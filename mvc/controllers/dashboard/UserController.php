<?php
require_once "./mvc/core/redirect.php";

class UserController extends Controller{
    private $UserModel;
    public function __construct(){
        $this->UserModel = $this->model('User');

    }
    public function index(){
        $userData = $this->UserModel->getAllUser("created_at ASC");
        $data = [
            'page'          => 'users/index',
            'users'       => $userData,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function detail(){
        $id = isset($_GET['id']) ? $_GET['id'] : 1;
        $user = $this->UserModel->findUser($id);
        $data = [
            'page'          => 'users/detail',
            'user'       => $user,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $check1 = 0;
            $data_check = $this->UserModel->getAllUser();
            foreach ($data_check as $value) {
                if ( $value['username'] == $_POST['username']) {
                    $check1 = 1;
                }
            }
            $data = array(
                'lastname' =>    $_POST['lastname'],
                'firstname'  =>   $_POST['firstname'],
                'gender' => $_POST['gender'],
                'phone' => $_POST['phone'],
                'email' =>    $_POST['email'],
                'address'  =>   $_POST['address'],
                'username' => $_POST['username'],
                'password' => md5($_POST['password']),
                'auth_id' => $_POST['auth_id'] ,
                'status'  =>  1
            );
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            if ($check1 == 0) {
                $res = $this->UserModel->addUser( $data);
                if ($res === true) {
                    $_SESSION['alert_type'] = "success";
                    $_SESSION['alert_message'] ="Tạo mới tài khoản thành công!";
                    $_SESSION['alert_timer'] = true;
                    setcookie('noti-message', 'Đăng ký thành công, Vui lòng đăng nhập lại!', time() + 2);
                    setcookie('noti-type', 'success', time() + 2);
                    $redirect = new redirect('dashboard/user');
                    return;

                } else {
                    setcookie('noti-type', 'error', time() + 2);
                    setcookie('noti-message', 'Tạo tài khoản không thành công!', time() + 2);
                }
            } else {
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Tài khoản đã tồn tại, Vui lòng nhập lại!', time() + 2);
            }
        }

        $data = [
            'page'          => 'users/add',
        ];
        $this->view('dashboard/dashboard-layout',$data);

    }
  
    public function delete()
    {   
        $id = $_GET['id'];
        $query = $this->UserModel->deleteUser($id);
        if($query){
            $_SESSION['alert_type'] = "success";
            $_SESSION['alert_message'] ="Xóa tài khoản thành công!";
            $_SESSION['alert_timer'] = true;
            print_r($_SESSION['alert_type']);
            $redirect = new redirect('dashboard/user');
          
        }

    }

    public function update(){
        $id = $_GET['id'];
        $user = $this->UserModel->findUser($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = array(
                'lastname' =>    $_POST['lastname'],
                'firstname'  =>   $_POST['firstname'],
                'gender' => $_POST['gender'],
                'phone' => $_POST['phone'],
                'email' =>    $_POST['email'],
                'address'  =>   $_POST['address'],
                'auth_id' =>  $_POST['auth_id'],
            );
            print_r($data);
            foreach ($data as $key => $value) {
                if (strpos($value, "'") != false) {
                    $value = str_replace("'", "\'", $value);
                    $data[$key] = $value;
                }
            }
            $isUpdated = $this->UserModel->updateUser($id, $data);
            if($isUpdated){
                $_SESSION['alert_type'] = "success";
                $_SESSION['alert_message'] ="Cập nhậttài khoản thành công!";
                $_SESSION['alert_timer'] = true;
                setcookie('noti-message', 'Cập nhật tài khoản thành công!', time() + 2);
                setcookie('noti-type', 'success', time() + 2);
                $data = $this->UserModel->findUser($id);
                $redirect = new redirect('dashboard/user/update?id='.$id);
                return;
            }
            else{
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Câp nhật tài khoản không thành công!', time() + 2);
                return;
            }
        }
        
        $data = [
            'page'          => 'users/update',
            'data' => $user,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
}

?>