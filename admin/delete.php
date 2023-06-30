<?php 
 require_once('../connection.php');
 if (isset($_POST['item_id'])) {
    // Retrieve the item ID from the AJAX request
    $itemId = $_POST['item_id'];

    // Delete the item from the database
    $sql = "DELETE FROM offers WHERE offer_name = '$itemId'";
    if (!mysqli_query($con, $sql))
    {
        die('Error: ' . $con -> error);
    }

    // Delete item in the dates table
    $sql = "ALTER TABLE dates DROP COLUMN `$itemId`";
    if (!mysqli_query($con, $sql))
    {
        die('Error: ' . $con -> error);
    }
}

if (isset($_POST['org'])) {
    // Retrieve the item ID from the AJAX request
    $org = $_POST['org'];

    // Delete the item from the database
    $sql = "DELETE FROM organizations WHERE `Organization Name` = '$org'";
    if (!mysqli_query($con, $sql))
    {
        die('Error: ' . $con -> error);
    }

    // Delete item in the dates table
    $sql = "ALTER TABLE dates DROP COLUMN `$org`";
    if (!mysqli_query($con, $sql))
    {
        die('Error: ' . $con -> error);
    }
}

if (isset($_POST['id'])) {
    // Retrieve the item ID from the AJAX request
    $id = $_POST['id'];
    $sql = "INSERT INTO `cancellations` SELECT * FROM `reservations` WHERE reservation_code = '$id'";
    require_once("../connection.php");

    if (!mysqli_query($con, $sql)) {
        die('Error: ' . $con -> error);
    } 

    $sql = "DELETE FROM `reservations` WHERE reservation_code = '$id'";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . $con -> error);
    }    
}