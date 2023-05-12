<?php
require('twig_carregar.php');
require('pdo.inc.php');
session_start();

$idD = $_GET['iddocumentos'];
$idU = $_GET['idusuarios'];
$perm = $_POST['select'];

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}

$sql = $pdo->prepare('INSERT INTO `compart_documentos` (`idcompart_documentos`,`permissao`, `iddocumentos`, `usuarios_idusuarios`) 
VALUES (NULL, :perm, :idD, :idU)');
$sql->BindParam(':perm',$perm);
$sql->BindParam(':idD',$idD);
$sql->BindParam(':idU',$idU);
$sql->execute();


header("Location: boasvindas.php?idusuarios={$_SESSION['id']}");
