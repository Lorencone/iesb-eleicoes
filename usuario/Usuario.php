<?php

include_once '../Conexao.php';

class Usuario
{

    protected $id_usuario;
    protected $nome;
    protected $email;
    protected $senha;
    protected $id_perfil;

    /**
     * @return mixed
     */
    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    /**
     * @param mixed $id_usuario
     */
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * @param mixed $senha
     */
    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    /**
     * @return mixed
     */
    public function getIdperfil()
    {
        return $this->id_perfil;
    }

    /**
     * @param mixed $id_perfil
     */
    public function setIdperfil($id_perfil): void
    {
        $this->id_perfil = $id_perfil;
    }

        public function recuperarDados()
    {
        $conexao = new Conexao();

        $sql = "select * from usuario order by nome";
        return $conexao->recuperarDados($sql);
    }

    public function carregarPorId($id_usuario)
    {

        $conexao = new Conexao();


        $sql = "select * from usuario where id_usuario = '$id_usuario'";

        $dados = $conexao->recuperarDados($sql);

        $this->id_usuario = $dados[0]['id_usuario'];
        $this->nome = $dados[0]['nome'];
        $this->email = $dados[0]['email'];
        $this->senha = $dados[0]['senha'];
        $this->id_perfil = $dados[0]['id_perfil'];

//        print_r($sql);
//        die;

        return $conexao->executar($sql);
    }

    public function inserir($dados)
    {
        $nome = $dados['nome'];
        $email = $dados['email'];
        $senha = md5($dados['senha']);
        $id_perfil = $dados['id_perfil'];

        $conexao = new Conexao();

        $sql = "insert into usuario (nome, email, senha, id_perfil) values ('$nome','$email','".md5($senha)."','$id_perfil')";

//        print_r($sql);
//        die;

        return $conexao->executar($sql);
    }

    public function alterar($dados)
    {
        $id_usuario = $dados['id_usuario'];
        $nome = $dados['nome'];
        $email = $dados['email'];
        $senha = $dados['senha'];
        $id_perfil = $dados['id_perfil'];

        $conexao = new Conexao();

        $sql = "update usuario set
                  id_usuario = '$id_usuario',
                  nome = '$nome',
                  email = '$email',
                  senha = '".md5($senha)."',
                  id_perfil = '$id_perfil'
                where id_usuario = '$id_usuario'";
//        print_r($sql);
//        die;

        return $conexao->executar($sql);
    }

    public function excluir($id_usuario)
    {
        $conexao = new Conexao();

        $sql = "delete from usuario where id_usuario = '$id_usuario'";

//        print_r($sql);
//        die;

        return $conexao->executar($sql);
    }

    public function logar($dados)
    {

        $email = $dados['email'];
        $senha  = md5($dados['senha']);

        $conexao = new Conexao();

        $sql = "select * from usuario where email = '$email' and senha = '$senha'";

        $dados = $conexao->recuperarDados($sql);

//        print_r($sql);
//        echo "<br>";
//        print_r($dados);

        if (count($dados)){

            $_SESSION['usuario']['id_usuario'] = $dados[0]['id_usuario'];
            $_SESSION['usuario']['nome'] = $dados[0]['nome'];
            $_SESSION['usuario']['email'] = $dados[0]['email'];
            $_SESSION['usuario']['id_perfil'] = $dados[0]['id_perfil'];

//            $nome = $dados[0]['nome'];
//            print_r($nome);
        }

//        die;

        return $conexao->executar($sql);
    }

    public function possuiAcesso()
    {
        $raizUrl = '/php/iesb-eleicoes/';
        $url = $_SERVER['REQUEST_URI'];

        $sql = "select *from pagina where publica = 1";

        $conexao = new Conexao();
        $paginas = $conexao->recuperarDados($sql);

        foreach ($paginas as $pagina){
            if ($url == $raizUrl . $pagina['caminho']){
                return true;
            }
        }

        if (!empty($_SESSION['usuario']['id_usuario'])){

            $perfil = $_SESSION['usuario']['id_perfil'];

            $sql = "select * from permissao pe
                      inner join pagina pa on pa.id_pagina = pe.id_pagina
                    where id_perfil = $perfil";

            $paginas = $conexao->recuperarDados($sql);

            foreach ($paginas as $pagina){
                if ($url == $raizUrl . $pagina['caminho']){
                    return true;
                }
            }
        }

        return false;
    }

    public function deslogar(){

        unset($_SESSION['usuario']);
    }
}