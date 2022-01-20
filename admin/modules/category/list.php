<?php

$data = [
    'pageTitle' => 'Quản lý danh mục'
];
layout('header','admin', $data);
layout('sidebar','admin', $data);
layout('breadcrumb','admin', $data);
$msg = getFlashData('msg');
$msgType = getFlashData('msg_type');
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <?php getMsg($msg, $msgType); ?>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Tên danh mục</th>
                                    <th>slug danh mục</th>
                                    <th>Thời gian tạo</th>
                                    <th>Thời gian sửa</th>
                                    <th style="width: 11%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $i= 1;
                                    $categoryQuery = getRaw("SELECT * FROM categories");
                                    if (is_array($categoryQuery)):
                                    foreach($categoryQuery as $value):
                                ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $value['c_name'];?></td>
                                    <td><?php echo $value['slug'];?></td>
                                    <td><?php echo $value['created_at'];?></td>
                                    <td><?php echo $value['updated_at'];?></td>
                                    <td>
                                        <a href="?module=category&action=edit&id=<?php echo $value['id'];?>" class="btn btn-primary btn-sm">Sửa</a>
                                        <a href="?module=category&action=delete&id=<?php echo $value['id'];?>" onclick="return confirm('Bạn chắc chắn muốn xóa chứ?');" class="btn btn-danger btn-sm">Xóa</a>
                                    </td>
                                </tr>
                                <?php endforeach; endif;?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                        </ul>
                    </div>
                </div>
            <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);