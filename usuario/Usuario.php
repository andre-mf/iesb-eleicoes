<?php

include_once '../Conexao.php';

class Usuario
{

    protected $id_usuario;
    protected $nome;
    protected $email;
    protected $senha;
    protected $perfil_id;

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
    public function getPerfilId()
    {
        return $this->perfil_id;
    }

    /**
     * @param mixed $perfil_id
     */
    public function setPerfilId($perfil_id): void
    {
        $this->perfil_id = $perfil_id;
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
        $this->perfil_id = $dados[0]['id_perfil'];

        return $conexao->executar($sql);
    }

    public function inserir($dados)
    {
        $nome = $dados['nome'];
        $email = $dados['email'];
        $senha = $dados['senha'];
        $id_perfil = $dados['id_perfil'];

        $conexao = new Conexao();

        $sql = "insert into usuario (nome, email, senha, id_perfil) values ('$nome','$email','".md5($senha)."','$id_perfil')";

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

        return $conexao->executar($sql);
    }

    public function excluir($id_usuario)
    {
        $conexao = new Conexao();

        $sql = "delete from usuario where id_usuario = '$id_usuario'";
        return $conexao->executar($sql);
    }
}