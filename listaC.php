<?php
require('twig_carregar.php');
require('pdo.inc.php');
session_start();

$id = $_GET['idusuarios'];

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'verificado') {
    header('Location: login.php');
    die;
}

$sql = $pdo->prepare('SELECT compart_documentos.*, documentos.nome, documentos.data AS data, documentos.usuarios_idusuarios AS d_iduser, usuarios.nome AS usuario_nome 
FROM compart_documentos JOIN documentos ON documentos.iddocumentos = compart_documentos.iddocumentos 
JOIN usuarios ON documentos.usuarios_idusuarios = usuarios.idusuarios 
WHERE compart_documentos.usuarios_idusuarios = ?');
$sql->execute([$id]);

$usuarios = $sql->fetchAll(PDO::FETCH_ASSOC);
foreach ($usuarios as &$usr) {
    $nomeArquivo = $usr['nome'];
    $caminhoArquivo = 'uploads/' . $nomeArquivo;
    $usr['caminho_arquivo'] = $caminhoArquivo;
    $updateSql = $pdo->prepare('UPDATE documentos SET caminho_arquivo = ? WHERE iddocumentos = ?');
    $updateSql->execute([$caminhoArquivo, $usr['iddocumentos']]);
}

echo $twig->render('listaC.html', [
    'usuarios' => $usuarios,
    'idusuarios' => $id,
]);