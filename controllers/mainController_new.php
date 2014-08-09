<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/3/14
 * Time: 11:49 AM
 */

require_once('database_connection.php');
require_once('database_creation.php');
session_start();
class mainController{

function createNewUI($paramCount, $categoryPackage){

    $sqlStatement = 'SELECT * from '.$_SESSION['table_name'];
    $result = mysqli_query(initialConnection(), $sqlStatement);
    $result = mysqli_fetch_all($result);

    echo '<div class="clr"></div>';
    echo '<form class="informationForm" method="post">';
    foreach($result as $newRow){

        echo '<div class="categoryInfoContainer lft">';
        $i = 0;
        $v = 1;

        while ($i < $paramCount){

            foreach($categoryPackage as $param){
                    echo '<input type="text" value="'.$newRow[$v].'" class="categoryInfo"  name="'.$param.'" />';
                    $i++;
                    $v++;

                };
            }
        echo '</div><span class="deleteInfoRow">X</span><div class="clr"></div>';

    }

    echo '<input type="submit" value="Save" >';
    echo '</form>';
    echo '<div class="newCategoryInfoRow">Add A New Item</div>';



}


function getTableName(){
    global $tableName;
    return $tableName;
}

}