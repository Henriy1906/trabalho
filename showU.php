<?php
require('twig_carregar.php');
require('pdo.inc.php');
session_start();
$idD = $_GET['iddocumentos'];
$idU = $_GET['idusuarios'];

$_SESSION['id'] = $idU;


if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}

$doc = $pdo->prepare('SELECT * FROM documentos WHERE iddocumentos = ?');
$doc->execute([$idD]);
$doc = $doc->fetch(PDO::FETCH_ASSOC);

$sql = $pdo->prepare('SELECT * FROM usuarios WHERE idusuarios != ?');
$sql->execute([$idU]);
$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('showU.html', [
    'users' => $usuarios,
    'iddocumentos' => $doc,
]);