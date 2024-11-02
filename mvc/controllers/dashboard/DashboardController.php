<?php
class DashboardController extends Controller{
    private $ProductModel;
    private $UserModel;
    private $OrderModel;
    private $CollectionModel;
    public function __construct(){
        $this->ProductModel  = $this->model('Product');
        $this->OrderModel = $this->model('Order');
        $this->UserModel = $this->model('User');
        $this->CollectionModel = $this->model('Collection');
    }
    
    function index(){
        $productsStatistic = $this->ProductModel->getProductsCount();
        $collectionsStatistic = $this -> CollectionModel -> getCollectionsCount();
        // $data_tksp2 = $this->login_model->tk_sanpham(2);
        // $data_tksp3 = $this->login_model->tk_sanpham(3);
        $uncompletedOrderStatistic = $this->OrderModel->getUncompletedOrdersCount();
        $m = date("m");
        $monthlyRevenueStatistic = $this->OrderModel->getMonthlyRevenue($m);
        $y = "20".date("y");
        $yearlyRevenueStatistic = $this->OrderModel->getYearlyRevenue($y);
        $userStatistic = $this->UserModel->getUsersCount(1);
        $employeeStatistic = $this->UserModel->getUsersCount(3);
      
        $data = [
            'page'          => 'home/index',
            'productsStatistic'       => $productsStatistic,
            'collectionsStatistic' => $collectionsStatistic,
            'uncompletedOrderStatistic' => $uncompletedOrderStatistic,
            'monthlyRevenueStatistic' => $monthlyRevenueStatistic,
            'yearlyRevenueStatistic' => $yearlyRevenueStatistic,
            'userStatistic' => $userStatistic,
            'employeeStatistic' => $employeeStatistic,
            // 'data_tksp2' => $data_tksp2,
            // 'data_tksp3' => $data_tksp3,

            // 'data_index'    => $data_index,
        ];
        $this->view('dashboard/dashboard-layout',$data);
    }
}