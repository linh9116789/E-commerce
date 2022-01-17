<?php

$data = [
    'pageTitle' => 'Danh sách sản phẩm'
];
layout('header','admin', $data);
layout('sidebar','admin', $data);
layout('breadcrumb','admin', $data);
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th with="5%">STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá sản phẩm</th>
                    <th>Số lượng sản phẩm</th>
                    <th>Thể loại</th>
                    <th>Sản phẩm HOT</th>
                    <th with="5%">Sửa</th>
                    <th with="5%">Xóa</th>
                </tr>
                <tbody>
                <!-- <?php
                $i= 1;
                $query = getRaw("SELECT * FROM categories");
                if (is_array($query)):
                foreach($query as $value):
                ?> -->
                <tr>
                    <!-- <td><?php echo $i++; ?></td>
                    <td><?php echo $value['c_name'];?></td>
                    <td><?php echo $value['created_at'];?></td>
                    <td><?php echo $value['updated_at'];?></td>
                    <td><a href="?module=category&action=edit&id=<?php echo $value['id'];?>" class="btn btn-primary">Sửa</a></td>
                    <td><a href="?module=category&action=delete&id=<?php echo $value['id'];?>" class="btn btn-danger">Xóa</a></td> -->
                </tr>
                <!-- <?php endforeach; endif;?> -->
                </tbody>
            </thead>
        </table>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);