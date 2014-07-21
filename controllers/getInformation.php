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

    $PIDs = mysqli_query(initialConnection(), "SELECT PID FROM table5060");
    $PIDs = mysqli_fetch_all($PIDs);

//    for($i=0;$i<count($newData);$i++){
//        $sql = "UPDATE table5060 SET ".$newData[$i]->name."=".$newData[$i]->value." WHERE PID=".$PIDs[$i];
//
//        echo $sql;
//        $i++;
//    }

    foreach($newData as $key=>$dataRows){

        foreach($dataRows as $finalRows){
            $sql = "UPDATE table5060 SET ".$finalRows->name." = '".$finalRows->value."' WHERE PID=".$PIDs[$key][0];
            mysqli_query(initialConnection(),$sql);
        }

    }

//TODO: Allow for newly created rows to be added as a new row in the database

    initNewInfoDataCreation();
}


function initNewInfoDataCreation(){

}


