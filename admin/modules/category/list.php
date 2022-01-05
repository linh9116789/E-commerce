<?php
$data = [
    'pageTitle' => 'Quản lý danh mục sản phẩm'
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
                    <th>Tên danh mục</th>
                    <th>Thời gian</th>
                    <th with="5%">Sửa</th>
                    <th with="5%">Xóa</th>
                </tr>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
                </tbody>
            </thead>
        </table>
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<?php
layout('footer','admin', $data);