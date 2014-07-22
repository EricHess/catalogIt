<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/21/14
 * Time: 8:03 AM
 */

require('mainIndex.php');

class standaloneDatabaseActions {

    function createEmptyRow(){
        mysqli_query(mainIndex::indexConnection(), "INSERT INTO `table5060` () VALUES()");
    }





}
