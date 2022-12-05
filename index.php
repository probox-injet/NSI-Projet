<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Média Lycée</title>
  <link rel="icon" type="image/jpg" href="img/clubmedia_logo.jpg">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <!-- Boxicons CDN Link -->
  <link rel="stylesheet" type="text/css" href="css/lesilluminésicons/css/boxicons.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <?php
  // include 'navigation/menunav.php';
  ?>
  <div class="elapsed">
    <span>Test</span><br/>
    <?php
    include 'Library/functions.php';

    test("Test1");
    ?>
  </div>
  <script src="js/loader.js"></script>
</body>
</html>