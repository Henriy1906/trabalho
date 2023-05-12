<?php
# documentos.php
require('twig_carregar.php');
require('pdo.inc.php');

$id = $_GET['idusuarios'];
echo $twig->render('documentos.html',[
'id' => $id,
]);