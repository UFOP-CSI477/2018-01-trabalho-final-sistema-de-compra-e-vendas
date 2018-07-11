<?php

namespace model;

use model\Database;

class Produto
{
    protected $db = null;
    private $id;
    private $id_vendedor;
    private $id_tipo_produto;
    private $nome;
    private $descricao;
    private $preco;
    private $quantidade;

    public function __construct()
    {
        $this->db = Database::getInstance()->getDB();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getIdVendedor()
    {
        return $this->id_vendedor;
    }

    public function setIdVendedor($id_vendedor)
    {
        $this->id_vendedor = $id_vendedor;
    }

    public function getIdTipoProduto()
    {
        return $this->id_tipo_produto;
    }

    public function setIdTipoProduto($id_tipo_produto)
    {
        $this->id_tipo_produto = $id_tipo_produto;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }


}