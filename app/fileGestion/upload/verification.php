<?php
session_start();

include '../../data/database.php';

if(isset($_SESSION['id']))
{
  $requser = $db->prepare("SELECT * FROM espace_membre WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $userinfo = $requser->fetch();
  
  if($userinfo['admin'] == "<>╣<>" || $userinfo['admin'] == "<>p<>" || $userinfo['admin'] == "xxxxx")
  {
    if($userinfo['admin'] == "<>╣<>") $_SESSION['valide'] = "4";
    else if($userinfo['admin'] == "<>p<>") $_SESSION['valide'] = "2";
    else if($userinfo['admin'] == "xxxxx") $_SESSION['valide'] = "1";
    else return;

    header("Location: ./copy_files_remote_server.php?id=".$_SESSION['id']."&admin=".$_SESSION['admin']."&autorisation=".$_SESSION['valide']);
  }

}
else
{
  header("Location: ../download/download.file.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Vérification</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <!--Boxicons CDN Link -->
    <link rel="stylesheet" type="text/css" href="../../css/lesilluminésicons/css/boxicons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <?php include '../../navigation/actu/menunavactu.php';?>
    <div class="elapsed">
      <div class="text">
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