<?php
if (!defined('_INCODE')) die('Access Deined...');

function query($sql, $data=[], $statementStatus=false){
    global $conn;
    $query = false;
    try{
        $statement = $conn->prepare($sql);

        if (empty($data)){
            $query = $statement->execute();
        }else{
            $query = $statement->execute($data);
        }

    }catch (Exception $exception){

        require_once '../modules/errors/database.php'; //Import error
        die(); //Dừng hết chương trình
    }

    if ($statementStatus && $query){
        return $statement;
    }

    return $query;
}

function insert($table, $dataInsert){

    $keyArr = array_keys($dataInsert);
    $fieldStr = implode(', ', $keyArr);
    $valueStr = ':'.implode(', :', $keyArr);

    $sql = 'INSERT INTO '.$table.'('.$fieldStr.') VALUES('.$valueStr.')';

    return query($sql, $dataInsert);
}

function update($table, $dataUpdate, $condition=''){

    $updateStr = '';
    foreach ($dataUpdate as $key=>$value){
        $updateStr.=$key.'=:'.$key.', ';
    }

    $updateStr = rtrim($updateStr, ', ');

    if (!empty($condition)){
        $sql = 'UPDATE '.$table.' SET '.$updateStr.' WHERE '.$condition;
    }else{
        $sql = 'UPDATE '.$table.' SET '.$updateStr;
    }

    return query($sql, $dataUpdate);
}

function delete($table, $condition=''){
    if (!empty($condition)){
        $sql = "DELETE FROM $table WHERE $condition";
    }elsE{
        $sql = "DELETE FROM $table";
    }

    return query($sql);
}

//Lấy dữ liệu từ câu lệnh SQL - Lấy tất cả
function getRaw($sql){
    $statement = query($sql, [], true);
    if (is_object($statement)){
        $dataFetch = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $dataFetch;
    }
    
    return false;
}

//Lấy dữ liệu từ câu lệnh SQL - Lấy 1 bản ghi
function firstRaw($sql){
    $statement = query($sql, [], true);
    if (is_object($statement)){
        $dataFetch = $statement->fetch(PDO::FETCH_ASSOC);
        return $dataFetch;
    }

    return false;
}