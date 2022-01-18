<?php

$data = [
    'pageTitle' => 'Danh sách sản phẩm'
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
    <?php getMsg($msg, $msgType); ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th with="5%">STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Avtar</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Thể loại</th>
                    <th>HOT</th>
                    <th with="5%">Sửa</th>
                    <th with="5%">Xóa</th>
                </tr>
                <tbody>
                <?php
                $i= 0;
                $productQuery = getRaw("SELECT * FROM products");
                if (is_array($productQuery)):
                foreach($productQuery as $value):
                    $category_id = $value['category_id'];
                    $productCategoryQuery = firstRaw("SELECT c_name FROM categories,products WHERE categories.id = '$category_id'");
                ?>
                <tr style="text-align: center;">
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $value['name'];?></td>
                    <td>
                        <img src="<?php echo pare_url_file($value['thumbnail'],'admin');?>" alt="" width="80px" height="80px">
                    </td>
                    <td><?php echo $value['price']?number_format($value['price']).'đ':'0đ';?></td>
                    <td><?php echo $value['quantily'];?></td>
                    <td><?php echo $productCategoryQuery['c_name'];?></td>
                    <td><?php echo $value['hot'];?></td>
                    <td><a href="?module=product&action=edit&id=<?php echo $value['id'];?>" class="btn btn-primary">Sửa</a></td>
                    <td><a href="?module=product&action=delete&id=<?php echo $value['id'];?>" onclick="return confirm('Bạn chắc chắn muốn xóa chứ?');" class="btn btn-danger">Xóa</a></td>
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