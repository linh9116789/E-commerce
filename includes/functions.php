<?php 
if (!defined('_INCODE')) die('Access Deined...');

function layout($layoutName='header',$dir='', $data=[]){
    if (!empty($dir)){
        $dir = '/'.$dir;
    }
    
    if (file_exists(_WEB_PATH_TEMPLATE.$dir.'/layouts/'.$layoutName.'.php')){
        require_once _WEB_PATH_TEMPLATE.$dir.'/layouts/'.$layoutName.'.php';
    }
}

//Kiểm tra phương thức POST
function isPost(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        return true;
    }
    return false;
}

//Kiểm tra phương thức GET
function isGet(){
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        return true;
    }
    return false;
}

//Lấy giá trị phương thức POST, GET
function getBody(){
    $bodyArr = [];
    if (isGet()){
        //Xử lý chuỗi trước khi hiển thị ra
        //return $_GET
        /**
         * Đọc key của mảng $_GET
         */
        if (!empty($_GET)){
            foreach($_GET as $key =>$value){
                $key = strip_tags($key);
                if (is_array($value)){
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }
    return $bodyArr;   
}

//Kiểm tra email
function isEmail($email){
    $checkEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    return $checkEmail;
}

//Hàm chuyển hướng 
function redirect($path='index.php')
{
    header("Location:$path");
    exit;
}

//Hàm active event click Sidebar
function activeMenuSidebar($module){
    if (getBody()['module'] == $module){
        return true;
    }
    return false;
}