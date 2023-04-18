<?php
// Database configuration 
$dbHost     = "localhost";
$dbUsername = "q99942ur_ofb7904";
$dbPassword = "twQrmT6%";
$dbName     = "q99942ur_ofb7904";

// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection 
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (isset($_POST['SaveBtn']) && $_POST['SaveBtn'] == 'Save') {
    mysqli_query($db, "UPDATE images SET caption = '" . $_POST['caption'] . "' WHERE file_name = '" . $_POST['file_name'] . "';");
}

if (isset($_POST['DeleteBtn']) && $_POST['DeleteBtn'] == 'Delete') {
    mysqli_query($db, "DELETE FROM images WHERE file_name = '" . $_POST['file_name'] . "';");
    unlink('../images/' . $_POST['file_name']);
}

mysqli_close($db);
header("Location: /gallery/manage");
exit();
