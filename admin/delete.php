<?php 
 require_once('../connection.php');
 if (isset($_POST['item_id'])) {
    // Retrieve the item ID from the AJAX request
    $itemId = $_POST['item_id'];

    // Delete the item from the database
    $sql = "DELETE FROM offers WHERE offer_name = '$itemId'";
    if (!mysql_query($sql, $con))
    {
        die('Error: ' . mysql_error());
    }

    // Delete item in the dates table
    $sql = "ALTER TABLE dates DROP COLUMN `$itemId`";
    if (!mysql_query($sql, $con))
    {
        die('Error: ' . mysql_error());
    }
}

if (isset($_POST['org'])) {
    // Retrieve the item ID from the AJAX request
    $org = $_POST['org'];

    // Delete the item from the database
    $sql = "DELETE FROM organizations WHERE `Organization Name` = '$org'";
    if (!mysql_query($sql, $con))
    {
        die('Error: ' . mysql_error());
    }

    // Delete item in the dates table
    $sql = "ALTER TABLE dates DROP COLUMN `$org`";
    if (!mysql_query($sql, $con))
    {
        die('Error: ' . mysql_error());
    }
}

?>