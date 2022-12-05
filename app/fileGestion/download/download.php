<?php
session_start();
include '../../data/database.php';

if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $stat = $db->prepare("SELECT * FROM fichiers WHERE id = ?");
    $stat->bindParam(1, $id);
    $stat->execute();
    $data = $stat->fetch();

    $file = "../../".$data['type']."/".$data['nom'];
    
    if(file_exists($file))
    {
        header('Content-Type: application/octet-stream');
        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma :'.$data['droit']);
        header('Content-Length :'.filesize($file));
        readfile($file);

        $newCount = $data['downloads'] + 1;

        $insertNewCountDownload = $db->prepare("UPDATE fichiers SET downloads = ? WHERE id = $id");
        $insertNewCountDownload->execute(array($newCount));
        exit;
    }
}