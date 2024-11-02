<?php 
class Routes{
    var $array = [];
    function handleUrl($url){//input ex: /dashboard/home/  (initURL);
        
       global $Routes;
       $returnUrl = ltrim($url,'/'); // Loại bỏ dấu '/' ở đầu chuỗi url
     
       if (isset($Routes)){
            $folder = $this->readFolder('mvc/controllers');
       
            $strpos = $this->checkUrl($returnUrl); //Kiểm tra nếu trả về giá trị > 0 thì 
    
            foreach($Routes as $key => $val){
                $paramer = explode('/',$val); //Tách các thành phần của route value thành mảng dựa trên dấu '/'
                $urlArray = explode('/', ltrim($url,'/')); // Tách các thành phần của url thành mảng dựa trên dấu '/' và loại bỏ dấu '/' ở đầu
                $explode_url_arr = explode('.',$returnUrl); // Tách chuỗi url và phần mở rộng (nếu có) thành mảng dựa trên dấu '.'
                if ($strpos === 0  && $url !== '/'  && !isset($explode_url_arr[1])) { // Kiểm tra xem url có khớp với route và không có phần mở rộng 

                    $regex = $this->convertRegex($key); // Gọi hàm convertRegex  chuyển đổi key của route thành biểu thức chính quy
                    if (!empty($regex)) {
                        if (preg_match($regex,$returnUrl)){ // Kiểm tra url có khớp với biểu thức chính quy trong $regex
                            unset($paramer[count($paramer) - 1]); // Xóa bỏ phần tử cuối của mảng $paramer (có thể là phần mở rộng của route value)
                            $explode_url = explode('/',$returnUrl); // Tách các thành phần của url thành mảng dựa trên dấu '/' 
                            $returnUrl = preg_replace('~'.$regex.'~is',$val, $explode_url[count($explode_url) - 1]);  // Sử dụng preg_replace để thay thế phần khớp trong url với giá trị của route value 
                            $strip = '';
                            foreach($paramer as $value){
                                $strip .= $value.'/'; // Nối các thành phần với dấu '/'
                            }
                            $ltrim = trim($strip,'/');  // Loại bỏ dấu '/' ở đầu và cuối chuỗi $strip
                            $strip = $strip.$returnUrl;
                            $returnUrl = $strip;
                        }
                    }
                   
                }
                else{
                    echo "hello";
                    if (preg_match('~'.$key.'~is',$url)){
                        $returnUrl = preg_replace('~'.$key.'~is',$url,$val);
                    }
                }
            }
       }
        
       return $returnUrl;
    }
    function checkUrl($url){
        //Input example: $url: dashboard/home
        
        $trim = ltrim($url,'/');
        $countArray = explode('/',$trim); //output: Array([0]=>dashboard, [1] => home, [2] => ) (1)
     
        $counts = 0;
        $urlString = '';
        
        // foreach($folder as $key => $value){ //Lặp qua tất cả đường dẫn file trong folder controller
            foreach($countArray as $val){ //Lặp qua value của mảng $countArray ở mục (1)
        
                $urlString .= $val.'/';  
                
                $filecheck = trim($urlString,'/');
                   
                if (file_exists('mvc/controllers/'.$filecheck.'.php')){
                    $counts = 1;
                    break;
                }
            }
        // }
     
        return $counts;
    }
    function convertRegex($string){
        $string_return = '';
        if (preg_match('(:any)', $string)) {
            return '/([A-Za-z0-9]+)/';
        }
        else if(preg_match('(:num)', $string)){
            return  '/^[0-9]+$/i';
        }
    }
    function readFolder($folder_ = NULL){
        if (is_dir($folder_)) {
            $folder = glob($folder_.'/*');
            foreach($folder as $value){
                if (is_dir($value)) {
                    $this->readFolder($value);
                }
                else
                {
                   array_push($this->array, explode('.',$value)[0]);
                }
            }
        }
        return $this->array;
    }
}