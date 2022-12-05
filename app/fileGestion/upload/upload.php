<?php
session_start();

include '../../data/database.php';

const BR = '<br/>';

if(!empty($_FILES))
{
  $error = $_FILES['file']['error'];
  $tmp_rep = $_FILES['file']['tmp_name'];
  $file_name = $_FILES['file']['name'];
  $taille_file = $_FILES['file']['size'];
  $type_file = $_FILES['file']['type'];
  
  if($error != 0 || !$tmp_rep)
  {
    $erreur = 'Erreur: Le file n\'a pas pu être uploadé'.BR;
    die();
  }
  
  $erreur = 'Chargement du fichier '.$file_name.BR.'Étape 2/3';
  $reqfile = $db->prepare("SELECT * FROM fichiers WHERE nom = ?");
  $reqfile->execute(array($file_name));
  $file_exist = $reqfile->rowCount();
  
  if($file_exist == 0)
  {
    $insert_files = $db->prepare("INSERT INTO fichiers(nom, type, droit, pseudo) VALUE(?, ?, ?, ?)");
    $insert_files->execute(array($file_name, $_SESSION['type'], $_SESSION['droit'], $_SESSION['pseudo']));
    
    if(move_uploaded_file($tmp_rep, '../../'.$_SESSION['type']."/".$file_name))
    {
      $erreur = 'Charmement du fichier '.$file_name.BR.'Étape 3/3';
    }
    else
    {
      $erreur = 'Une erreur est survenue lors de l\'envoi du file';
    }
  }
  else
  {
    $erreur = 'Le fichier '.$file_name.' existe déjà';
  }
  
  if(isset($erreur))
  {
    echo '<font color="white">'.$erreur."</font>";
  }
}
?>