<?php
session_start();

include '../data/database.php';

if(empty($_SESSION['id']))
{
  if(isset($_POST['formsendconnect']))
  {
    $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $passwordconnect = sha1($_POST['passwordconnect']);
    
    if(!empty($emailconnect) && !empty($passwordconnect))
    {
      $requser = $db->prepare("SELECT * FROM espace_membre WHERE pseudo = ? && email = ? && password = ?");
      $requser->execute(array($pseudoconnect, $emailconnect, $passwordconnect));
      $userexist = $requser->rowCount();

      if($userexist == 1)
      {
        $userinfo = $requser->fetch();
        $_SESSION['id'] = $userinfo['id'];
        $_SESSION['pseudo'] = $userinfo['pseudo'];
        $_SESSION['email'] = $userinfo['email'];

        header("Location: profil/profil.php?id=".$_SESSION['id']);
      }
      else
      {
        $erreur = "Mauvais email ou mot de pass";
      }
    }
    else
    {
      $erreur = "Tous les champs doivent être complétés !";
    }
  }
}
else
{
  header("Location: profil/profil.php?id=".$_SESSION['id']);
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <!--Boxicons CDN Link -->
    <link rel="stylesheet" type="text/css" href="../css/lesilluminésicons/css/boxicons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <?php include '../navigation/menunav.php';?>
    <div class="elapsed">
      <div class="text">
        <div class="securitie">
          <h2>Connexion</h2>
          <br/><br/>
          <form method="POST" action="">
            <table>
              <input type="pseudo" name="pseudoconnect" id="pseudoconnect" placeholder="Pseudo" required><br />
              <input type="email" name="emailconnect" id="emailconnect" placeholder="Email" required><br />
              <input type="password" name="passwordconnect" id="passwordconnect" placeholder="Mot de passe" required><br />
            </table>
            <input type="submit" name="formsendconnect" id="formsendconnect">
          </form>
          <?php
          if(isset($erreur))
          {
            echo '<font color="red">'.$erreur."</font>";
          }
          ?>
        </div>
      </div>
    </div>
  </body>
</html>