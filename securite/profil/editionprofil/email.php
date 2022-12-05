<?php
session_start();

include '../../../data/database.php';

if(isset($_SESSION['id']))
{
  $requser = $db->prepare("SELECT * FROM espace_membre WHERE id = ?");
  $requser->execute(array($_SESSION['id']));
  $user = $requser->fetch();

  if(isset($_POST['profilemail']) && !empty($_POST['profilemail']) && $_POST['profilemail'] != $user['email'])
  {
    $profilemail = htmlspecialchars($_POST['profilemail']);
    $profilpassword = sha1($_POST['profilpassword']);
    $profilcpassword = sha1($_POST['profilcpassword']);
    
    if(!empty($profilemail) && !empty($profilpassword))
    {
      if(filter_var($profilemail, FILTER_VALIDATE_EMAIL))
      {
        if($profilpassword == $profilcpassword)
        {
          $insertemail = $db->prepare("UPDATE espace_membre SET email = ? WHERE id = ?");
          $insertemail->execute(array($profilemail, $_SESSION['id']));
          header('Location: ../profil.php?id='.$_SESSION['id']);
        }
        else
        {
          $erreur =  "Vos deux password ne correspandent pas !";
        }
      }
      else
      {
        $erreur = "Votre adresse mail n'est pas valide";
      }
    }
    else
    {
      $erreur =  "Vous devez remplir tout les champs";
    }
  }

  if(isset($_POST['profilspeudo']) && $_POST['profilspeudo'] == $user['pseudo'])
  {
    header('Location: ../profil.php?id='.$_SESSION['id']);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Modification Email</title>
    <link rel="stylesheet" type="text/css" href="../../../css/style.css">
    <!--Boxicons CDN Link -->
    <link rel="stylesheet" type="text/css" href="../../../css/lesilluminésicons/css/boxicons.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <!-- Menu de navigation-->
    <?php include '../../../navigation/actu/science/menunavscience.php';?>
    <div class="elapsed">
      <div class="text">
        <div class="securitie">
            <h2>Modifier Email</h2>
            <br/>
            <form method="POST" action="">
                <input type="text" name="profilemail" placeholder="Email" value="<?php echo $user['email'];?>"/><br/>
                <input type="password" name="profilpassword" placeholder="Password"/><br/>
                <input type="password" name="profilcpassword" placeholder="Confirmé Password"/><br/>
                <input type="submit" value="Mettre à jour mon profil"/><br/>
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
<?php
}
else
{
  header("Location: ../connexion_user.php");
}
?>