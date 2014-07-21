<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/17/14
 * Time: 6:08 PM
 */


class mainIndex {

    function indexConnection(){
        $connect = mysqli_connect('localhost','root','','catalog_it','3306');
        return $connect;
    }

    function getKeyValues(){
        if(!$_COOKIE["table_name"]){
            setcookie("table_name",getTableName(), time()+1000000);
        }else{
            $tableNameCookie = $_COOKIE["table_name"];
        };

        $sqlStatement = 'SELECT * from table5060';
        $result = mysqli_query(mainIndex::indexConnection(), $sqlStatement);
        $fullValues = mysqli_fetch_assoc($result);
        $keys = array_keys($fullValues);
        return $keys;
    }


    function getIndexValues()
    {
        $i=2;
        while ($i < count(mainIndex::getKeyValues()) && $row = mainIndex::getKeyValues()){
            echo '<input type="text" name="category_'.$i.'" value="'.$row[$i].'"/><span class="delete">X</span><br>';
            $i++;
        }
    }


};

class rowPage{



};

//GET COOKIES WORKING FOR TABLE NAME
//CHANGE VALUES IF THEY ARE CHANGED FOR ROWS NAMES (GET INDEX VALUE RETURN)
//ENABLE ADDING NEW ROWS IF NEW ONES ARE ADDED
//SAME FOR THE SECOND PAGE
//TODO: ORGANIZE THIS!