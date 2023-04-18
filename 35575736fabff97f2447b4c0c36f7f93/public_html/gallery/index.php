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

<html>

<head>
    <title>Milena Yanovskaya, Gallery</title>
    <!-- jQuery 1.8 or later, 33 KB -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Fotorama from CDNJS, 19 KB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
</head>


<body style="margin: 0; background-color: black;">

    <div class="fotorama" data-width="100%" data-height="100%" data-nav="thumbs" data-allowfullscreen="true" data-arrows="false" data-click="true" data-swipe="true">
        <?php
        // Image extensions
        $image_extensions = array("png", "jpg", "jpeg");

        // Target directory
        $dir = './images/';
        if (is_dir($dir)) {

            if ($dh = opendir($dir)) {

                // Read files
                while (($file = readdir($dh)) !== false) {

                    if ($file != '' && $file != '.' && $file != '..') {

                        // Image path
                        $image_path = "./images/" . $file;
                        $thumbnail_ext = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
                        $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);
                        // Check its not folder and it is image file
                        if (
                            !is_dir($image_path) &&
                            // in_array(strtolower($thumbnail_ext), $image_extensions) &&
                            in_array(strtolower($image_ext), $image_extensions)
                        ) {
                            $result = mysqli_query($db, "SELECT caption FROM images WHERE file_name = '" . $file . "' LIMIT 1;");
                            $caption = mysqli_fetch_array($result);
                            if ($caption) {
                                $caption = $caption[0];
                            }
                            ?>
                            <a href="<?php echo $image_path; ?>" data-caption="<?php echo $caption; ?>">
                            </a>
        <?php

                        }
                    }
                }
                closedir($dh);
            }
        }
        ?>
    </div>
</body>

</html>