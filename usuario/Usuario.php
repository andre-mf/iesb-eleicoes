<?php

include_once '../Conexao.php';

class Usuario
{

    protected $id_usuario;
    protected $nome;
    protected $email;
    protected $senha;
    protected $id_perfil;

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha): void
    {
        $this->senha = $senha;
    }

    public function getIdperfil()
    {
        return $this->id_perfil;
    }

    public function setIdperfil($id_perfil): void
    {
        $this->id_perfil = $id_perfil;
    }

    public function recuperarDados()
    {
        $conexao = new Conexao();

        $sql = "SELECT * FROM usuario order by nome";
        return $conexao->recuperarDados($sql);
    }

    public function carregarPorId($id_usuario)
    {

        $conexao = new Conexao();


        $sql = "SELECT * FROM usuario WHERE id_usuario = '$id_usuario'";

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

        $sql = "INSERT INTO usuario (nome, email, senha, id_perfil) VALUES ('$nome','$email','".md5($senha)."','$id_perfil')";

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

        $sql = "UPDATE usuario SET
                  id_usuario = '$id_usuario',
                  nome = '$nome',
                  email = '$email',
                  senha = '".md5($senha)."',
                  id_perfil = '$id_perfil'
                WHERE id_usuario = '$id_usuario'";
//        print_r($sql);
//        die;

        return $conexao->executar($sql);
    }

    public function excluir($id_usuario)
    {
        $conexao = new Conexao();

        $sql = "DELETE FROM usuario WHERE id_usuario = '$id_usuario'";

//        print_r($sql);
//        die;

        return $conexao->executar($sql);
    }

    public function logar($dados)
    {

        $email = $dados['email'];
        $senha  = md5($dados['senha']);

        $conexao = new Conexao();

        $sql = "SELECT * FROM usuario WHERE email = '$email' and senha = '$senha'";

        $dados = $conexao->recuperarDados($sql);

        if (count($dados)){

            $_SESSION['usuario']['id_usuario'] = $dados[0]['id_usuario'];
            $_SESSION['usuario']['nome'] = $dados[0]['nome'];
            $_SESSION['usuario']['email'] = $dados[0]['email'];
            $_SESSION['usuario']['id_perfil'] = $dados[0]['id_perfil'];

        }

        return $conexao->executar($sql);
    }

    public function possuiAcesso()
    {
        $raizUrl = '/Web2/iesb-eleicoes/';
        $url = $_SERVER['REQUEST_URI'];

        $sql = "SELECT * FROM pagina WHERE publica = 1";

        $conexao = new Conexao();
        $paginas = $conexao->recuperarDados($sql);

        // Se a página for cadastrada como pública, libera o acesso
        foreach ($paginas as $pagina){
            if ($url == $raizUrl . $pagina['caminho']){
                return true;
            }
        }

        // Caso a página não seja pública, verifica se o usuário está logado
        // para então verificar se ele tem acesso à página
        if (!empty($_SESSION['usuario']['id_usuario'])){

            $perfil = $_SESSION['usuario']['id_perfil'];

            $sql = "SELECT * FROM permissao pe
                      INNER JOIN pagina pa on pa.id_pagina = pe.id_pagina
                    WHERE id_perfil = $perfil";

            $paginas = $conexao->recuperarDados($sql);
            foreach ($paginas as $pagina){
                if ($url == $raizUrl . $pagina['caminho']){
                    return true;
                }
            }
        }

        return false;
    }
}