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
    $newData = explode('&',$newData);

    foreach ($newData as $data){
        $data = explode('=', $data);
        getInfoFieldValues($data[0], $data[1]);
    };

    initNewInfoDataCreation();
}

function getInfoFieldValues($key, $value){
    global $keys;
    global $values;
    array_push($keys,$key);
    array_push($values,$value);
};

function pushToDatabase($keys, $values){
echo '<pre>';
    print_r($keys);
    print_r($values);
echo '</pre>';

    $sql = 'INSERT INTO `'.$values[0].'`(`PID`,';
    foreach ($keys as $categories){
        $sql .= '`'.$categories.'`,';
    }
    //REMOVE THE FINAL COMMA
    $sql = substr($sql, 0, -1);
    //CLOSE UP SHOP
    $sql.= ')';
    $sql.='VALUES(';
    $sql .='"'.rand(1,9999).'",';
    foreach($values as $value){
        $sql.= '"'.$value.'",';
    }
    //REMOVE THE FINAL COMMA
    $sql = substr($sql, 0, -1);
    //CLOSE UP SHOP
    $sql.= ')';

    echo $sql;
    mysqli_query(initialConnection(), $sql);
}

function initNewInfoDataCreation(){
    global $keys;
    global $values;
    pushToDatabase($keys, $values);
}

//GRAB SERIZLIAED ARRAY
//EXPLODE BASED ON AMPERSAND (EACH K-V PAIR) AND EQUALS SIGN(EACH VALUE OF K AND V)
//INSERT INTO TABLE NAME WITH KEYS AS CATEGORY PACAKAGE AND VALUES AS WHAT TO PUT IN
//SCALE IT
