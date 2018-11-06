<?php

session_start();
include_once 'Usuario.php';
include_once '../perfil/Perfil.php';

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
        if (!empty($_SESSION['usuario'])) {
            switch ($_SESSION['usuario']['id_usuario']) {
                case Perfil::PERFIL_ADMINISTRADOR:
                    header('location: ../pagina/index.php');
                case Perfil::PERFIL_MESARIO:
                    header('location: ../partido/index.php');
                case Perfil::PERFIL_CHEFE:
                    header('location: ../perfil/index.php');
                case Perfil::PERFIL_ELEITOR:
                    header('location: ../eleitor/index.php');
            }
        }
        break;
    case 'deslogar':
        $usuario->deslogar();
        break;
}

header('location: index.php');