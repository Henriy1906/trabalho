<?php
require('twig_carregar.php');
require('pdo.inc.php');
require('models/Model.php');
require('models/Documento.php');
$id = $_GET['idusuarios'];

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}

$nomeFiltro = $_GET['nome'] ?? '';

$sql = "SELECT * FROM documentos WHERE usuarios_idusuarios = ?";
$params = [$id];

if (!empty($nomeFiltro)) {
    $sql .= " AND nome LIKE ?";
    $params[] = "%$nomeFiltro%";
}

$query = $pdo->prepare($sql);
$query->execute($params);
$documentos = $query->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('arquivos.html', [
    'documentos' => $documentos,
]);
?>
