<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 8/4/14
 * Time: 8:23 PM
 */

class userLogin {

    function indexConnection(){
        $connect = mysqli_connect('localhost','root','','catalog_it','3306');
        return $connect;
    }

    function getUserName(){
        return $_POST['username'];
    }

    function getPassword(){
        return $_POST['password'];
    }

    function getUserTableName($username){
        $sqlStatement = 'SELECT tablename FROM users_table WHERE username = "'.$username.'"';
        $findTablename= mysqli_query($this->indexConnection(),$sqlStatement);
        $findTablename = mysqli_fetch_assoc($findTablename);
        return $findTablename['tablename'];
    }

    function loginUser($username,$password){

        $sqlStatement = 'SELECT * FROM users_table WHERE username = "'.$username.'" AND password = "'.$password.'"';
        $findUser = mysqli_query($this->indexConnection(),$sqlStatement);

        if(mysqli_fetch_row($findUser) > 0){
            session_start();

            $_SESSION['table_name'] = $this->getUserTableName($username);
        }else{
            echo 'Wrong Username/Password Combination';
        }
    }


}

$login = new userLogin();
$login->loginUser($login->getUserName(), $login->getPassword());