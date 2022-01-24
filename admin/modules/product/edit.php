<?php
if (!defined('_INCODE')) die('Access Deined...');
/**
 * File này chứa chức năng sửa sản phầm
 */

//Xử lý lấy id trên url sản phẩm


$idProduct =  isset($_GET['id'])?(int)($_GET['id']):'';

if (!empty($idProduct)){
    $queryProduct = firstRaw("SELECT * FROM products WHERE id='$idProduct'");
    if(!empty($queryProduct) && $queryProduct['id'] == $idProduct){
        $nameProduct = $queryProduct['name'];
        $slugProduct = $queryProduct['slug'];
        $idCategory  = ($queryProduct['category_id']);
        $titleProduct= $queryProduct['title'];
        $descriptionProduct = $queryProduct['description'];
        $priceProduct =$queryProduct['price'];
        $saleProduct = $queryProduct['sale'];
        $qtyProduct =$queryProduct['quantily'];
        $thumbnailProduct = $queryProduct['thumbnail'];

    }else{
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

        //Validate giá sản phẩm: Bắt buộc phải nhập
        if(empty(trim($body['price']))){
            $errors['price']['required'] = 'Không được bỏ trống';
        }

        //Upload image kiểm tra xem ảnh có sửa đổi không nếu không lấy ảnh cũ còn ảnh mới thì check
        $img = upload_image('thumbnail','admin');
        
        if ($img==0){
            $errors['thumbnail']['required'] = 'PNG,...';
        }else{
            $img = $img['name'];
        }
        

        //Upload image mutiple và validate image bắt buộc ảnh hoặc chỉ cho phép đuôi mở rộng png, jpg, jpeg
        // $mutipleImage = upload_image_mutiple('mutipleImage','admin');
        // if (is_array($mutipleImage)){
        //     if (count($mutipleImage) > 4){
        //         $errors['mutipleImage']['min'] = 'Tối đa là 3 hình';
        //     }
        // }
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

            $insertStatus = update('products', $dataInsert, 'id = '.$idProduct.'');
            
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
                                        <input type="text" name="name" value="<?php echo $nameProduct; ?>" class="form-control <?php if(!empty($errors['name'])){echo 'is-invalid';}?>" onkeyup="ChangeToSlug();" id="slug">
                                        <?php echo form_error('name', $errors, '<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug sản phẩm</label>
                                        <input type="text" name="slug" value="<?php echo $slugProduct; ?>" class="form-control <?php if(!empty($errors['slug'])){echo 'is-invalid';}?>" id="convert_slug">
                                        <?php echo form_error('slug', $errors, '<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">--Danh mục---</label>
                                        <select name="category_id" class="form-control <?php if(!empty($errors['category_id'])){echo 'is-invalid';}?> custom-select">
                                            <option selected="" disabled="">Chọn danh mục</option>
                                            <?php 
                                                $queryCategory = getRaw("SELECT id,c_name FROM categories");
                                                if (is_array($queryCategory)):
                                                foreach($queryCategory as $value):    
                                            ?>
                                            <option <?php if($value['id'] == $idCategory ){echo "selected";} ?> value="<?php echo $value['id'] ?>"><?php echo $value['c_name'] ?></option>
                                            <?php endforeach; endif;?>
                                        </select>
                                        <?php echo form_error('category_id', $errors, '<span class="error">', '</span>'); ?>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tiêu đề sản phẩm</label>
                                        <input type="text" name="title" value="<?php echo $titleProduct; ?>" class="form-control <?php if(!empty($errors['title'])){echo 'is-invalid';}?>">
                                        <?php echo form_error('title', $errors, '<span class="error">', '</span>'); ?>                           
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                                        <textarea name="description" id="editor1" cols="30" rows="10"><?php echo $descriptionProduct; ?></textarea>
                                        <?php echo form_error('description', $errors, '<span class="error">', '</span>'); ?>                           
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Giá sản phẩm(VNĐ)</label>
                                        <input name="price" value="<?php echo number_format($priceProduct); ?>" class="form-control <?php if(!empty($errors['price'])){echo 'is-invalid';}?> number-separator">
                                        <?php echo form_error('price', $errors, '<span class="error">', '</span>'); ?>                                   
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Giảm giá(%)</label>
                                                    <input type="number" name="sale" min='0' class="form-control" value="<?php echo $saleProduct; ?>">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Số lượng</label>
                                                    <input type="number" name="quantily" class="form-control" min='1' value="<?php echo $qtyProduct; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <img src="<?php echo pare_url_file($thumbnailProduct,'admin');?>" style="border: 1px solid #858796; height:200px"  id="blah" alt="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh đại diện</label>
                                        <input type="file" id="imgInp"  name="thumbnail" class="form-control <?php if(!empty($errors['thumbnail'])){echo 'is-invalid';}?>">
                                        <?php echo form_error('thumbnail', $errors, '<span class="error">', '</span>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <div class="row" id="frames">
                                            <?php $queryImageProduct = getRaw("SELECT * FROM product_images WHERE product_id ='$idProduct'");
                                                if (is_array($queryImageProduct)):
                                                    foreach ($queryImageProduct as $item):
                                            ?>
                                            <div class="col-sm-4">
                                                <img src="<?php echo pare_url_file($item['image'],'admin'); ?>" style="max-height:88px;width:140px;margin-bottom:5px;border: 1px solid #858796;">
                                            </div>
                                            <?php endforeach; endif;?>
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