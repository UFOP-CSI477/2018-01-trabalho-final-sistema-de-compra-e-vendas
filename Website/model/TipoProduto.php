<?php

namespace model;

use model\Database;

class TipoProduto
{
    private $id;
    private $tipo;
    private $categoria;

    public function __construct()
    {
        $this->id = null;
        $this->tipo = null;
        $this->categoria = null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }


}