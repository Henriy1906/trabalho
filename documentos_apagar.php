<?php
    # usuario_apagar.php
    require('twig_carregar.php');
    require('pdo.inc.php'); 

    session_start();
    $id = $_SESSION['iddocumentos'];
    $iduser = $_SESSION['idusuarios'];  

    $ap = $pdo->prepare('DELETE FROM compart_documentos WHERE iddocumentos = ?');
    $ap->execute([$id]);
    $sql = $pdo->prepare('DELETE FROM documentos WHERE iddocumentos = ?');
    $sql->execute([$id]);

    header("Location: boasvindas.php?idusuarios={$_SESSION['idusuarios']}");