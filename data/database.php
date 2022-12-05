<?php
  define('HOST','localhost');
  define('DB_NAME','u665760980_media');
  define('USER','u665760980_memberml');
  define('PASS','T3m]Vx#wqE#f7pzrz]WP^Gu~Gzs3O:G4p|jMJx;5Q[4w0H@fd7!XP/');

  try
  {
    $db = new PDO("mysql:host = ". HOST . ";dbname=". DB_NAME, USER, PASS);
    $db ->setAttribute(PDO:: ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } 
  catch(PDOException $e)
  {
    echo $e;
  }
?>