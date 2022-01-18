<?php
if (!defined('_INCODE')) die('Access Deined...');
/**
 * File này chứa chức năng thêm danh mục
 */

//Xử lý thêm danh mục
if (isPost()){
    $body = getBody();

    $errors = []; //Mảng lưu trữ các lỗi

    //Validate mật khẩu: Bắt buộc phải nhập, >=2 ký tự
    if (empty(trim($body['c_name']))){
        $errors['c_name']['required'] = 'Không được bỏ trống';
    }else{
        if (strlen(trim($body['c_name']))<2){
            $errors['c_name']['min'] = 'Không được nhỏ hơn 2 ký tự';
        }
    }
    
    if (empty($errors)){
        $c_name = $body['c_name'];
        $date = date('Y-m-d H:i:s');
        $dataInsert = [
            'c_name' => $c_name,
            'created_at'=>$date
        ];

        $insertStatus = insert('categories', $dataInsert);

        if ($insertStatus){
            setFlashData('msg','Thêm danh mục thành công!');
            setFlashData('msg_type', 'success');
            redirect('?module=category&action=list');
        }else{
            setFlashData('msg', 'Lỗi hệ thống, bạn không thể thêm danh mục vào lúc này');
            setFlashData('msg_type', 'danger');
        }
    }else{
        setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
        setFlashData('msg_type', 'danger');
        setFlashData('errors', $errors);
    }
}
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');
$data = [
    'pageTitle' => 'Thêm danh mục'
];
layout('header','admin', $data);
layout('sidebar','admin', $data);
layout('breadcrumb','admin', $data);
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <?php getMsg($msg, $msgType); ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text" class="form-control" name="c_name" id="" placeholder="Tên danh mục">
                <?php echo form_error('c_name', $errors, '<span class="error">', '</span>'); ?>
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);