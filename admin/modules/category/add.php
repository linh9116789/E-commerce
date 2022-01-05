<?php
$data = [
    'pageTitle' => 'Thêm danh mục sản phẩm'
];
layout('header','admin', $data);
layout('sidebar','admin', $data);
layout('breadcrumb','admin', $data);
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="" method="post">
            <div class="form-group">
                <label for="">Tên danh mục sản phẩm</label>
                <input type="text" class="form-control" name="title" id="" placeholder="Tên danh mục sản phẩm">
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);