<?php
# documentos_novo.php
require('twig_carregar.php');
require('pdo.inc.php');
require('models/Model.php');
require('models/Documento.php');
require('func/sanitize_filename.php');
require('func/verifica_nome_arquivo.php');

$id = $_GET['idusuarios'];


if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$_FILES['arquivo']['error']) {

    $arquivo = sanitize_filename($_FILES['arquivo']['name']);

    $arquivo = verifica_nome_arquivo('uploads/', $arquivo);

    move_uploaded_file($_FILES['arquivo']['tmp_name'], 'uploads/' . $arquivo);

    $doc = new Documentos();

    $doc->create([
    'iddocumentos' => null,
    'nome' => $arquivo,
    'usuarios_idusuarios' => $id,
]);

}

echo $twig->render('documentos_novo.html',[
    'iduser' => $id,
]);