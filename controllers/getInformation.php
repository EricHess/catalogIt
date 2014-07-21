<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/10/14
 * Time: 5:35 PM
 */

$values = [];
$keys = [];
require_once('mainController_new.php');


//If the post is set, run the functions
if(isset($_POST)){
    postData();
}


function postData(){

    $newData = file_get_contents('php://input');
    $newData = json_decode($newData);


    echo'<pre>';
    print_r($newData);
    echo'</pre>';


    initNewInfoDataCreation();
}


function initNewInfoDataCreation(){
}


