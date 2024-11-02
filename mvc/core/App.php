<?php 
class App{
    protected $controller = "Home";
    protected $action = "index";
    protected $params = [];
    protected $Routes__;
    function __construct(){
        $arrayURL = $this->urlProcess();
        //Controller handle

        if ($arrayURL != NULL) {
            //Dashboard flow
            if($arrayURL[0] == 'dashboard'){
                if (isset($arrayURL[1])){
                    if(file_exists("./mvc/controllers/dashboard/".ucwords($arrayURL[1])."Controller.php")) {
                        $this->controller = ucwords($arrayURL[1])."Controller";
                        require_once "./mvc/controllers/dashboard/".ucwords($arrayURL[1])."Controller.php";
                        if (class_exists($this->controller)) {
                            unset($arrayURL[0]);
                            unset($arrayURL[1]);

                        }
                    }
                }
                else{
                    $this->controller = ucwords($arrayURL[0])."Controller";
                    require_once "./mvc/controllers/dashboard/".ucwords($arrayURL[0])."Controller.php";
                    if (class_exists($this->controller)) {
                        unset($arrayURL[0]);
                        unset($arrayURL[1]);
                    }
                
                }
                $this->controller = new $this->controller;
                 //Method handle
                if (isset($arrayURL[2])) { //Nếu tồn tại method thì gán
                    if (method_exists($this->controller,$arrayURL[2])) {
                        $this->action = $arrayURL[2];
                        unset($arrayURL[2]);
                    }
                }
                else{
                    if (method_exists($this->controller,'index')) {
                        $this->action = 'index';
                    }
                    else{
                        require_once "./mvc/views/client/error-404.php";
                        return;
                    }
                }
            }

            //Client flow
            else{
                if (file_exists("./mvc/controllers/".ucwords($arrayURL[0])."Controller.php")) {
                    $this->controller = ucwords($arrayURL[0])."Controller";
                    require_once "./mvc/controllers/".$this->controller.".php";
                    if (class_exists($this->controller)) {
                        unset($arrayURL[0]);
                    }
                }
                else{
                    $this->controller =  $this->controller."Controller";
                    require_once "./mvc/controllers/".$this->controller.".php";
                }
                $this->controller = new $this->controller;
                 //Method handle
                if (isset($arrayURL[1])) { //Nếu tồn tại method thì gán
                    if (method_exists($this->controller,$arrayURL[1])) {
                        $this->action = $arrayURL[1];
                        unset($arrayURL[1]);
                    }
                }
                else{
                    if (method_exists($this->controller,'index')) {
                        $this->action = 'index';
                    }
                    else{
                        require_once "./mvc/views/client/error-404.php";
                        return;
                    }
                }
            }
         
        }
        else{
            // require_once "./mvc/controllers/".$this->controller.".php";
            require_once "./mvc/views/client/error-404.php";
            return;
        }

     
        //Param handle
        $this->params = $arrayURL ? array_values($arrayURL) : [];
        call_user_func_array([$this->controller,$this->action],$this->params);
    }


    function getUrl(){
        if (isset($_SERVER['PATH_INFO'])) {
            $url = $_SERVER['PATH_INFO'];
        }
        else{
            $url = '/';
        }
        return $url;
    }

    function urlProcess(){
        // $this->Routes__ = new Routes();
        $initURL = $this->getUrl();
        // $returnUrl = $this->Routes__->handleUrl($initURL);

        return explode("/",filter_var(trim($initURL,"/")));
    }
}