<?php
session_start();

include '../../../data/database.php';

if(isset($_SESSION['id']))
{
    $requser = $db->prepare("SELECT * FROM espace_membre WHERE id = ?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();

    if(isset($_POST['profilpassword']) && !empty($_POST['profilpassword']) && isset($_POST['profilcpassword']) && !empty($_POST['profilcpassword']))
    {
        $profilspeudo = htmlspecialchars($_POST['profilspeudo']);
        $profilemail = htmlspecialchars($_POST['profilemail']);
        $profilpassword = sha1($_POST['profilpassword']);
        $profilcpassword = sha1($_POST['profilcpassword']);
        
        if(filter_var($profilemail, FILTER_VALIDATE_EMAIL))
        {
            $requser = $db->prepare("SELECT * FROM espace_membre WHERE pseudo = ? && email = ?");
            $requser->execute(array($profilspeudo, $profilemail));
            $userexist = $requser->rowCount();
            
            if(!empty($profilspeudo) && !empty($profilemail) && !empty($profilpassword))
            {
                if($userexist == 1)
                {
                    if($profilpassword == $profilcpassword)
                    {
                        $insertpassword = $db->prepare("UPDATE espace_membre SET password = ? WHERE id = ?");
                        $insertpassword->execute(array($profilpassword, $_SESSION['id']));
                        header('Location: ../profil.php?id='.$_SESSION['id']);
                    }
                    else
                    {
                        $erreur =  "Vos deux password ne correspandent pas !";
                    }
                }
                else
                {
                    $erreur = "Votre email ou votre pseudo ne correspond pas !";
                }
            }
            else
            {
                $erreur =  "Vous devez remplir tout les champs";
            }
        }
        else
        {
            $erreur = "Votre adresse mail n'est pas valide";
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
    <title>Modification Password</title>
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
                <h2>Modifier Password</h2>
                <br/><br/>
                <form method="POST" action="">
                    <input type="text" name="profilspeudo" placeholder="Pseudo" value="<?php echo $user['pseudo'];?>"/><br/>
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