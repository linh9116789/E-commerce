<?php
if (!defined('_INCODE')) die('Access Deined...');
/**
 * File này chứa chức năng xóa sản phẩm
 */

 //Xử lý xóa sản phẩm
if (isGet()){
    $body = getBody();
    if (!empty(trim($body['id']))){
        $id = $body['id'];
        
        $queryProduct = delete('products','id = '.$id.'');
        if ($queryProduct){
            setFlashData('msg','Xóa sản phẩm thành công!');
            setFlashData('msg_type', 'success');
            redirect('?module=product&action=list');
        }
    }else {
        redirect('?module=product&action=list');
    }
}