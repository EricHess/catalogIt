<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/21/14
 * Time: 8:03 AM
 */

require('mainIndex.php');
class createEmptyRow {

    function createEmptyRows(){
        mysqli_query(mainIndex::indexConnection(), "INSERT INTO `".$_SESSION['table_name']."` () VALUES()");
    }

}

$newrow = new createEmptyRow();
$newrow->createEmptyRows();