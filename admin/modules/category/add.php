<?php
if (!defined('_INCODE')) die('Access Deined...');
/**
 * File này chứa chức năng thêm danh mục
 */

//Xử lý thêm danh mục
if (isPost()){
    $body = getBody();
    if (!empty($body['c_name'])){
        $c_name = $body['c_name'];
        $date = date('Y-m-d H:i:s');
        $dataInsert = [
            'c_name' => $c_name,
            'created_at'=>$date
        ];

        $insertStatus = insert('categories', $dataInsert);

        if ($insertStatus){
            redirect('?module=category&action=list');
        }
    }else{
        echo "Không được để trống";
    }
}

$data = [
    'pageTitle' => 'Thêm danh mục'
];
layout('header','admin', $data);
layout('sidebar','admin', $data);
layout('breadcrumb','admin', $data);
?>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <form action="" method="POST">
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text" class="form-control" name="c_name" id="" placeholder="Tên danh mục">
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);