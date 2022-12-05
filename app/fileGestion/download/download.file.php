<?php 
session_start();
include '../../data/database.php';
include '../../Library/functions.php';

$requser = $db->prepare("SELECT * FROM espace_membre WHERE id = ?");
$requser->execute(array($_SESSION['id']));
$rowUser = $requser->fetch();

if(isset($_POST['delete']))
{
  $id = $_POST['id'];
  
  $stmt = $db->prepare("SELECT * FROM fichiers WHERE id = $id");
  $stmt->execute();

  while($rowDelete = $stmt->fetch())
  {
    if($rowDelete['pseudo'] == $rowUser['pseudo'])
    {
      $file = "../../".$rowDelete['type']."/".$rowDelete['nom'];
      delete($file, $id);
    }
    else
    {
      echo "Se fichier ne vous apartient pas !";
    }
  }
  
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Téléchargement</title>
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap/css/bootstrap.min.css">
  </head>
  <body>
    <p><br/></p>
    <div class="container">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Fichier</th>
            <th>Taille</th>
            <th>Type</th>
            <th>Éditeur</th>
            <th>Téléchargement</th>
            <th>Action</th>
            <th>Suppression</th>
            <?php
            if(!empty($_SESSION['admin']))
            {
              ?>
            <a href="../upload/verification.php">Retour</a>
            <?php
            }
            else
            {
              ?>
            <a href="../../index.php">Retour</a>
            <?php
            }
            ?>
          </tr>
        </thead>
        <tbody>
          <?php
          
          $stmt = $db->prepare("SELECT * FROM fichiers");
          $stmt->execute();

          while($row = $stmt->fetch())
          {
            $file = "../../".$row['type']."/".$row['nom'];
            ?>
          <tr>
            <?php
            if($_SESSION['valide'] == "4")
            {
              pre_download($row['id'], $row['nom'], $file, $row['pseudo'], $row['droit'], $row['downloads']);
              
              if($row['pseudo'] == $rowUser['pseudo'])
              {
                ?>
              <td>
                <form method="POST" action="">
                  <input type="is_string" id="id" name="id" placeholder="id">
                  <input type="submit" id="delete" name="delete" value="Supprimer">
                </form>
              </td>
              <?php
              }
            }
            else if($_SESSION['valide'] == "1" || $_SESSION['valide'] == "2")
            {
              if($row['droit'] == "public" || $row['pseudo'] == $rowUser['pseudo'])
              {
                pre_download($row['id'], $row['nom'], $file, $row['pseudo'], $row['droit'], $row['downloads']);
              ?>
              <td>
                <form method="POST" action="">
                  <input type="is_string" id="id" name="id" placeholder="id">
                  <input type="submit" id="delete" name="delete" value="Supprimer">
                </form>
              </td>
              <?php
              }
            }
            else if($row['droit'] == "public")
            {
              pre_download($row['id'], $row['nom'], $file, $row['pseudo'], $row['droit'], $row['downloads']);
            }
            ?>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <script src="../../css/bootstrap/js/jquery.min.js"></script>
    <script src="../../css/bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>