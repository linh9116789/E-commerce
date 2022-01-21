<?php
if (!defined('_INCODE')) die('Access Deined...');
/**
 * File này chứa chức năng sửa sản phầm
 */

//Lấy id của sản phẩm
$idProduct = getBody()['id'];

if (!empty($idProduct)){
    $queryProduct = firstRaw("SELECT * FROM products WHERE id='$idProduct'");
    if (empty($queryProduct) && $queryProduct['id']!=$idProduct){
        setFlashData('msg', 'Đường dẫn hoặc sản phẩm không còn tồn tại');
        setFlashData('msg_type', 'danger');
        redirect('?module=product&action=list');
    }
    //Xử lý sửa sản phẩm
    if (isPost()){
        $body = getBody();
        $nameProduct='';
        $img = '';
        $mutipleImage='';
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

        //Upload image
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
            $date = date('Y-m-d H:i:s');

            $dataInsert = [
                'name'=> $name,
                'category_id' => $category_id,
                'title' => $title,
                'description' => $description,
                'price' => $price,
                'sale' => $sale,
                'quantily' => $qty,
                'update_at' => $date,
                'thumbnail' => $img
            ];

            $insertStatus = update('products', $dataInsert, "id=$productId");
            
            if ($insertStatus){
                setFlashData('msg','Sửa sản phẩm thành công!');
                setFlashData('msg_type', 'success');
                redirect('?module=product&action=list');
            }else{
                setFlashData('msg', 'Lỗi hệ thống, bạn không thể sửa sản phẩm vào lúc này');
                setFlashData('msg_type', 'danger');
            }

        }else{
            setFlashData('msg', 'Vui lòng kiểm tra dữ liệu nhập vào');
            setFlashData('msg_type', 'danger');
            setFlashData('errors', $errors);
        }


    }
}else{
    setFlashData('msg', 'Đường dẫn hoặc sản phẩm không còn tồn tại');
    setFlashData('msg_type', 'danger');
    redirect('?module=product&action=list');
}

$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
$errors = getFlashData('errors');

$data = [
    'pageTitle' => 'Sửa sản phẩm'
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
                <!-- form start -->
                    <?php getMsg($msg, $msgType); ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" name="name" class="form-control <?php if(!empty($errors['name'])){echo 'is-invalid';}?>" onkeyup="ChangeToSlug();" id="slug">
                                        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug sản phẩm</label>
                                        <input type="text" name="slug" class="form-control <?php if(!empty($errors['slug'])){echo 'is-invalid';}?>" id="convert_slug">
                                        <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">--Danh mục---</label>
                                        <select name="category_id" class="form-control <?php if(!empty($errors['category_id'])){echo 'is-invalid';}?> custom-select">
                                            <option selected="" disabled="">Chọn danh mục</option>
                                            <?php 
                                                $queryCategory = getRaw('SELECT id,c_name FROM categories');
                                                if (is_array($queryCategory)):
                                                foreach($queryCategory as $key):    
                                            ?>
                                            <option value="<?php echo $key['id']; ?>"><?php echo $key['c_name']; ?></option>
                                            <?php endforeach; endif;?>
                                        </select>
                                        <?php echo form_error('category_id', $errors, '<span class="error">', '</span>'); ?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tiêu đề sản phẩm</label>
                                        <input type="text" name="title" class="form-control <?php if(!empty($errors['title'])){echo 'is-invalid';}?>">
                                        <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>                           
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                                        <textarea name="description" id="editor1" cols="30" rows="10"></textarea>
                                        <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>                           
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá sản phẩm(VNĐ)</label>
                                        <input name="price" class="form-control <?php if(!empty($errors['price'])){echo 'is-invalid';}?> number-separator">
                                        <?php echo form_error('price', $errors, '<span class="error">', '</span>'); ?>                                   
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Giảm giá(%)</label>
                                                    <input type="number" name="sale" min='0' class="form-control" value="0">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Số lượng</label>
                                                    <input type="number" name="quantily" class="form-control" min='1' value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/uploads/defaultimg.jpg?>" style="border: 1px solid #858796; max-height:200px"  id="blah" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh đại diện</label>
                                        <input type="file" id="imgInp"  name="thumbnail" class="form-control <?php if(!empty($errors['price'])){echo 'is-invalid';}?>">
                                        <?php echo form_error('thumbnail', $errors, '<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="row" id="frames">
                                            <div class="col-sm-4">
                                                <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/uploads/defaultimg.jpg?>" style="border: 1px solid #858796;max-height:88px"   alt="">
                                            </div>
                                            <div class="col-sm-4">
                                                <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/uploads/defaultimg.jpg?>" style="border: 1px solid #858796;max-height:88px"   alt="">
                                            </div>
                                            <div class="col-sm-4">
                                                <img src="<?php echo _WEB_HOST_ADMIN_TEMPLATE ?>/assets/uploads/defaultimg.jpg?>" style="border: 1px solid #858796;max-height:88px"   alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh liên quan</label>
                                        <input type="file" id="image"  name="mutipleImage[]" class="form-control" multiple="multiple">
                                        <?php echo form_error('mutipleImage', $errors, '<span class="error">', '</span>'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm</i></button>
                        </div>
                    </form>
                </div> 
                <!-- /.card -->
            </div>
        </div>
        <!-- /.card -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);