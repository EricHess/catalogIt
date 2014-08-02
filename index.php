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

?>


        <div class="addNewCategoryRow">NEW ROW</div>
        <input type='submit' value='Next Step' />
    </form>
</div>

</body>
</html>

<!--
--UPDATES FOR NOW--
todo: refactor "GetCategories.php" to make it work more efficiently
todo: Allow for different special characters, including spaces and bangs
todo: stylize a nice UI
todo: next steps
todo: allow for auto jumping to different steps of the UI
todo: insta-save when the last input field is focus/blurred with data

--UPDATES FOR LATER--
BUILD LOGIN FUNCTIONALITY
BUILD TOP TOOLBAR / NAVIGATION WITH HOME (DASHBOARD), STEP 1, STEP 2, STEP 3
BUILD COOKIE TO DETERMINE PROGRESS AND AUTO LAND USER ON CORRECT STEP


-->