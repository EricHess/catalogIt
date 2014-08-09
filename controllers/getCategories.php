<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/6/14
 * Time: 8:33 AM
 * Purpose: This file should take the categories from step 1 and save them as columns in the database
 * Purpose 2: Then build out the UI for the categories along the top of step 2
 */

require('mainController_new.php');

$globalArray = [];
//session_start();
class getCategories {

    function indexConnection(){
        $connect = mysqli_connect('localhost','root','','catalog_it','3306');
        return $connect;
    }

    function outputCategoriesToDatabase(){
        foreach($_POST as $categories){
            $sql = "ALTER TABLE ".$_SESSION['table_name']." ADD ".$categories." VARCHAR(60);";
            mysqli_query($this->indexConnection(), $sql);
            $this->pushCategoriesToArray($categories);
        }
        global $globalArray;
        $this->createNewUIWithCategories($globalArray);
    }

    function pushCategoriesToArray($category){
        global $globalArray;
        array_push($globalArray, $category);
    }

    function createNewUIWithCategories($category){
        global $globalArray;
        echo '<div class="categories">';

        foreach ($globalArray as $category){
            echo "<div class='category category_".$category."'>";
            echo $category;
            echo "</div>";
        };

        echo '</div>';
        $this->createNewUI($globalArray);
    }

    function createNewUI($categories){

    }
}

$cats = new getCategories();
$cats->outputCategoriesToDatabase();



$ui = new mainController();
$ui->createNewUI(count($globalArray),$globalArray);
//NEED TO RUN CREATE NEW UI FROM MAINCTONROLLER_NEW.PHP TO RENDER ROWS
//OR NEED TO RECREATE WITH REFACTORED
