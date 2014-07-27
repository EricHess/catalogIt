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
//        if(!$_COOKIE["table_name"]){
//            setcookie("table_name",getTableName(), time()+1000000);
//        }else{
//            $tableNameCookie = $_COOKIE["table_name"];
//        };

        $sqlStatement = 'SELECT * FROM `table5062`';
        $result = mysqli_query(mainIndex::indexConnection(), $sqlStatement);

        if($result){
            $fullValues = mysqli_fetch_assoc($result);
            if($fullValues != null){
            $keys = array_keys($fullValues);
            return $keys;
            }else{echo 'no keys yet, create some!';}

        } elseif(!$result){
            $sqlStatement = 'CREATE TABLE table5062(PID int)';
            $result = mysqli_query(mainIndex::indexConnection(), $sqlStatement);
            $sqlStatement = 'ALTER TABLE `table5062` ADD PRIMARY KEY(`PID`)';
            $result = mysqli_query(mainIndex::indexConnection(), $sqlStatement);
            $sqlStatement = 'ALTER TABLE `table5062` CHANGE `PID` `PID` INT(11) NOT NULL AUTO_INCREMENT;';
            $result = mysqli_query(mainIndex::indexConnection(), $sqlStatement);

            $sqlStatement = 'SELECT * from `table5062`';
            $result = mysqli_query(mainIndex::indexConnection(), $sqlStatement);
            if($result){
                $fullValues = mysqli_fetch_all($result);

                if($fullValues != null){
                    $keys = array_keys($fullValues);
                    return $keys;
                }
            }

        }
    }


    function getIndexValues()
    {
        if(count(mainIndex::getKeyValues()>0)){
            $i=2;
            while ($i < count(mainIndex::getKeyValues()) && $row = mainIndex::getKeyValues()){
                echo '<input type="text" name="category_'.$i.'" value="'.$row[$i].'"/><span class="delete">X</span><br>';
                $i++;
            }
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