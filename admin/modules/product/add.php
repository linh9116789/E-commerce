<?php
if (!defined('_INCODE')) die('Access Deined...');
/**
 * File này chứa chức năng thêm sản phầm
 */

//Xử lý thêm sản phẩm
if (isPost()){
    $body = getBody();
    
    $errors=[];//Mảng lưu trữ các lỗi

    //Validate tên sản phẩm: Bắt buộc phải nhập
    if (empty(trim($body['name']))){
        $errors['name']['required'] = 'Không được bỏ trống';
    }

    //Validate tiêu đề sản phẩm: Bắt buộc phải nhập
    if(empty(trim($body['title']))){
        $errors['title']['required'] = 'Không được bỏ trống';
    }

    //Validate mô tả sản phẩm: Bắt buộc phải nhập
    if(empty(trim($body['description']))){
        $errors['description']['required'] = 'Không được bỏ trống';
    }

    //Upload image và validate image bắt buộc ảnh hoặc chỉ cho phép đuôi mở rộng png, jpg, jpeg
    $img = upload_image('thumbnail','admin');
    
    if ($img['code']==0){
        $errors['thumbnail']['required'] = 'Không được bỏ trống hoặc cho phép (png, jpg, jpeg)';
    }else{
        if ($img['code']==1){
            $img = $img['name'];
        }
    }

    if (empty($errors)){
        $name = $body['name'];
        $category_id = $body['category_id'];
        $title = $body['title'];
        $description = $body['description'];
        $price = $body['price'];
        $sale = $body['sale'];
        $qty = $body['quantily'];
        $slug = $body['slug'];
        $date = date('Y-m-d H:i:s');
        $dataInsert = [
            'name'=> $name,
            'category_id' => $category_id,
            'title' => $title,
            'description' => $description,
            'price' => $price,
            'sale' => $sale,
            'quantily' => $qty,
            'create_at' => $date,
            'thumbnail' => $img,
            'slug'=> $slug
        ];

        $insertStatus = insert('products', $dataInsert);
        
        if ($insertStatus){
            setFlashData('msg','Thêm sản phẩm thành công!');
            setFlashData('msg_type', 'success');
            redirect('?module=product&action=list');
        }else{
            setFlashData('msg', 'Lỗi hệ thống, bạn không thể thêm sản phẩm vào lúc này');
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
    'pageTitle' => 'Thêm mới sản phẩm'
];
layout('header','admin', $data);
layout('sidebar','admin', $data);
layout('breadcrumb','admin', $data);
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
    <?php getMsg($msg, $msgType); ?>
    <form action="" method="POST" enctype='multipart/form-data'>
        <div class="row">
            <div class="col-sm-12 col-md-7">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control" onkeyup="ChangeToSlug();" id="slug">
                    <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug sản phẩm</label>
                    <input type="text" name="slug" class="form-control" id="convert_slug">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">--Danh mục---</label>
                    <select name="category_id" class="form-control">
                        <?php 
                            $queryCategory = getRaw('SELECT id,c_name FROM categories');
                            if (is_array($queryCategory)):
                            foreach($queryCategory as $key):    
                        ?>
                        <option value="<?php echo $key['id']; ?>"><?php echo $key['c_name']; ?></option>
                        <?php endforeach; endif;?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Tiêu đề sản phẩm</label>
                    <input type="text" name="title" class="form-control">
                    <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>                           
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                    <textarea name="description" id="editor1" cols="30" rows="10"></textarea>
                    <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>                           
                
                </div>
            </div>

            <div class="col-sm-12 col-md-5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                    <input type="number" name="price" value="0" min='1' class="form-control">
                    <?php echo form_error('price', $errors, '<span class="error">', '</span>'); ?>                           
                                
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giảm giá</label>
                                <input type="number" name="sale" min='0' class="form-control" value="0">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="number" name="quantily" min='1' class="form-control" value="0">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-7">
                    <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/uploads/defaultimg.jpg?>" style="border: 1px solid #858796;"  id="blah" alt="" width="100%" height="300px">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Hình ảnh</label>
                    <input type="file" id="imgInp"  name="thumbnail" class="form-control">
                    <?php echo form_error('thumbnail', $errors, '<span class="error">', '</span>'); ?>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm dữ liệu</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);