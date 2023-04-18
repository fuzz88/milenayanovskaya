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
?>

<!DOCTYPE html>
<html>

<head>
  <title>Gallery Administration</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
  <div class="container">

    <div class="row">
      <h1>Upload</h1><br>
      <form class="form" method="POST" action="upload.php" enctype="multipart/form-data">
        <div>
          <span>Select single file to upload:</span>
          <input type="file" name="uploadedFile" />
          <br>
          <br>
          <label>Enter image caption:</label>
          <input type="text" name="caption" />
        </div>
        <br>
        <input type="submit" name="uploadBtn" value="Upload" />
      </form>

    </div>
    <br>
    <br>
    <br>


    <div class="row">
      <h1>Edit / Delete</h1><br>

      <table class="table">
        <thead>
          <tr>
            <th>preview</th>
            <th>filename</th>
            <th>caption</th>
            <th>actions</th>
          </tr>
        </thead>
        <tbody><?php
                $image_extensions = array("png", "jpg", "jpeg");
                $dir = '../images/';

                if (is_dir($dir)) {
                  if ($dh = opendir($dir)) {

                    while (($file = readdir($dh)) !== false) {

                      if ($file != '' && $file != '.' && $file != '..') {

                        $image_path = "../images/" . $file;
                        $thumbnail_ext = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
                        $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);
                        if (
                          !is_dir($image_path) &&
                          in_array(strtolower($image_ext), $image_extensions)
                        ) {
                          ?>
                    <tr>
                      <td><img src="<?php echo $image_path; ?>" alt="" title="" width="100px" height="auto" /></td>
                      <td width="auto"><?php echo $file; ?></td>
                      <form class="form" method="POST" enctype="multipart/form-data" action="edit.php">
                        <?php $result = mysqli_query($db, "SELECT caption FROM images WHERE file_name = '" . $file . "' LIMIT 1;");
                                  $caption = mysqli_fetch_array($result);
                                  if ($caption) {
                                    $caption = $caption[0];
                                  } ?>
                        <td><input type="text" name="caption" min_width="500px" value="<?php echo $caption; ?>"></td>
                        <td>
                          <input type="hidden" value="<?php echo $file; ?>" name="file_name">
                          <input type="submit" name="SaveBtn" value="Save">
                      </form>
                      <form class="form" method="POST" enctype="multipart/form-data" action="edit.php">
                        <input type="hidden" value="<?php echo $file; ?>" name="file_name">
                        <input type="submit" name="DeleteBtn" value="Delete">
                      </form>

                      </td>

                      <a href="<?php echo $image_path; ?>">

                      </a>
                    </tr>
          <?php

                  }
                }
              }
              closedir($dh);
            }
          }
          ?>
        </tbody>
      </table>

    </div>
  </div>
</body>

</html>