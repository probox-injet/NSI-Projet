<?php
session_start();

include '../../data/database.php';

if(empty($_SESSION['id']))
{
  header("Location: ../connexion_user.php");
}
else
{
  if(isset($_GET['id']) && $_GET['id'] > 0)
  {
    $getid = intval($_GET['id']);
    $requser = $db->prepare('SELECT * FROM espace_membre WHERE id = ?');
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
    $_SESSION['admin'] = $userinfo['admin'];
  }
  ?>

<!DOCTYPE html>
<html>
  <head>
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <!--Boxicons CDN Link -->
    <link rel="stylesheet" type="text/css" href="../../css/lesilluminésicons/css/boxicons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <!-- Menu de navigation-->
    <?php include '../../navigation/actu/menunavactu.php';?>
    <div class="elapsed">
      <div class="text">
        <?php
      if($userinfo['id'] == $_SESSION['id'])
      {
        ?>
      <div>
        <h2 class="securitie">Profil de <?php echo $userinfo['pseudo']; ?></h2>
        <br/><br/>
        Pseudo = <?php echo $userinfo['pseudo'];?>
        <a href="editionprofil/pseudo.php">Modifier</a>
        <br/>
        Mail = <?php echo $userinfo['email'];?>
        <a href="editionprofil/email.php">Modifier</a>
        <br/>
        Password = *****
        <a href="editionprofil/password.php">Modifier</a>
        <br/>
        <a href="../deconnexion_user.php">Changer de compte</a>
        <?php
        if($userinfo['admin'] == "<>╣<>")
        {
        ?>
        <br/>
        <form method="POST" action="">
          <input type="submit" name="compteadmin" id="compteadmin" value="Créer un compte Admin">
        </form>
        <h2>Compte Administrateur</h2>
        <form method="POST" action="">
          <table>
            <input type="pseudo" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)){echo $pseudo; } ;?>" placeholder="Pseudo" required><br/>
            <input type="email" name="email" id="email" value="<?php if(isset($email)){echo $email; } ;?>" placeholder="Email" required><br/>
            <input type="email" name="cemail" id="cemail" value="<?php if(isset($cemail)){echo $cemail; } ;?>" placeholder="Confirme Email" required><br/>
            <input type="password" name="password" id="password" placeholder="Mot de passe" required><br/>
            <input type="password" name="cpassword" id="cpassword" placeholder="Confirme mot de passe" required><br/>
          </table>
          <input type="submit" name="formsendadmin" id="formsendadmin">
        </form>
        <?php 
        }
        ?>
      </div>
      <?php
      }
      ?>
      </div>
    </div>
  </body>
</html>
<?php
}
if(isset($_POST['formsendadmin']))
{
  $pseudo = htmlspecialchars($_POST['pseudo']);
  $email = htmlspecialchars($_POST['email']);
  $cemail = htmlspecialchars($_POST['cemail']);
  $password = sha1($_POST['password']);
  $cpassword = sha1($_POST['cpassword']);
  
  if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['cemail']) && !empty($_POST['password']) && !empty($_POST['cpassword']))
  {
    $pseudolength = strlen($pseudo);

    if($pseudolength <= 255)
    {
      if($email == $cemail)
      {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
          $reqmail = $db->prepare("SELECT * FROM espace_membre WHERE email = ?");
          $reqmail->execute(array($email));
          $mailexist = $reqmail-> rowCount();

          if($mailexist == 0)
          {
            if($password == $cpassword)
            {
              $insertmember = $db->prepare("INSERT INTO espace_membre(pseudo, email, password, admin) VALUES(?, ?, ?, ?)");
              $insertmember->execute(array($pseudo, $email, $password, "<>╣<>"));
            }
            else
            {
              $erreur = "Vos mot de passe ne correspondent pas !";
            }
          }
          else
          {
            $erreur = "Adresse email déjà utilisée !";
          } 
        }
        else
        {
          $erreur = "Votre adresse mail n'est pas valide";
        }
      }
      else
      {
        $erreur = "Vos adresse email ne correspondent pas !";
      }
    }
    else
    {
      $erreur = "Votre speudo ne doit pas dépasser 255 caractère";
    }
  }
  else
  {
    $erreur = "Tous les champs doivent être complétés !";
  }
}
?>