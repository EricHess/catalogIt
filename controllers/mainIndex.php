<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/17/14
 * Time: 6:08 PM
 */

session_start();

class mainIndex {

    function indexConnection(){
        $connect = mysqli_connect('localhost','root','','catalog_it','3306');
        return $connect;
    }

    function createAccountTable(){
        $sql = 'CREATE TABLE users_table(PID int NOT NULL AUTO_INCREMENT PRIMARY KEY, tablename varchar(100), username varchar(35), password varchar (25), real_name varchar (125))';
        mysqli_query($this->indexConnection(), $sql);
    }



    function getKeyValues(){
        if($_SESSION){
            $sqlStatement = 'Describe `'.$_SESSION['table_name'].'`';
            $result = mysqli_query($this->indexConnection(), $sqlStatement);

            if($result){
                $columnArray = [];
                $values = mysqli_fetch_all($result);
                foreach($values as $columnNames){
                    array_push($columnArray, $columnNames[0]);
                }

                return $columnArray;

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
//TODO: ORGANIZE THIS!