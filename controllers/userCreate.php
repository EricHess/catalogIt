<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 8/4/14
 * Time: 8:23 PM
 * Purpose: This file will take the post from the create user prompt and set up the account
 * Actions: Get info from form, create database table from table name, insert form information in to users table
 * Actions Cntd: Start session, cookie table_name
 */

class userCreate {

    function indexConnection(){
        $connect = mysqli_connect('localhost','root','','catalog_it','3306');
        return $connect;
    }

    function getTableName(){
        return $_POST['table_name'];
    }

    function getUserName(){
        return $_POST['username'];
    }

    function getRealName(){
        return $_POST['realname'];
    }

    function getPassword(){
        return $_POST['password'];
    }

    //To check and see if account already exists
    function getLoginCredentials($username,$password){

        $sqlStatement = 'SELECT * FROM users_table WHERE username = "'.$username.'" AND password = "'.$password.'"';
        $findUser = mysqli_query($this->indexConnection(),$sqlStatement);

        if(mysqli_fetch_row($findUser) > 0){
            echo '<span class="error">This username already exists</span>';
        }else{
            //if it passes
            $this->insertUserIntoUsersTable();
            $this->setSession();
        }
    }


    function insertUserIntoUsersTable(){
        $sqlStatement = "INSERT INTO `catalog_it`.`users_table` (`PID`, `tablename`, `username`, `password`, `real_name`) VALUES ('', '".$this->getTableName()."', '".$this->getUserName()."', '".$this->getPassword()."', '".$this->getRealName()."')";
        mysqli_query($this->indexConnection(),$sqlStatement);
        $this->createEmptyDatabaseTable();
    }

    function createEmptyDatabaseTable(){
        $sqlStatement = 'CREATE TABLE '.$this->getTableName().'(PID int NOT NULL AUTO_INCREMENT PRIMARY KEY)';
        $result = mysqli_query($this->indexConnection(), $sqlStatement);
        $this->createEmptyRow();
    }

    function createEmptyRow(){
        mysqli_query($this->indexConnection(), "INSERT INTO `".$this->getTableName()."` () VALUES()");
    }

    function setSession(){

//        session_name('loggedInSession');
        session_start();
        $_SESSION['authorized'] = true;
        $_SESSION['table_name'] = $this->getTableName();
        $_SESSION['real_name'] = $this->getRealName();
        echo "Session Started";
        print_r($_SESSION);
    }

}

$runme = new userCreate();
$runme->getLoginCredentials($runme->getUserName(),$runme->getPassword());

