<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 8/7/14
 * Time: 4:14 PM
 */

class sessionDestroy{

    function destroySession(){
        session_start();
        $_SESSION = array();
        session_destroy();
        header('/catalog_it');
    }


}

$destroy = new sessionDestroy();
$destroy->destroySession();
