<?php
require('twig_carregar.php');
require('pdo.inc.php');
session_start();
$id = $_GET['iddocumentos'];
$iduser = $_GET['idusuarios'];
$_SESSION['idusuarios'] = $iduser;
$_SESSION['iddocumentos'] = $id;

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}


echo $twig->render('documentos_apagar.html', [
    'idusuarios' => $iduser,
]);