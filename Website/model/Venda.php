<?php

namespace model;

use model\Database;

class Venda
{
    private $id;
    private $id_vendedor;
    private $id_cliente;
    private $id_produto;
    private $status;
    private $quantidade;
    private $created_at;
    private $updated_at;

    public function __construct()
    {
        $this->id = null;
        $this->id_vendedor = null;
        $this->id_cliente = null;
        $this->id_produto = null;
        $this->status = null;
        $this->quantidade = null;
        $this->created_at = null;
        $this->updated_at = null;
    }

    public function getIdVendedor()
    {
        return $this->id_vendedor;
    }

    public function setIdVendedor($id_vendedor)
    {
        $this->id_vendedor = $id_vendedor;
    }

    public function getIdCliente()
    {
        return $this->id_cliente;
    }

    public function setIdCliente($id_cliente)
    {
        $this->id_cliente = $id_cliente;
    }

    public function getIdProduto()
    {
        return $this->id_produto;
    }

    public function setIdProduto($id_produto)
    {
        $this->id_produto = $id_produto;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }


}