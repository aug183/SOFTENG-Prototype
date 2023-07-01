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
    //INSERT INTO reservations (`password`, last_name, first_name, email, contact, organization, services, date_reserved, start_time, end_time, purpose)
    $sql = "SELECT * FROM reservations WHERE reservation_code = '$id'";
    require_once("../connection.php");

    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $reservation_code = $row[0];
    $password = $row[1];
    $last_name = $row[2];
    $first_name = $row[3];
    $date_created = $row[4];
    $email = $row[5];
    $contact = $row[6];
    $organization = $row[7];
    $services = $row[8];
    $date_reserved = $row[9];
    $start_time = $row[10];
    $end_time = $row[11];
    $purpose = $row[12];
    $reason = "Cancelled by Admin";
    $sql = "INSERT INTO `cancellations` (reservation_code, `password`, last_name, first_name, date_created, email, contact, organization, services, date_reserved, start_time, end_time, purpose, reason) 
    VALUES ('$reservation_code', '$password', '$last_name', '$first_name', '$date_created', '$email', '$contact', '$organization', '$services', '$date_reserved', '$start_time', '$end_time', '$purpose', '$reason')";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . $con -> error);
    } 
    $sql = "DELETE FROM `reservations` WHERE reservation_code = '$id'";
    if (!mysqli_query($con, $sql)) {
        die('Error: ' . $con -> error);
    }
}