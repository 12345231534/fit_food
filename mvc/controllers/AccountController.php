<?php
require_once "./mvc/core/redirect.php";

class AccountController extends Controller{
    private $UserModel;
    private $CollectionModel;
    public function __construct(){
        $this->CollectionModel = $this->model('Collection');
        $this->UserModel = $this->model('User');
    }
  
    function login(){
        $data_collection = $this->CollectionModel->getAllCollection();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'];
            $password = md5($_POST['password']);
            if (strpos($username, "'") != false) {
                $username = str_replace("'", "\'", $username);
            }
            $user = $this->UserModel->login($username, $password);
         
            if ($user !== NULL) {
                if($user['auth_id'] == 2){
                    $_SESSION['isLogin_Admin'] = true;
                    $_SESSION['user'] = $user;
                    $redirect = new redirect('dashboard/');

                    return;
                }else if($user['auth_id'] == 3){
                    $_SESSION['isLogin_Nhanvien'] = true;
                    $_SESSION['user'] = $user;
                    $redirect = new redirect('dashboard/');

                    return;
                }
                else{
                    $_SESSION['isLogin'] = true;
                    $_SESSION['user'] = $user;
                    $redirect = new redirect('/');

                    $this->view('client/masterlayout',[
                        'page'          => 'account/login',
                        'categories'     => $data_collection,
                        // 'data_index'    => $data_index,
                    ]);
                    return;
                }
            // print_r($_SESSION);
            } else {
                setcookie('noti-message', 'Tài khoản hoặc mật khẩu không chính xác', time() + 2);
                setcookie('noti-type', 'error', time() + 2);

                $redirect = new redirect('account/login');
            }
                        
        }
        $this->view('client/masterlayout',[
            'page'          => 'account/login',
            'data_collection'     => $data_collection,
            // 'data_index'    => $data_index,
        ]);
    }


    function register(){
        $data_collection = $this->CollectionModel->getAllCollection();
        $check1 = 0;
        $data_check = $this->UserModel->getAllUser();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            foreach ($data_check as $value) {
                if ( $value['username'] == $_POST['username']) {
                    $check1 = 1;
                }
            }

            $gender = 'Nam';
            if($_POST['gender'] !== 'Chọn giới tính'){
                $gender = $_POST['gender'];
            }
            $data = array(
                'lastname' =>    $_POST['lastname'],
                'firstname'  =>   $_POST['firstname'],
                'gender' => $gender,
                'phone' => $_POST['phone'],
                'email' =>    "",
                'address'  =>   $_POST['address'],
                'username' => $_POST['username'],
                'password' => md5($_POST['password']),
                'auth_id' =>  1,
                'status'  =>  1,
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
                    $_SESSION['alert_message'] ="Đăng ký tài khoản thành công thành công!";
                    $_SESSION['alert_timer'] = true;
                    $redirect = new redirect('account/login');
                    return;

                } else {
                    setcookie('noti-type', 'error', time() + 2);
                    setcookie('noti-message', 'Đăng ký không thành công!', time() + 2);
                }
            } 
            } else {
                setcookie('noti-type', 'error', time() + 2);
                setcookie('noti-message', 'Tài khoản đã tồn tại, Vui lòng nhập lại!', time() + 2);
            }
            // $redirect = new redirect('account/register');
        $this->view('client/masterlayout',[
        'page'          => 'account/register',
        'data_collection'     => $data_collection,

        ]);
    }
    function logout()
    {
          if(isset($_SESSION['isLogin_Admin'])){
            unset($_SESSION['isLogin_Admin']);
            unset($_SESSION['user']);
        }
        if(isset($_SESSION['isLogin_Nhanvien'])){
            unset($_SESSION['isLogin_Nhanvien']);
            unset($_SESSION['user']);
        }
        if(isset($_SESSION['isLogin'])){
            unset($_SESSION['isLogin']);
            unset($_SESSION['user']);
        }
        $redirect = new redirect('home');

    }
    function account()
    {
        // $data_danhmuc = $this->login_model->danhmuc();

        // $data_chitietDM = array();

        // for ($i = 1; $i <= count($data_danhmuc); $i++) {
        //     $data_chitietDM[$i] = $this->login_model->chitietdanhmuc($i);
        // }
        // $data = $this->login_model->account();

        // require_once('Views/index.php');
    }
    function update(){

        // if (isset($_POST['Ho'])) {
        //     $data = array(
        //         'Ho' =>    $_POST['Ho'],
        //         'Ten'  =>   $_POST['Ten'],
        //         'GioiTinh' => $_POST['GioiTinh'],
        //         'SDT' => $_POST['SĐT'],
        //         'Email' =>    $_POST['Email'],
        //         'DiaChi'  =>   $_POST['DiaChi'],
        //     );
        //     foreach ($data as $key => $value) {
        //         if (strpos($value, "'") != false) {
        //             $value = str_replace("'", "\'", $value);
        //             $data[$key] = $value;
        //         }
        //     }
        //     $this->login_model->update_account($data);
        // } else {
        //     if ($_POST['MatKhauMoi'] == $_POST['MatKhauXN']) {
        //         if (md5($_POST['MatKhau']) == $_SESSION['user']['MatKhau']) {
        //             $data = array(
        //                 'MatKhau' => md5($_POST['MatKhauMoi']),
        //             );
        //             $this->login_model->update_account($data);
        //         } else {
        //             setcookie('doimk', 'Mật khẩu không đúng', time() + 2);
        //         }
        //     } else {
        //         setcookie('doimk', 'Mật khẩu mới không trùng nhau', time() + 2);
        //     }
        // }
        // header('location: ?act=taikhoan&xuli=account#doitk');
    }
}
