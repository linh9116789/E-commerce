<?php

if (isPost()){
   
}



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
    <form action="" method="POST" enctype='multipart/form-data'>
        <div class="row">
            <div class="col-sm-12 col-md-7">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                    <input type="text" name="name" class="form-control">
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
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mô tả sản phẩm</label>
                    <textarea name="description" id="editor1" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="col-sm-12 col-md-5">
                <div class="form-group">
                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                    <input type="text" name="price" value="0" class="form-control">
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giảm giá</label>
                                <input type="text" name="sale" min='1' class="form-control" value="0">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Số lượng</label>
                                <input type="text" name="quantily" min='1' class="form-control" value="0">
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