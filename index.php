<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/3/14
 * Time: 11:38 AM
 */



?>

<!DOCTYPE html>
<html>
<head>
    <title></title>
    <script src="scripts/jquery.js"></script>
    <script src="scripts/scripts.js"></script>
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<div class="mainCatalog">
    Create Your Categories (Title already included)
    <form method='post' class="category">
        <input style="display:none" type='text' name='category_title' value="Title" /><br>

<?php
require('controllers/mainIndex.php');
$mainIndexController = new mainIndex();

$mainIndexController->getKeyValues();
$mainIndexController->getIndexValues();
$mainIndexController->createAccountTable();

$randomNumber = rand(0, 10000);
?>


        <div class="addNewCategoryRow">NEW ROW</div>
        <input type='submit' value='Next Step' />
    </form>

    <?php if(!$_SESSION){ ?>
<div class="clr"></div>
    <div class="loginArea">
        <a class="accountLinks haveAnAccount" href="#">Already have an account?</a><br />
        <div class="loginBox hidden">
            <form method="post" id="loginForm">
                <input type="text" placeholder="User Name" name="username" />
                <input type="password" name="password" placeholder="Password" />
                <input type="submit" value="Login" />
            </form>
        </div>
        <a class="accountLinks createAccount" href="#">Create new account</a>
        <div class="createBox hidden">
            <form method="post" id="createUser">
                <input type="text" name="username" placeholder="User Name" />
                <input type="text" name="realname" placeholder="Real Name" />
                <input type="password" name="password"  placeholder="Password"/>
                <input type="hidden" name="table_name" value="table_<?php echo $randomNumber; ?>" class="tablename"  />
                <input type="submit" value="Create User"/>
            </form>
        </div>
    </div>
    <?php
        } else{

        echo '<div class="logout">LOGOUT</div>';

    }?>

</div>

</body>
</html>

<!--
--UPDATES FOR NOW--
todo: refactor to allow for login functionality
todo: Allow for multiple input types (Text, checkbox, image at least)
todo: refactor getInformation.php to work more efficiently
todo: Allow for different special characters, including spaces and bangs
todo: stylize a nice UI
todo: next steps
todo: allow for auto jumping to different steps of the UI
todo: insta-save when the last input field is focus/blurred with data

--UPDATES FOR LATER--
BUILD LOGIN FUNCTIONALITY -- table w/ un, pw (md5), table number, actual name
BUILD TOP TOOLBAR / NAVIGATION WITH HOME (DASHBOARD), STEP 1, STEP 2, STEP 3
BUILD COOKIE TO DETERMINE PROGRESS AND AUTO LAND USER ON CORRECT STEP

CREATE USER STEPS
-DO NOT SHOW THE MAIN UI UNTIL LOGGED IN OR CREATED
-FILL IN FORM FOR CREATE ACCOUNT
-CREATE TABLE BASED ON TABLE_NAME HIDDEN FIELD
-CREATE EMPTY ROW IN THAT TABLE
-POPULATE ROW WITH REST OF USER DATA (USERNAME, PASSWORD, REAL NAME)
-CREATE SESSION NAMED 'AUTHORIZED'
-RELOAD PAGE WITH FORM SHOWING AND FILTER TABLE_NAME AND FORM FIELDS THROUGHOUT
-->