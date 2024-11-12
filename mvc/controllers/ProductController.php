<?php
class ProductController extends Controller{
    private $ProductModel;
    private $CollectionModel;
    public function __construct(){
        $this->ProductModel  = $this->model('Product');
        $this->CollectionModel = $this->model('Collection');
    }
    
    function index(){
        // $productDetail = $this-> ProductModel ->
         $data_collection = $this->CollectionModel->getAllCollection();
        $data_limit1 = $this->ProductModel->getProductsLimit(0,8);
        $data_limit2 = $this->ProductModel->getProductsLimit(8,16);
        $data_limit3 = $this->ProductModel->getProductsLimit(16,24);
        $data_limit4 = $this->ProductModel->getProductsLimit(24,32);
        $products = array($data_limit1,$data_limit2,$data_limit3,$data_limit4);
        $title = "Product detail";

        $data = [
            'page'          => 'product/index',
            'title' => $title,
            'product'       => $products,
            'data_collection'     => $data_collection,
            // 'data_index'    => $data_index,
        ];
       $this->view('client/masterlayout',$data);
    }
}