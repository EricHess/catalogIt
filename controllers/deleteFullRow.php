<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/21/14
 * Time: 8:03 AM
 */

require('mainIndex.php');

class deleteFullRow {
    public function deleteFullRow(){
        $newData = $_POST;

            $sql = "DELETE FROM table5062 WHERE ";
            foreach($newData as $key=>$datapoints){
            $sql .= $key;
            $sql .= '= ';
            $sql .= "'".$datapoints."'".' and ';
            }

        $sql = substr($sql, 0,-4);
        mysqli_query(mainIndex::indexConnection(), $sql);
        }
}

new deleteFullRow();