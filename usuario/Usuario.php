<?php

include_once '../Conexao.php';

class usuario
{

    protected $id_usuario;
    protected $nome;

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

        return $conexao->executar($sql);
    }

    public function inserir($dados)
    {
        $id_usuario = $dados['id_usuario'];
        $nome = $dados['nome'];

        $conexao = new Conexao();

        $sql = "insert into usuario (id_usuario, nome) values ('$id_usuario', '$nome')";

        return $conexao->executar($sql);
    }

    public function alterar($dados)
    {
        $id_usuario = $dados['id_usuario'];
        $nome = $dados['nome'];

        $conexao = new Conexao();

        $sql = "update usuario set
                  id_usuario = '$id_usuario',
                  nome = '$nome'
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