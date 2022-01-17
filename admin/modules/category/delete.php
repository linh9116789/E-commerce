<?php
if (!defined('_INCODE')) die('Access Deined...');
/**
 * File này chứa chức năng xóa danh mục 
 */

 //Xử lý xóa danh mục 
if (isGet()){
    $body = getBody();
    if (!empty(trim($body['id']))){
        $id = $body['id'];
        
        $query = delete('categories','id = '.$id.'');
        if ($query){
            redirect('?module=category&action=list');
        }
    }else {
        redirect('?module=category&action=list');
    }
}