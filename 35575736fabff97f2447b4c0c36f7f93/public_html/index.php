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
  <meta charset="utf-8">

  <title>Milena Yanovskaya, Art</title>

  <!-- Behavioral Meta Data -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <!-- Styles -->
  <link rel="stylesheet" type="text/css" href="/assets/styles.css" />
  <link rel="stylesheet" type="text/css" href="/assets/fullpage.css" />
</head>

<body>
  <div id="container" class="container">
    <div id="fullpage">
      <div class="section" id="section0" data-anchor="home">
        <img class="aspect" src="/assets/images/layer2.png">
      </div>
      <div class="section" id="section1" data-anchor="gallery">
        <?php
        $image_extensions = array("png", "jpg", "jpeg");
        $dir = './gallery/images/';
        if (is_dir($dir)) {

          if ($dh = opendir($dir)) {
            while (($file = readdir($dh)) !== false) {

              if ($file != '' && $file != '.' && $file != '..') {
                $image_path = "./gallery/images/" . $file;
                $thumbnail_ext = pathinfo($thumbnail_path, PATHINFO_EXTENSION);
                $image_ext = pathinfo($image_path, PATHINFO_EXTENSION);
                if (
                  !is_dir($image_path) &&
                  in_array(strtolower($image_ext), $image_extensions)
                ) {
                  $result = mysqli_query($db, "SELECT caption FROM images WHERE file_name = '" . $file . "' LIMIT 1;");
                  $caption = mysqli_fetch_array($result);
                  if ($caption) {
                    $caption = $caption[0];
                  }
                  ?>

                  <div class="slide"><img src="<?php echo $image_path; ?>">
                    <h5><?php echo $caption; ?></h5>
                  </div>
        <?php
                }
              }
            }
            closedir($dh);
          }
        }
        ?>
      </div>
      <div class="section" id="section2" data-anchor="contacts">
        <h4 id="mail_text">feel free to drop me a line at:</h4>
        <h3><a class="mail" id="mail_link" href="mailto:me@milenayanovskaya.ru">me@milenayanovskaya.ru</a></h3>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    window.onload = function(){
    var url = 'https://milenayanovskaya.ru/assets/music/Birds Die Alone - live.mp3';
    window.AudioContext = window.AudioContext||window.webkitAudioContext; //fix up prefixing
    var context = new AudioContext(); //context
    var source = context.createBufferSource(); //source node
    source.connect(context.destination); //connect source to speakers so we can hear it
    var request = new XMLHttpRequest();
    request.open('GET', url, true); 
    request.responseType = 'arraybuffer'; //the  response is an array of bits
    request.onload = function() {
        context.resume();
        context.decodeAudioData(request.response, function(response) {
            source.buffer = response;
            source.start(0); //play audio immediately
            source.loop = true;
        }, function () { console.error('The request failed.'); } );
    }
    request.send();
}
  window.onclick = function(){
    var url = 'https://milenayanovskaya.ru/assets/music/Birds Die Alone - live.mp3';
    window.AudioContext = window.AudioContext||window.webkitAudioContext; //fix up prefixing
    var context = new AudioContext(); //context
    var source = context.createBufferSource(); //source node
    source.connect(context.destination); //connect source to speakers so we can hear it
    var request = new XMLHttpRequest();
    request.open('GET', url, true); 
    request.responseType = 'arraybuffer'; //the  response is an array of bits
    request.onload = function() {
        context.resume();
        context.decodeAudioData(request.response, function(response) {
            source.buffer = response;
            source.start(0); //play audio immediately
            source.loop = true;
        }, function () { console.error('The request failed.'); } );
    }
    request.send();
}
  </script>
  <script type="text/javascript" src="/assets/fullpage.js"></script>
  <script>
    new fullpage('#fullpage', {
      licenseKey: 'BKzEtTK?r5',
      controlArrows: false
    });
  </script>
</body>

</html>
