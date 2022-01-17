<?php
if (!defined('_INCODE')) die('Access Deined...');
/**
 * File này chứa chức năng sửa danh mục 
 */
//Xử lý lấy id trên url danh mục 
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $queryCategory = firstRaw("SELECT c_name FROM categories WHERE id='$id'");
}

//Xử lý update 
if (isPost()){
    $body = getBody();
    if (!empty($body['c_name'])){
        $c_name = $body['c_name'];
        $date = date('Y-m-d H:i:s');
        $dataUpdate = [
            'c_name' => $c_name,
            'updated_at'=>$date
        ];

        $updateStatus = update('categories', $dataUpdate, 'id = '.$id.'');

        if ($updateStatus){
            redirect('?module=category&action=list');
        }
    }
}

$data = [
    'pageTitle' => 'Sửa danh mục'
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
                <label for="">Tên danh mục </label>
                <input type="text" class="form-control" name="c_name" value="<?php echo $queryCategory['c_name']; ?>" placeholder="Tên danh mục">
            </div>
            <button type="submit" class="btn btn-primary">Sửa</button>
        </form>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);