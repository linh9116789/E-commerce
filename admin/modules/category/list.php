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
<?php getMsg($msg, $msgType); ?>
<section class="content">
    <div class="container-fluid">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th with="5%">STT</th>
                    <th>Tên danh mục</th>
                    <th>Thời gian tạo</th>
                    <th>Thời gian sửa</th>
                    <th with="5%">Sửa</th>
                    <th with="5%">Xóa</th>
                </tr>
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
                    <td><?php echo $value['created_at'];?></td>
                    <td><?php echo $value['updated_at'];?></td>
                    <td><a href="?module=category&action=edit&id=<?php echo $value['id'];?>" class="btn btn-primary">Sửa</a></td>
                    <td><a href="?module=category&action=delete&id=<?php echo $value['id'];?>" onclick="return confirm('Bạn chắc chắn muốn xóa chứ?');" class="btn btn-danger">Xóa</a></td>
                </tr>
                <?php endforeach; endif;?>
                </tbody>
            </thead>
        </table>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);