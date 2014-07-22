<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/4/14
 * Time: 10:25 AM
 */

function initialConnection(){
    $connect = mysqli_connect('localhost','root','','catalog_it','3306');
    return $connect;
}

function getFullValues(){
    if(!$_COOKIE["table_name"]){
        setcookie("table_name",getTableName(), time()+1000000);
    }else{
        $tableNameCookie = $_COOKIE["table_name"];
    };

    $sqlStatement = 'SELECT * from table5060';
    $result = mysqli_query(initialConnection(), $sqlStatement);
    $fullValues = mysqli_fetch_assoc($result);

    return $fullValues;
}

//Kick off the process
initialConnection();
