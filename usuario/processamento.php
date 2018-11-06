<?php

session_start();
include_once 'Usuario.php';

$usuario = new usuario();

switch ($_GET['acao']) {
    case 'salvar':
        if (!empty($_POST['id_usuario'])) {
            $usuario->alterar($_POST);
        } else {
            $usuario->inserir($_POST);
//            print_r($_POST);
//            die;
        }
        break;
    case 'excluir':
        $usuario->excluir($_GET['id_usuario']);
        break;
    case 'logar':
        $usuario->logar($_POST);
        break;
    case 'deslogar':
        $usuario->deslogar();
        break;
}

header('location: index.php');