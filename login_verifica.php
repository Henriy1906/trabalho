<?php
require('twig_carregar.php');
require('pdo.inc.php');
require('models/Model.php');
require('models/Usuario.php');

$nome = $_POST['nome'];
$senha = $_POST['password'];
$id = $_GET['idusuarios'];


    $sql = $pdo->prepare('SELECT * FROM usuarios WHERE nome = :usuarios ');
    $sql->bindParam(':usuarios', $nome);
    $sql->execute();

    // Se encontrou o usuário
    if ($sql->rowCount()) {
        // Login feito com sucesso
        $usuarios = $sql->fetch(PDO::FETCH_OBJ);

        // Verificar se a senha está correta
        if (!password_verify($senha, $usuarios->senha)) {
            // Falha no login
            header('location:login.php?erro=1');
            die;
        }

        // Cria uma sessão para armazenar o usuário
        session_start();
        $_SESSION['id'] = $usuarios->idusuarios;
        $_SESSION['user'] = 'verificado';


        header("location: boasvindas.php?idusuarios=$usuarios->idusuarios");
        die;
    } else {
        // Falha no login
        header('location:login.php?erro=1');
        die;
    }