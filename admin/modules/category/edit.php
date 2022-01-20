<?php
if (!defined('_INCODE')) die('Access Deined...');
/**
 * File này chứa chức năng sửa danh mục 
 */
//Xử lý lấy id trên url danh mục 
if (isset($_GET['id'])){
    $idCategory = $_GET['id'];
    $queryCategory = firstRaw("SELECT c_name FROM categories WHERE id='$idCategory'");
}

//Xử lý update 
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

    if (!empty($body['c_name'])){
        $c_name = $body['c_name'];
        $date = date('Y-m-d H:i:s');
        $dataUpdate = [
            'c_name' => $c_name,
            'updated_at'=>$date
        ];

        $updateStatus = update('categories', $dataUpdate, 'id = '.$idCategory.'');

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
    'pageTitle' => 'Sửa danh mục'
];
layout('header','admin', $data);
layout('sidebar','admin', $data);
layout('breadcrumb','admin', $data);
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-primary">
                <?php getMsg($msg, $msgType); ?>
                <!-- form start -->
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control <?php if(!empty($errors)){echo 'is-invalid';}?>" name="c_name" value="<?php echo $queryCategory['c_name'] ?>" placeholder="Tên danh mục">
                            <?php echo form_error('c_name', $errors, '<span class="error invalid-feedback">', '</span>'); ?>
                        </div>
                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);