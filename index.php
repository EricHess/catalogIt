<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 7/3/14
 * Time: 11:38 AM
 */

    require('controllers/mainIndex.php');
    $indexController = new mainIndex();

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
        <input type='hidden' name='category_title' value="Title" /><br>

<?php
$indexController::indexConnection();
$indexController::getIndexValues();
?>


        <div class="addNewCategoryRow">NEW ROW</div>
        <input type='submit' value='Next Step' />
    </form>
</div>

</body>
</html>

<!--
--UPDATES FOR NOW--
*AUTO FILL IN BOXES BASED ON WHAT IS IN THE DATABASE IF COOKIE'D

Get the initial creation of the database working.. Currently I have to create the first row
If PID and Table Name do not exist, create the columns

--UPDATES FOR LATER--
BUILD LOGIN FUNCTIONALITY
BUILD TOP TOOLBAR / NAVIGATION WITH HOME (DASHBOARD), STEP 1, STEP 2, STEP 3
BUILD COOKIE TO DETERMINE PROGRESS AND AUTO LAND USER ON CORRECT STEP


-->