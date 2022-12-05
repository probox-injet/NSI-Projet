<?php
session_start();

include '../../data/database.php';
include_once '../../Library/functions.php';
const BR = '<br/>';

if(empty($_SESSION['id']))
{
  header("Location: ../../securite/connexion_user.php");
}
else
{
  if(isset($_SESSION['id']))
  {
    $requser = $db->prepare('SELECT * FROM espace_membre WHERE id = ?');
    $requser->execute($_SESSION['id']);
    $userinfo = $requser->fetch();

    $_SESSION['validate'] = 0;
    if($_SESSION['admin'] == "<>╣<>" || $_SESSION['admin'] == "<>p<>")
    {
      if(isset($_POST['valid']))
      {
        if(!empty($_POST['string']) && !empty($_POST['droit']))
        {
          $type = htmlspecialchars($_POST['string']);
          $droit = htmlspecialchars($_POST['droit']);
          if($type == "files" || $type == "actu/ecologie" || $type == "actu/photo" || $type == "actu/resumer_actu" || $type == "culture/cinema" || $type == "culture/expo" || $type == "culture/livre" || $type == "culture/musique" || $type == "culture/serie" || $type == "culture/spectacle" || $type == "detente/apprendre_langue" || $type == "detente/astrologie" || $type == "detente/cuisine" || $type == "detente/quizz" || $type == "detente/relaxation")
          {
            if($droit == "privé" || $droit == "public")
            {
              createFile($type, $droit);
            }
            else
            {
              $erreur = $droit." n'est pas enregistré dans la base de donnée".BR."Entrer 'help' pour en savoir plus".BR;
            }
          }
          else if($type == "help" || $type == "?" || $type == "?h" || $type == "h")
          {
            $erreur = "type :".BR."culture/[dossier]".BR."actu/[dossier]".BR."detente/[dossier]".BR."files".BR.BR."droit de fichier :".BR."privé = les fichiers peuvent être seulement télécharger par les admins".BR."public = les fichiers peuvent être télécharger par le public";
          }
          else
          {
            $erreur = $type." n'est pas enregistré dans la base de donnée".BR."Entrer 'help' pour en savoir plus".BR;
          }
        }
        else if(!empty($_POST['droit']))
        {
          $droit = htmlspecialchars($_POST['droit']);
          if($droit == "privé" || $droit == "public")
          {
            createFile("files", $droit);
          }
          else if($droit == "help" || $droit == "?" || $droit == "?h" || $droit == "h")
          {
            $erreur = "droit de fichier :".BR."privé = les fichiers peuvent être seulement télécharger par les admins".BR."public = les fichiers peuvent être télécharger par le public";
          }
        }
      }
    }
    else if($_SESSION['admin'] == "xxxxx" && $_SESSION['valide'] == 1)
    {
      $_SESSION['validate'] = 1;
      $_SESSION['type'] = "files";
      $_SESSION['droit'] = "public";
    }
    else if($_SESSION['admin'] == "<>p<>" && $_SESSION['valide'] == 2)
    {
      $_SESSION['validate'] = 0;
    }

    if(isset($_POST['fileDownload']))
    {
      $id = $_SESSION['id'];
      $admin = $_SESSION['admin'];
      accessDownload($id, $admin);
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Upload Type</title>
  <link rel="icon" type="image/jpg" href="../../img/clubmedia_logo.jpg">
  <link rel="stylesheet" type="text/css" href="../../css/style.css">
  <!--Boxicons CDN Link -->
  <link rel="stylesheet" type="text/css" href="../../css/lesilluminésicons/css/boxicons.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="../../js/barre_progress.js"></script>
</head>
<body>
  <?php include '../../navigation/actu/menunavactu.php';?>
  <div class="elapsed">
    <div class="text">
      <form method="POST" action="" enctype="multipart/form-data">
        <?php
        if($_SESSION['validate'] == 1)
        {
          ?>
        <!--Taille Maximal exprimet en octets-->
        <!--40Mo -> 1000*40*1024 = 40960000 octets-->
        <input type="hidden" name="MAX_FILE_SIZE" value="40960000">
        <input type="file" id="file" name="file" required>
        <input type="button" name="Uploader" value="Uploader" onclick="uploadFichier()"><br/>
        <?php
        if($_SESSION['admin'] == "xxxxx" && $_SESSION['valide'] == 1)
        {
          $erreur = "/!\Les fichiers que vous allez uploader pourrons être télécharger par les autres utilisateurs.".BR."/!\SI VOUS INSERER DES FICHIERS MALVEILLIANT OU LOGICIEL CRACKEE, IL SERONS SUPRIMEE ET VOUS N'AUREZ PLUS LA POSIBILITER D'UPLOADER DES FICHIERS".BR."Nous déclinons toutes résponsabilitéent si vos fichiers ont étaient téléchargéent par d'autres utilisateur !";
        }
        ?>
        <progress id="progressBar" value="0" max="100" style="width: 500px;"></progress>
        <?php
        }
        else if($_SESSION['admin'] == "<>╣<>" || $_SESSION['admin'] == "<>p<>")
        {
          if($_SESSION['valide'] == 4)
          {
            ?>
          <img src="../../img/cdm_upload.jpg" id="img">
          <input type="is_string" name="string" id=" string" placeholder="type" required>
          <?php
          }
          ?>
          <input type="is_string" name="droit" id=" droit" placeholder="public/privé" required>
          <input type="submit" name="valid" id="valid" value="Suivant">
        <?php
        }
        ?>
        <br/><br/>
      </form>
      <form method="POST" action="">
        <input type="submit" name="fileDownload" id="fileDownload" value="Télécharger les fichiers">
      </form>
      <h2 id="status"></h2>
      <p id="status_bytes"></p>

    <?php
    if(isset($erreur))
    {
      echo '<font color="red">'.$erreur."</font>";
    }
    ?>
    </div>
  </div>
</body>
</html>
<?php
}
?>