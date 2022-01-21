<?php

/**
 * File này chứa chức năng liệt kê danh sách danh mục
 */

//Xử lý danh sách sản phẩm và phân trang
$totalRecodsCategory = countAll("SELECT COUNT(*) FROM categories");

$categoryTotalPage = ceil($totalRecodsCategory / _PER_PAGE);

$page = isset(getBody()['page'])&&is_numeric(getBody()['page']) ? (int)getBody()['page'] : 1;

//Kiểm tra nếu như số page mà lớn hơn số page trong data thì sẽ là page lớn nhất
//Còn if như page mà <0 thì thì sẽ là page đầu
if ($page > $categoryTotalPage){
    $page = $categoryTotalPage;
}else{
    if ($page < 0){
        $page = 1; 
    }
}
$offSet = ($page - 1) * _PER_PAGE;
$categoryQuery = getRaw("SELECT * FROM categories ORDER BY 'id' ASC LIMIT "._PER_PAGE." OFFSET $offSet ");

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
                            <?php if ($page > 1):?>
                            <li class="page-item"><a class="page-link" href="?module=category&action=list&page=<?php echo ($page - 1); ?>">«</a></li>
                            <?php endif;?>
                            <li class="page-item page-link"><?php echo $page; ?></li>
                            <?php if ($page * _PER_PAGE < $totalRecodsCategory):?>
                            <li class="page-item"><a class="page-link" href="?module=category&action=list&page=<?php echo ($page + 1); ?>">»</a></li>
                            <?php endif;?>
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