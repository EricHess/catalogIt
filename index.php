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
        <input type='hidden' name='category_title' value="PID" /><br>
        <input type='hidden' name='category_title' value="TABLENAME" /><br>
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
Add in new column if new one is added in index.php
Delete row functionality

--UPDATES FOR LATER--
BUILD LOGIN FUNCTIONALITY
BUILD TOP TOOLBAR / NAVIGATION WITH HOME (DASHBOARD), STEP 1, STEP 2, STEP 3
BUILD COOKIE TO DETERMINE PROGRESS AND AUTO LAND USER ON CORRECT STEP


-->