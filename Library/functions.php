<?php
session_start();

const BR = '<br/>';

function pre_r($array)
{
    echo'<pre>';
    print_r($array);
    echo '</pre>';
}

function file_size($file)
{
    if(filesize($file) <= 999 && filesize($file) > 0)
    {
        echo filesize($file)." o";
    }
    else if((filesize($file) / 1000) > 0 && (filesize($file) / 1000) <= 999) 
    {
        echo (double)round((filesize($file)/1000), 2)." Ko";
    }
    else if((filesize($file) / 1000000) > 0 && (filesize($file) / 1000000) <= 999999)
    {
        echo (double)round((filesize($file)/1000000), 2)." Mo";
    }
}

function accessDownload($id, $admin)
{
    header("Location: ../download/download.file.php?id=".$id."&admin=".$admin);
}
function pre_download($id, $nom, $file, $editeur, $droit, $downloads)
{
    ?>
    <!--Écrit l'id-->
    <td><?php echo $id?></td>
    <!--Écrit le nom-->
    <td><?php echo $nom?></td>
    <!--Envoie le chemin du fichier-->
    <td><?php echo file_size($file)?></td>
    <!--Écrit le droit d'accé au fichier-->
    <td><?php echo $droit?></td>
    <!--Écrit le pseudo de la personne qui a posté le fichier-->
    <td><?php echo $editeur?></td>
    <!--Écrit le nombre de fois que le fichier a était télécharger-->
    <td><?php echo $downloads?></td>
    <!--Donne le lien pour pouvoir télécharger le fichier-->
    <td><a href="download.php?id=<?php echo $id?>" class="text-center">Télécharger</a></td>
    <?php
}

function delete($path, $id)
{
    include '../data/database.php';
    $supprFile = $db->prepare("DELETE FROM fichiers WHERE id = ?");
    $supprFile->bindParam(1, $id, PDO::PARAM_INT);
    $supprFile->execute();
    //$fileExist = $supprFile->fetch();
    
    if($fileExist)
    {
        echo "suppresion réussi";
    }
    else
    {
        echo "error";
    }
    // header("Location: download.file.php?id=".$_SESSION['id']."&admin".$_SESSION['admin']);
    // if(!unlink($path))
    // {
    //     echo "Vous avez une erreur";
    // }
    // else
    // {
    //     header("Location: download.file.php?id=".$_SESSION['id']."&admin".$_SESSION['admin']."&deletesuccess&idfile=".$id);
    // }
}

/**
 * En voie de développement
 */

function slideFileFolder($folderIndent, $type, $name)
{
    if($type == "actu/ecologie"
        || $type == "actu/photo"
        || $type == "actu/resumer_actu"
        )
    {
        // include '../data/database.php';

        $file = $folderIndent.$type."/".$name;
        ?>
        <li><a href="<?php $file?>"><?php $name?></a></li>
        <?php
    }
}

/**
 * La fonction createFile prend en parametre le chemin d'accé du fichier et ces droit
 */
function createFile($type, $droit)
{
    $_SESSION['type'] = $type;
    $_SESSION['droit'] = $droit;
    $_SESSION['validate'] = 1;
}

function test()
{
    include '../data/database.php';

    $value  = $db->prepare("SELECT * FROM Test");
    $value->execute();
    $valueFin = $value->fetch();
    $valueFin['id'];
    echo $row;
}
?>