<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/6/14
 * Time: 8:33 AM
 */

require_once('mainController_new.php');

$values = [];
$keys=[];

//If the post is set, run the functions
if(isset($_POST)){
    postData();
}

function postData(){

    $initialCount = mysqli_query(initialConnection(),"SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = 'table5060'");
    $initialCount = mysqli_fetch_assoc($initialCount);


    $newData = file_get_contents('php://input');
    $newData = explode('&',$newData);


    foreach ($newData as $data){
        $data = explode('=', $data);
        getFieldValues($data[0], $data[1]);
    };

    initDataCreation($initialCount, count($newData));
}

function getFieldValues($key, $value){
    global $values;
    global $keys;
    array_push($keys, $key);
    array_push($values,$value);
};

function getValues(){
    global $values;
    return $values;
}

function getKeys(){
  global $keys;
  return $keys;
};

function countRows(){

};

function valueOutput(){
    global $values;

    echo '<div class="categories">';

        foreach ($values as $category){
            echo "<div class='category category_".$category."'>";
                echo $category;
            echo "</div>";
        };

    echo '</div>';

}


function saveCategoriesToDatabase($originalCount, $newCount){
    global $values;
    $categoryPackage = [];
    $tableNameCookie = null;
    foreach ($values as $category){
        array_push($categoryPackage, $category);
    };


    $testthis = mysqli_query(initialConnection(),"SELECT * FROM table5060");

    $firstValues = [];
    //ACTUAL DATABASE VALUES FOR COLUMN NAMES
    if($testthis != null){

        $testthis = array_keys(mysqli_fetch_assoc($testthis));


        for ($i=1;$i<count($testthis);$i++){
            array_push($firstValues, $testthis[$i]);
        }

        $differencesAdd = array_diff($categoryPackage,$firstValues);
        $differencesDelete = array_diff($firstValues, $categoryPackage);


    }

    //CREATE A COOKIE IF IT DOES NOT ALREADY EXIST
    if(!$_COOKIE["table_name"]){
        setcookie("table_name",getTableName(), time()+1000000);
    }else{
        $tableNameCookie = $_COOKIE["table_name"];
    };

    if(count($differencesAdd) <= 0 && count($differencesDelete) <= 0 ){
        createNewTable($categoryPackage, 'table5060');
        createNewUI(count($values), $categoryPackage, 'table5060');
    } else{
            if(count($firstValues) < count($categoryPackage)){
                $differences = array_diff($categoryPackage,$firstValues);
                updateTable($differences, 'table5060');
            } else {
                $differences = array_diff($firstValues, $categoryPackage);
                deleteTable($differences, 'table5060');
            }

        //need to pass in array of arrays for category package so that multiple rows can be made
        // // IDEAS:
        // // Gather all PIDs in database, use them to return all rows, push each row in to an array, pass that array
        // // MYSQLi fetch array

        //currently updateTable creates a new row.. Just do an update, pivoted on PID
        createNewUI(count($values), $categoryPackage, 'table5060');
    };



}


function initDataCreation($originalCount, $newCount){
    getValues();
    valueOutput();
    saveCategoriesToDatabase($originalCount, $newCount);
}
