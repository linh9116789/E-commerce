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
        //return $_GET;
        /*
         * Đọc key của mảng $_GET
         *
         * */
        if (!empty($_GET)){
            foreach ($_GET as $key=>$value){
                $key = strip_tags($key);
                if (is_array($value)){
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $bodyArr[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }

            }
        }

    }

    if (isPost()){
        if (!empty($_POST)){
            foreach ($_POST as $key=>$value){
                $key = strip_tags($key);
                if (is_array($value)){
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS, FILTER_REQUIRE_ARRAY);
                }else{
                    $bodyArr[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    }

    return $bodyArr;
}

//Hàm print_r dữ liệu dạng mảng
function dd($data){
    echo '<pre>';
    echo print_r($data);
    echo '</pre>';
    die;
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

    if (getBody()['action'] == $module){
        return true;
    }
    return false;
}

//Hàm tạo thông báo
function getMsg($msg, $type='success'){
    if (!empty($msg)){
    echo '<div class="alert alert-'.$type.'">';
    echo $msg;
    echo '</div>';
    }
}

//Hàm thông báo lỗi
function form_error($fieldName, $errors, $beforeHtml='', $afterHtml=''){
    return (!empty($errors[$fieldName]))?$beforeHtml.reset($errors[$fieldName]).$afterHtml:null;
}

/** Hàm upload file
 * @param $file [tên file trùng tên input]
 * @param array $extend [ định dạng file có thể upload được]
 * @return array|int [ tham số trả về là 1 mảng - nếu lỗi trả về int ]
 */
function upload_image($file, $folder = '', array $extend = array())
{
    if (!empty($folder)){
        $folder = '/'.$folder;
    }

    $code = 1;
    // lấy đường dẫn ảnh
    $baseFilename = $_FILES[$file]['name'];

    // thông tin file 
    $info = new SplFileInfo($baseFilename);

    // lấy đuôi mở rộng của file
    //C1:
    $ext = strtolower($info->getExtension());
    //C2:
    // $ext = strtolower(pathinfo($info->getFilename(), PATHINFO_EXTENSION));

    // Kiểm tra định dạng đuôi
    if (!$extend){
        $extend = ['png', 'jpg', 'jpeg'];
    }

    if (!in_array($ext, $extend)){
        return $data['code'] = 0;
    }

    // Tên file mới
    $nameFile = trim(str_replace('.' . $ext, '', strtolower($info->getFilename())));
    $filename = date('Y-m-d__') . $nameFile . '.' . $ext;;

    // Thư mục gốc để uploads
    $path =  _WEB_PATH_TEMPLATE . $folder.'/' . 'uploads/' . date('Y/m/d/');
    
    if ($folder)
        $path = _WEB_PATH_TEMPLATE . $folder . '/' . 'uploads/' . date('Y/m/d/');

    if (!file_exists($path)){
        mkdir($path, 0777, true);
    }

    // Di chuyển file vào thư mục uploads
    move_uploaded_file($_FILES[$file]['tmp_name'], $path . $filename);

    $data = [
        'name'     => $filename,
        'code'     => $code,
        'path'     => $path,
        'path_img' => 'uploads/' . $filename
    ];

    return $data;
}


function upload_image_mutiple($file, $folder = '', array $extend = array())
{
    if (!empty($folder)){
        $folder = '/'.$folder;
    }
    $data=[];
    $code = 1;
    // lấy đường dẫn ảnh
    $baseFilename = $_FILES[$file]['name'];
    foreach ($baseFilename as $key => $item){
        // thông tin file 
        $info = new SplFileInfo($item);

        // lấy đuôi mở rộng của file
        //C1:
        $ext = strtolower($info->getExtension());
        //C2:
        // $ext = strtolower(pathinfo($info->getFilename(), PATHINFO_EXTENSION));

        // Kiểm tra định dạng đuôi
        if (!$extend){
            $extend = ['png', 'jpg', 'jpeg'];
        }

        if (!in_array($ext, $extend)){
            return $data['code'] = 0;
        }

        // Tên file mới
        $nameFile = trim(str_replace('.' . $ext, '', strtolower($info->getFilename())));
        $filename = date('Y-m-d__') . $nameFile . '.' . $ext;;

        // Thư mục gốc để uploads
        $path =  _WEB_PATH_TEMPLATE . $folder.'/' . 'uploads/' . date('Y/m/d/');
        
        if ($folder)
            $path = _WEB_PATH_TEMPLATE . $folder . '/' . 'uploads/' . date('Y/m/d/');

        if (!file_exists($path)){
            mkdir($path, 0777, true);
        }

        // Di chuyển file vào thư mục uploads
        move_uploaded_file($_FILES[$file]['tmp_name'][$key], $path . $filename);

        $data[] = [
            'name'     => $filename,
            'code'     => $code,
            'path'     => $path,
            'path_img' => 'uploads/' . $filename
        ];
    }
    return $data;
}


/**
 * @param $image [tên file trùng tên input]
 * @param array $extend [ định dạng file có thể upload được]
 * @return array|int [ tham số trả về là 1 mảng - nếu lỗi trả về int ]
 */
function pare_url_file($image, $folder = '')
{
    if (!empty($folder)){
        $folder = '/'.$folder;
    }
    if (!$image) {
        return '/ecommerce/templates' . $folder . '/assets/img/no-image.jpg';
    }
    $explode = explode('__', $image);

    if (isset($explode[0])) {
        $time = str_replace('_', '/', $explode[0]);
        return '/ecommerce/templates' . $folder . '/uploads' . '/' . date('Y/m/d', strtotime($time)) . '/' . $image;
    }
}