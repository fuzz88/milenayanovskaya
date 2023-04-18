<!DOCTYPE html>
<html>
<head>
  <title>Gallery Image Upload</title>
</head>
<body>
  <form method="POST" action="upload.php" enctype="multipart/form-data">
    <div>
      <span>Upload an Image:</span>
      <input type="file" name="uploadedFile" />
    </div>
 
    <input type="submit" name="uploadBtn" value="Upload" />
  </form>
</body>
</html>
<?php
$dir = dirname(__FILE__);
echo "<p>Full path to this dir: " . $dir . "</p>";
echo "<p>Full path to a .htpasswd file in this dir: " . $dir . "/.htpasswd" . "</p>";
?>