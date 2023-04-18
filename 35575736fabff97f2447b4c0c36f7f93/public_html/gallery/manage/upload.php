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

if (isset($_POST['uploadBtn']) && $_POST['uploadBtn'] == 'Upload') {
    if (isset($_FILES['uploadedFile']) && $_FILES['uploadedFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['uploadedFile']['tmp_name'];
        $fileName = $_FILES['uploadedFile']['name'];
        $fileSize = $_FILES['uploadedFile']['size'];
        $fileType = $_FILES['uploadedFile']['type'];
        $caption = $_POST['caption'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $allowedfileExtensions = array('jpg', 'jpeg', 'png');
        if (in_array(strtolower($fileExtension), $allowedfileExtensions)) {
            $uploadFileDir = '../images/';
            $dest_path = $uploadFileDir . $newFileName;
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $result = mysqli_query($db, "INSERT INTO images (file_name, caption) VALUES ('" . $newFileName . "','" . $caption . "');");
                $message = 'File is successfully uploaded.';
            } else {
                $message = 'There was some error moving the file to upload directory. Please make sure the upload directory is writable by web server.';
            }
        }
    }
}
mysqli_close($db);
header("Location: /gallery/manage");
exit();
