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

    $PIDs = mysqli_query(initialConnection(), "SELECT PID FROM ".$_SESSION['table_name']."");

    $PIDs = mysqli_fetch_all($PIDs);



    foreach($newData as $key=>$dataRows){
        foreach($dataRows as $finalRows){
            $sql = "UPDATE ".$_SESSION['table_name']." SET ".$finalRows->name." = '".$finalRows->value."' WHERE PID=".$PIDs[$key][0];
            mysqli_query(initialConnection(),$sql);
        }

    }
}
