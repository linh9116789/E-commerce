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

    if (empty(trim($body['slug']))){
        $errors['slug']['required'] = 'Không được bỏ trống';
    }
    
    if (empty($errors)){
        $c_name = $body['c_name'];
        $slug = $body['slug'];
        $date = date('Y-m-d H:i:s');
        $dataInsert = [
            'c_name' => $c_name,
            'slug'=>$slug,
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
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <?php getMsg($msg, $msgType); ?>
                <!-- form start -->
                <form method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control <?php if(!empty($errors['c_name'])){echo 'is-invalid';}?>" name="c_name" placeholder="Tên danh mục" onkeyup="ChangeToSlug();" id="slug">
                            <?php echo form_error('c_name', $errors, '<span class="error invalid-feedback">', '</span>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug danh mục</label>
                            <input type="text" name="slug" class="form-control <?php if(!empty($errors['slug'])){echo 'is-invalid';}?>" id="convert_slug" placeholder="Slug danh mục">
                            <?php echo form_error('slug', $errors, '<span class="error invalid-feedback">', '</span>'); ?>
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