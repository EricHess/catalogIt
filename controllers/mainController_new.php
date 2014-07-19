<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/3/14
 * Time: 11:49 AM
 */

require_once('database_connection.php');
require_once('database_creation.php');


$tableName = 'table'.rand(0,10000);


//FOR DEBUGGING
function allResults(){

};




function createNewUI($paramCount, $categoryPackage, $table){


    echo '<div class="clr"></div>';
    echo '<form class="informationForm" method="post">';
    echo '<div class="categoryInfoContainer">';
    $i = 0;

    echo '<input type="hidden" class="tableName" name="tableName" value="'.$table.'"/>';
    while ($i < $paramCount && $row = getFullValues()){
        foreach($categoryPackage as $param){
                echo '<input type="text" value="'.$row[''.$param.''].'" class="categoryInfo"  name="'.$param.'" />';
                $i++;
            };
        }

    echo '</div>';
    echo '<input type="submit" value="Save" >';
    echo '</form>';
    echo '<div class="newCategoryInfoRow">Add A New Item</div>';



};


function getTableName(){
    global $tableName;
    return $tableName;
}

