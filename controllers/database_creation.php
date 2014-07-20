<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/5/14
 * Time: 8:17 AM
 */

$connectionDb = require_once('database_connection.php');

function createNewTable($categoryPackage, $tableName){

    if(mysqli_connect_errno()){
        echo 'failed to connect to database';
    }


    $sql="CREATE TABLE ".$tableName." (PID INT NOT NULL AUTO_INCREMENT, PRIMARY KEY(PID), TABLENAME varchar(200),";
    //GRAB EACH OF THE CATEGORIES FROM THE CATEGORY PACKAGE AND PUT THEM IN INSERT STATEMENT
    foreach($categoryPackage as $category){
            $sql.= $category.' varchar(200), ';
        }
    //REMOVE THE FINAL COMMA
    $sql = substr($sql, 0, -2);
    //CLOSE UP SHOP
    $sql.= ')';

    echo $sql;

    mysqli_query(initialConnection(), $sql);


};

function updateTable($newCategoryPackage, $tableName){

    if(mysqli_connect_errno()){
        echo 'failed to connect to database';
    }

    foreach($newCategoryPackage as $updates){
        $sql = "ALTER TABLE table5060 ADD ".$updates." VARCHAR(60);";
        mysqli_query(initialConnection(), $sql);
    }

};

function deleteTable($newCategoryPackage, $tableName){

    if(mysqli_connect_errno()){
        echo 'failed to connect to database';
    }

    foreach($newCategoryPackage as $updates){
        $sql = "ALTER TABLE table5060 DROP COLUMN ".$updates;
        mysqli_query(initialConnection(), $sql);
    }

};